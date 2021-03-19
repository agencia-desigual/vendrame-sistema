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

class Tratamento extends Controller
{
    // Objetos
    private $objModelTratamento;
    private $objModelMarca;
    private $objModelProduto;

    private $objHelperApoio;

    // Método construtor
    public function __construct()
    {
        // Chama o pai
        parent::__construct();

        // Instanci os objetos
        $this->objModelTratamento = new \Model\Tratamento();
        $this->objModelMarca = new \Model\Marca();
        $this->objModelProduto = new \Model\Produto();

        $this->objHelperApoio = new Apoio();

    } // End >> fun::__construct()


    /**
     * Método responsável por listar todas as
     * categorias cadastradas no sistema.
     * ---------------------------------------------
     * @url painel/tratamentos
     */
    public function listar()
    {
        // Variaveis
        $dados = null;
        $usuario = null;
        $tratamentos = null;

        // Recupera o usuário logado
        $usuario = $this->objHelperApoio->seguranca();

        // Verifica se possui permissão
        if($usuario->nivel == "admin")
        {
            // Busca todos os indices
            $tratamentos = $this->objModelTratamento
                ->get()
                ->fetchAll(\PDO::FETCH_OBJ);


            // Array de retorno
            $dados = [
                "usuario" => $usuario,
                "tratamentos" => $tratamentos,
                "js" => [
                    "modulos" => ["Tratamento"]
                ]
            ];

            // View
            $this->view("painel/tratamento/listar", $dados);
        }

    } // End >> fun::listar()


    /**
     * Método responsável por adicionar uma nova categoria
     * no sistema, verificando se o usuário possui
     * permissão.
     * ---------------------------------------------
     * @url painel/tratamento/adicionar
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
            // Array de retorno
            $dados = [
                "usuario" => $usuario,
                "get" => $_GET,
                "js" => [
                    "modulos" => ["Tratamento"],
                    "pages" => ["Select"]
                ]
            ];

            // View
            $this->view("painel/tratamento/adicionar", $dados);
        }

    } // End >> fun::adicionar()


    /**
     * Método responsável por buscar as informações
     * necessárias e montar a página de alteração de
     * uma determinada categoria.
     * ---------------------------------------------
     * @param $id [Id do tratamento]
     * ---------------------------------------------
     * @url painel/tratamento/alterar/{ID}
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
            // Busca a indice a ser alterada
            $tratamento = $this->objModelTratamento
                ->get(["id_tratamento" => $id])
                ->fetch(\PDO::FETCH_OBJ);

            // Verifica se existe
            if(!empty($indice))
            {
                // Array de retorno
                $dados = [
                    "usuario" => $usuario,
                    "tratamento" => $tratamento,
                    "js" => [
                        "modulos" => ["Tratamento"],
                        "pages" => ["Select"]
                    ]
                ];

                // View
                $this->view("painel/tratamento/alterar", $dados);
            }
            else
            {
                // Manda para o inserir
                $this->adicionar();

            } // Categoria não existe
        }

    } // End >> fun::alterar()


} // End >> Class::Categoria