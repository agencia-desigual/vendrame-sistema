<?php

// NameSpace
namespace Controller;

// Importação
use Helper\Apoio;
use Model\Categoria;
use Model\Marca;
use Model\Usuario;
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
     * Método responsável por montar a página inicial do
     * painel administrativo.
     * -------------------------------------------------------
     * @url painel
     */
    public function dashboard()
    {
        // Variaveis
        $dados = null;
        $usuario = null;

        // Objetos
        $objModelCategoria = new Categoria();
        $objModelProduto = new \Model\Produto();
        $objModelMarca = new Marca();
        $objModelUsuario = new Usuario();

        // Recupera o usuário
        $usuario = $this->objHelperApoio->seguranca();

        // Verifica se é admin
        if($usuario->nivel == "admin")
        {
            // Contadores
            $numCategoria = $objModelCategoria
                ->get()
                ->rowCount();

            $numProduto = $objModelProduto
                ->get()
                ->rowCount();

            $numMarca = $objModelMarca
                ->get()
                ->rowCount();

            $numUsuario = $objModelUsuario
                ->get()
                ->rowCount();

            // Busca os ultimos produtos
            $produtos = $objModelProduto
                ->get(null, "id_produto DESC", 7)
                ->fetchAll(\PDO::FETCH_OBJ);

            // Busca as marcas
            $marcas = $objModelMarca
                ->get(null, "id_marca DESC", 7)
                ->fetchAll(\PDO::FETCH_OBJ);

            // Dados
            $dados = [
                "numCategoria" => $numCategoria,
                "numProduto" => $numProduto,
                "numMarca" => $numMarca,
                "numUsuario" => $numUsuario,
                "produtos" => $produtos,
                "marcas" => $marcas,
                "usuario" => $usuario,
            ];

            $this->view("painel/dashboard", $dados);
        }
        else
        {
            // Redireciona para a home
            header("Location: " . BASE_URL);
        } // Error >> Usuário sem permissão

    } // End >> fun::dashboard()



    /**
     * Método responsável por montar a página de produtos do
     * catalogo, já com todos os filtros
     * ------------------------------------------------------
     * @url produtos
     */
    public function produtos()
    {

        // Variaveis
        $dados = null;
        $view = "";
        $usuario = null;

        $_SESSION["usuario"] = "Edilson";

        // Verificando se o usuario está logado
        $usuario = (!empty($_SESSION["usuario"])) ? $_SESSION["usuario"] : null;

        if (!empty($usuario))
        {

            // Busca as marcas
            $marcas = null;

            // View correta
            $view = "site/index";

            // As tags SEO e SMO
            $seo = $this->getSEO();

            // Dados da view
            $dados = [
                "seo" => $seo["seo"],
                "smo" => $seo["smo"],
                "usuario" => $usuario,
                "marcas" => $marcas,
                "js" => [
                    "modulos" => ["Produto"]
                ]
            ];

        }
        else
        {
            // View correta
            $view = "site/acesso/login";

            // As tags SEO e SMO
            $seo = $this->getSEO();

            // Dados da view
            $dados = [
                "seo" => $seo["seo"],
                "smo" => $seo["smo"],
                "js" => [
                    "modulos" => ["Login"]
                ]
            ];
        }

        // Carrega a view
        $this->view($view,$dados);
    }



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



    public function error404()
    {
        echo "ERRO 404";
    }


} // END::Class Site