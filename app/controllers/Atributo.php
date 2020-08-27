<?php

// NameSpace
namespace Controller;

// Importações
use Helper\Apoio;
use Sistema\Controller;

// Inicia a Classe
class Atributo extends Controller
{
    // Objetos
    private $objModelAtributo;
    private $objHelperApoio;

    // Método construtor
    public function __construct()
    {
        // Chama o pai
        parent::__construct();

        // Instancia os objetos
        $this->objModelAtributo = new \Model\Atributo();
        $this->objHelperApoio = new Apoio();

    } // End >> fun::__construct()


    /**
     * Método responsável por listar todos os atributos
     * cadastrados no sistema.
     * -------------------------------------------------
     * @url painel/atributos
     */
    public function listar()
    {
        // Variaveis
        $dados = null;
        $usuario = null;
        $atributos = null;

        // Busca o usuário
        $usuario = $this->objHelperApoio->seguranca();

        // Verifica se possui permissão
        if($usuario->nivel == "admin")
        {
            // Busca o atributo
            $atributos = $this->objModelAtributo
                ->get()
                ->fetchAll(\PDO::FETCH_OBJ);

            // Retorno
            $dados = [
                "usuario" => $usuario,
                "atributos" => $atributos,
                "js" => [
                    "modulos" => ["Atributo"]
                ]
            ];

            // View
            $this->view("painel/atributo/listar", $dados);
        }

    } // End >> fun::listar()


    /**
     * Método responsável por adicionar um novo
     * atributo no sistema.
     * -------------------------------------------------
     * @url painel/atributo/adicionar
     */
    public function adicionar()
    {
        // Variaveis
        $dados = null;
        $usuario = null;

        // Recupera o usuário logado
        $usuario = $this->objHelperApoio->seguranca();

        // Verifica se possui permissão
        if($usuario->nivel == "admin")
        {
            // Array de retorno
            $dados = [
                "usuario" => $usuario,
                "js" => [
                    "modulos" => ["Atributo"]
                ]
            ];

            // View
            $this->view("painel/atributo/adicionar", $dados);
        }

    } // End >> fun::adicionar()


    /**
     * Método responsável por alterar os detalhes de um
     * determinada atributo já cadastrado.
     * -------------------------------------------------
     * @param $id [ID Atributo]
     * -------------------------------------------------
     * @url painel/atributo/alterar/{ID}
     */
    public function alterar($id)
    {
        // Variaveis
        $dados = null;
        $usuario = null;
        $atributo = null;

        // Busca o usuário logado
        $usuario = $this->objHelperApoio->seguranca();

        // Verifica se tem permissão
        if($usuario->nivel == "admin")
        {
            // Busca o atributo a ser modificado
            $atributo = $this->objModelAtributo
                ->get(["id_atributo" => $id])
                ->fetch(\PDO::FETCH_OBJ);

            // Verifica se o atributo existe
            if(!empty($atributo))
            {
                // Array de retorno
                $dados = [
                    "usuario" => $usuario,
                    "atributo" => $atributo,
                    "js" => [
                        "modulos" => ["Atributo"]
                    ]
                ];

                // Retorno
                $this->view("painel/atributo/alterar", $dados);
            }
            else
            {
                // Como não possui fala para adicionar um
                $this->adicionar();
            }
        }

    } // End >> fun::update()

} // End >> Class::Atributo