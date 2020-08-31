<?php
/**
 * Created by PhpStorm.
 * User: Igor
 * Date: 27/08/2020
 * Time: 15:26
 */

namespace Controller;


use Helper\Apoio;
use Sistema\Controller;

class Tipo extends Controller
{
    // Objetos
    private $objModelTipo;
    private $objModelMarca;
    private $objModelProduto;

    private $objHelperApoio;

    // Método construtor
    public function __construct()
    {
        // Chama o pai
        parent::__construct();

        // Instanci os objetos
        $this->objModelTipo = new \Model\Tipo();
        $this->objModelMarca = new \Model\Marca();
        $this->objModelProduto = new \Model\Produto();

        $this->objHelperApoio = new Apoio();

    } // End >> fun::__construct()


    /**
     * Método responsável por listar todas as
     * categorias cadastradas no sistema.
     * ---------------------------------------------
     * @url painel/tipos
     */
    public function listar()
    {
        // Variaveis
        $dados = null;
        $usuario = null;
        $tipos = null;
        $marca = [];

        // Recupera o usuário logado
        $usuario = $this->objHelperApoio->seguranca();

        // Verifica se possui permissão
        if($usuario->nivel == "admin")
        {
            // Busca todas as categorias
            $tipos = $this->objHelperApoio->getTiposLista();

            // Percorre as categorias
            foreach ($tipos as $tip)
            {
                // Verifica se não possui a marca no array
                if(empty($marca[$tip->id_marca]))
                {
                    // Busca a marca
                    $aux = $this->objModelMarca
                        ->get(["id_marca" => $tip->id_marca])
                        ->fetch(\PDO::FETCH_OBJ);

                    // Add ao array
                    $marca[$tip->id_marca] = $aux;
                }

                // Add a marca
                $tip->marca = $marca[$tip->id_marca];

                // Busca o numero de produtos com a categoria
                $tip->produtos = $this->objModelProduto
                    ->get(["id_tipo" => $tip->id_tipo])
                    ->rowCount();
            }

            // Array de retorno
            $dados = [
                "usuario" => $usuario,
                "tipos" => $tipos,
                "js" => [
                    "modulos" => ["Tipo"]
                ]
            ];

            // View
            $this->view("painel/tipo/listar", $dados);
        }

    } // End >> fun::listar()


    /**
     * Método responsável por adicionar uma nova categoria
     * no sistema, verificando se o usuário possui
     * permissão.
     * ---------------------------------------------
     * @url painel/tipo/adicionar
     */
    public function adicionar()
    {
        // Variaveis
        $dados = null;
        $usuario = null;
        $where = null;
        $idMarca = null;

        // Recupera o logado
        $usuario = $this->objHelperApoio->seguranca();

        // Verifica se possui permissão
        if($usuario->nivel == "admin")
        {
            // Verifica se possui where
            if(!empty($_GET["marca"]))
            {
                $idMarca = $_GET["marca"];
            }

            // Busca todas as categorias
            $tipos = $this->objHelperApoio->getTiposLista(null, $idMarca);

            // Busca as marcas
            $marcas = $this->objModelMarca
                ->get(null)
                ->fetchAll(\PDO::FETCH_OBJ);

            // Array de retorno
            $dados = [
                "usuario" => $usuario,
                "tipos" => $tipos,
                "marcas" => $marcas,
                "get" => $_GET,
                "js" => [
                    "modulos" => ["Tipo"],
                    "pages" => ["Select"]
                ]
            ];

            // View
            $this->view("painel/tipo/adicionar", $dados);
        }

    } // End >> fun::adicionar()


    /**
     * Método responsável por buscar as informações
     * necessárias e montar a página de alteração de
     * uma determinada categoria.
     * ---------------------------------------------
     * @param $id [Id da categoria]
     * ---------------------------------------------
     * @url painel/tipo/alterar/{ID}
     */
    public function alterar($id)
    {
        // Variaveis
        $dados = null;
        $usuario = null;
        $obj = null;

        // Busca o usuário logado
        $usuario = $this->objHelperApoio->seguranca();

        // Verifica se possui permissão
        if($usuario->nivel == "admin")
        {
            // Busca a categoria a ser alterada
            $tipo = $this->objModelTipo
                ->get(["id_tipo" => $id])
                ->fetch(\PDO::FETCH_OBJ);

            // Verifica se existe
            if(!empty($tipo))
            {
                // Busca todas as categorias cadastradas
                $tipos = $this->objHelperApoio->getTiposLista();

                // Busca a marca
                $marca = $this->objModelMarca
                    ->get(["id_marca" => $tipo->id_marca])
                    ->fetch(\PDO::FETCH_OBJ);

                // Array de retorno
                $dados = [
                    "usuario" => $usuario,
                    "tipo" => $tipo,
                    "tipos" => $tipos,
                    "marca" => $marca,
                    "js" => [
                        "modulos" => ["Tipo"],
                        "pages" => ["Select"]
                    ]
                ];

                // View
                $this->view("painel/tipo/alterar", $dados);
            }
            else
            {
                // Manda para o inserir
                $this->adicionar();

            } // Categoria não existe
        }

    } // End >> fun::alterar()


} // End >> Class::Categoria