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

class Categoria extends Controller
{
    // Objetos
    private $objModelCategoria;
    private $objModelMarca;
    private $objModelProduto;

    private $objHelperApoio;

    // Método construtor
    public function __construct()
    {
        // Chama o pai
        parent::__construct();

        // Instanci os objetos
        $this->objModelCategoria = new \Model\Categoria();
        $this->objModelMarca = new \Model\Marca();
        $this->objModelProduto = new \Model\Produto();

        $this->objHelperApoio = new Apoio();

    } // End >> fun::__construct()


    /**
     * Método responsável por listar todas as
     * categorias cadastradas no sistema.
     * ---------------------------------------------
     * @url painel/categorias
     */
    public function listar()
    {
        // Variaveis
        $dados = null;
        $usuario = null;
        $categorias = null;
        $marca = [];

        // Recupera o usuário logado
        $usuario = $this->objHelperApoio->seguranca();

        // Verifica se possui permissão
        if($usuario->nivel == "admin")
        {
            // Busca todas as categorias
            $categorias = $this->objHelperApoio->getCategoriasLista();

            // Percorre as categorias
            foreach ($categorias as $cat)
            {
                // Busca o numero de produtos com a categoria
                $cat->produtos = $this->objModelProduto
                    ->get(["id_categoria" => $cat->id_categoria])
                    ->rowCount();
            }

            // Array de retorno
            $dados = [
                "usuario" => $usuario,
                "categorias" => $categorias,
                "js" => [
                    "modulos" => ["Categoria"]
                ]
            ];

            // View
            $this->view("painel/categoria/listar", $dados);
        }

    } // End >> fun::listar()


    /**
     * Método responsável por adicionar uma nova categoria
     * no sistema, verificando se o usuário possui
     * permissão.
     * ---------------------------------------------
     * @url painel/categoria/adicionar
     */
    public function adicionar()
    {
        // Variaveis
        $dados = null;
        $usuario = null;

        // Recupera o logado
        $usuario = $this->objHelperApoio->seguranca();

        // Verifica se possui permissão
        if($usuario->nivel == "admin")
        {
            // Busca todas as categorias
            $categorias = $this->objHelperApoio->getCategoriasLista();

            // Array de retorno
            $dados = [
                "usuario" => $usuario,
                "categorias" => $categorias,
                "get" => $_GET,
                "js" => [
                    "modulos" => ["Categoria"],
                    "pages" => ["Select"]
                ]
            ];

            // View
            $this->view("painel/categoria/adicionar", $dados);
        }

    } // End >> fun::adicionar()


    /**
     * Método responsável por buscar as informações
     * necessárias e montar a página de alteração de
     * uma determinada categoria.
     * ---------------------------------------------
     * @param $id [Id da categoria]
     * ---------------------------------------------
     * @url painel/categoria/alterar/{ID}
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
            $categoria = $this->objModelCategoria
                ->get(["id_categoria" => $id])
                ->fetch(\PDO::FETCH_OBJ);

            // Verifica se existe
            if(!empty($categoria))
            {
                // Busca todas as categorias cadastradas
                $categorias = $this->objHelperApoio->getCategoriasLista();

                // Array de retorno
                $dados = [
                    "usuario" => $usuario,
                    "categoria" => $categoria,
                    "categorias" => $categorias,
                    "js" => [
                        "modulos" => ["Categoria"],
                        "pages" => ["Select"]
                    ]
                ];

                // View
                $this->view("painel/categoria/alterar", $dados);
            }
            else
            {
                // Manda para o inserir
                $this->adicionar();

            } // Categoria não existe
        }

    } // End >> fun::alterar()


} // End >> Class::Categoria