<?php
/**
 * Created by PhpStorm.
 * User: Igor
 * Date: 25/08/2020
 * Time: 11:58
 */

// NameSpace
namespace Controller;

// Importações
use Helper\Apoio;
use Model\AtributoProduto;
use Model\FichaTecnica;
use Model\Imagem;
use Sistema\Controller;

// Classe
class Produto extends Controller
{
    // Objetos
    private $objModelProduto;
    private $objModelMarca;
    private $objModelCategoria;
    private $objModelTipo;
    private $objModelFichaTecnica;
    private $objModelImagem;
    private $objModelAtributoProduto;
    private $objModelAtributo;

    private $objHelperApoio;


    // Método construtor
    public function __construct()
    {
        // Chama o pai
        parent::__construct();

        // Instancia os objetos
        $this->objModelProduto = new \Model\Produto();
        $this->objModelMarca = new \Model\Marca();
        $this->objModelTipo = new \Model\Tipo();
        $this->objModelCategoria = new \Model\Categoria();
        $this->objModelFichaTecnica = new FichaTecnica();
        $this->objModelImagem = new Imagem();
        $this->objModelAtributo = new \Model\Atributo();
        $this->objModelAtributoProduto = new AtributoProduto();

        $this->objHelperApoio = new Apoio();

    } // End >> fun::__construct()


    /**
     * Método responsável por montar a página do painel
     * onde lista todos os produtos cadastrados no sitema
     * para o usuário admin gerenciar.
     * -----------------------------------------------------
     * @url painel/produtos
     * @method GET
     */
    public function listar()
    {
        // Variaveis
        $dados = null;
        $usuario = null;
        $produtos = null;
        $marcas = [];

        // Recupera o usuário logado
        $usuario = $this->objHelperApoio->seguranca();

        // Verifica se possui permissão
        if($usuario->nivel == "admin")
        {
            // Busca todos os produtos
            $produtos = $this->objModelProduto
                ->get()
                ->fetchAll(\PDO::FETCH_OBJ);

            // Percorre todos os produtos
            foreach ($produtos as $prod)
            {
                // Verifica se não tem a marca salva
                if(empty($marcas[$prod->id_marca]))
                {
                    // Busca a marca
                    $marcas[$prod->id_marca] = $this->objModelMarca
                        ->get(["id_marca" => $prod->id_marca])
                        ->fetch(\PDO::FETCH_OBJ);
                }

                // Adiciona os itens
                $prod->marca = $marcas[$prod->id_marca];
            }

            // Retorno
            $dados = [
                "usuario" => $usuario,
                "produtos" => $produtos,
                "js" => [
                    "modulos" => ["Produto"]
                ]
            ];

            // View
            $this->view("painel/produto/listar", $dados);
        }

    } // End >> fun::listar()


    /**
     * Método responsável por montar a página com todas
     * as informações necessárias para adicionar um
     * novo produto.
     * -----------------------------------------------------
     * @url painel/produto/adicionar
     * @method GET
     */
    public function adicionar()
    {
        // Variaveis
        $dados = null;
        $usuario = null;
        $marcas = null;
        $idMarca = null;

        // Recupera o usuário
        $usuario = $this->objHelperApoio->seguranca();

        // Verifica se é admin
        if($usuario->nivel == "admin")
        {
            // Verifica se possui where
            if(!empty($_GET["marca"]))
            {
                $idMarca = $_GET["marca"];
            }

            // Busca todas as categorias
            $categorias = $this->objHelperApoio->getCategoriasLista(null, $idMarca);

            // Busca todas os tipos
            $tipos = $this->objHelperApoio->getTiposLista(null, $idMarca);

            // Busca as marcas
            $marcas = $this->objModelMarca
                ->get(null)
                ->fetchAll(\PDO::FETCH_OBJ);

            // Array de retorno
            $dados = [
                "usuario" => $usuario,
                "tipos" => $tipos,
                "categorias" => $categorias,
                "marcas" => $marcas,
                "get" => $_GET,
                "js" => [
                    "modulos" => ["Produto"],
                    "pages" => ["Select"]
                ]
            ];

            // View
            $this->view("painel/produto/adicionar", $dados);
        }

    } // End >> fun::adicionar()


    public function alterar($id, $pag = "produto")
    {
        // Variaveis
        $dados = null;
        $usuario = null;
        $produto = null;

        // Recupera o usuário
        $usuario = $this->objHelperApoio->seguranca();

        // Verifica se é admin
        if($usuario->nivel == "admin")
        {
            // Busca o produto
            $produto = $this->objModelProduto
                ->get(["id_produto" => $id])
                ->fetch(\PDO::FETCH_OBJ);

            // Verifica se o produto existe
            if(!empty($produto))
            {
                $ids = "";

                // Busca todas as categorias
                $categorias = $this->objHelperApoio->getCategoriasLista(null, $produto->id_marca);

                // Busca todas os tipos
                $tipos = $this->objHelperApoio->getTiposLista(null, $produto->id_marca);

                // Busca a marca
                $produto->marca = $this->objModelMarca
                    ->get(["id_marca" => $produto->id_marca])
                    ->fetch(\PDO::FETCH_OBJ);

                // Busca as fichas
                $produto->ficha = $this->objModelFichaTecnica
                    ->get(["id_produto" => $produto->id_produto])
                    ->fetchAll(\PDO::FETCH_OBJ);

                // Busca as imagens
                $produto->galeria = $this->objModelImagem
                    ->get(["id_produto" => $produto->id_produto])
                    ->fetchAll(\PDO::FETCH_OBJ);

                $produto->atributos = $this->objModelAtributoProduto
                    ->get(["id_produto" => $produto->id_produto])
                    ->fetchAll(\PDO::FETCH_OBJ);

                if(!empty($produto->atributos))
                {
                    foreach ($produto->atributos as $atr)
                    {
                        $ids .= $atr->id_atributo . ",";

                        $atr->atributo = $this->objModelAtributo
                            ->get(["id_atributo" => $atr->id_atributo])
                            ->fetch(\PDO::FETCH_OBJ);
                    }

                    $ids = substr($ids, 0, -1);
                }


                if(!empty($ids))
                {
                    $atributos = $this->objModelAtributo
                        ->get(["id_atributo" => "NOT IN({$ids})"])
                        ->fetchAll(\PDO::FETCH_OBJ);
                }
                else
                {
                    $atributos = $this->objModelAtributo
                        ->get()
                        ->fetchAll(\PDO::FETCH_OBJ);
                }


                // Array de retorno
                $dados = [
                    "usuario" => $usuario,
                    "tipos" => $tipos,
                    "categorias" => $categorias,
                    "produto" => $produto,
                    "pag" => $pag,
                    "atributos" => $atributos,
                    "js" => [
                        "modulos" => ["Produto","FichaTecnica"],
                        "pages" => ["Select"]
                    ]
                ];

                // View
                $this->view("painel/produto/alterar", $dados);
            }
            else
            {
                // Como não possui o produto manda para adicionar
                $this->adicionar();
            } // Produto não encontrado
        }

    } // End >> fun::alterar()

} // End >> Class::Produto