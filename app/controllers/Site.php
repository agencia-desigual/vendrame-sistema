<?php

// NameSpace
namespace Controller;

// Importação
use Helper\Apoio;
use Sistema\Controller as CI_controller;

// Classe
class Site extends CI_controller
{
    // Objetos
    private $objHelperApoio;

    // Método construtor
    function __construct()
    {
        // Carrega o contrutor da classe pai
        parent::__construct();

        // Instancia os objetos
        $this->objHelperApoio = new Apoio();

    } // End >> fun::__construct()


    /**
     * Método responsável por montar a página inicial do
     * catalogo de produtos
     * ------------------------------------------------------
     * @url PRINCIPAL
     */
    public function index()
    {
        // Variaveis
        $dados = null;
        $usuario = null;
        $marcas = null;

        // Verificando se o usuario está logado
        $usuario = $this->objHelperApoio->seguranca();

        // Dados da view
        $dados = [
            "usuario" => $usuario,
            "marcas" => $marcas,
            "js" => [
                "modulos" => ["Produtos"]
            ]
        ];

        // Carrega a view
        $this->view("site/index", $dados);

    } // End >> fun::index()


    /**
     * Método responsável por montar a página de login
     * para um determinado usuário que não esteja com uma
     * session ativa no sistema.
     * -------------------------------------------------------
     * @url login
     */
    public function login()
    {
        // Variaveis
        $dados = null;

        // Dados da view
        $dados = [
            "js" => [
                "modulos" => ["Usuario"]
            ]
        ];

        // Carrega a view
        $this->view("site/acesso/login", $dados);

    } // End >> fun::login()






    /**
     * Método responsável por montar a página de sair para o
     * vendedor e o administrador.
     * ------------------------------------------------------
     * @url /sair
     */
    public function sair()
    {
        // Destroi a session
        session_destroy();

        // Chama a página de sair
        $this->view("site/acesso/sair");

    }// End >> fun::sair()




} // END::Class Site