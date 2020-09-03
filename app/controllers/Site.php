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
    private $objModelMarca;
    private $objModelCategoria;
    private $objModelProduto;


    // Método construtor
    function __construct()
    {
        // Carrega o contrutor da classe pai
        parent::__construct();

        // Instancia os objetos
        $this->objHelperApoio = new Apoio();
        $this->objModelMarca = new Marca();
        $this->objModelCategoria = new Categoria();
        $this->objModelProduto = new \Model\Produto();

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
     * Método responsável por montar a página inicial do
     * catalogo de produtos
     * ------------------------------------------------------
     * @url produtos
     */
    public function produtos($id = null)
    {
        // Variaveis
        $dados = null;
        $usuario = null;
        $marcas = null;
        $categorias = null;
        $where = null;

        // Verificando se o usuario está logado
        $usuario = $this->objHelperApoio->seguranca();

        // Busca todas as marcas
        $marcas = $this->objModelMarca
            ->get()
            ->fetchAll(\PDO::FETCH_OBJ);

        // Verificando se encontrou
        if (!empty($marcas))
        {
            // Busca a logo da marca
            foreach ($marcas as $marca)
            {
                // Vincula a logo
                $marca->logo = $this->objHelperApoio->getImagem($marca->id_marca,"marca");
            }
        }

        // Busca todas as categorias
        $categorias = $this->objHelperApoio->getCategorias($id);

        // Verifica se tem filtro de categoria
        if (!empty($id))
        {
            // Variaveis
            $ids = "";

            // Percorre todas as categorias
            foreach ($categorias as $categoria)
            {
                // Concatena todas as categorias PAI
                $ids .= $categoria->id_categoria.',';

                // Verifica se tem FILHOS
                if (!empty($categoria->filhos))
                {
                    // Percorre todas as categorias FILHOS
                    foreach ($categoria->filhos as $filho)
                    {
                        // Concatena todos as categorias FILHOS
                        $ids .= $filho->id_categoria.',';
                    }
                }
            }

            // Removendo o ultimo caractere que sempre vai ser a ","
            $ids = substr($ids, 0, -1);

            // Monta a query WHERE
            $where = ["id_categoria" => "IN({$ids})"];
        }

        // Busca todos os produtos
        $produtos = $this->objModelProduto
            ->get($where)
            ->fetchAll(\PDO::FETCH_OBJ);

        // Verifica se tem produto
        if (!empty($produtos))
        {
            foreach ($produtos as $produto)
            {
                $produto->imagem = $this->objHelperApoio
                    ->getImagem($produto->id_produto, "produto");

                if (is_array($produto->imagem))
                {
                    $produto->imagem = BASE_STORAGE.'produto/'.$produto->id_produto.'/'.$produto->imagem[0]->imagem;
                }
            }
        }

        // Dados da view
        $dados = [
            "usuario" => $usuario,
            "marcas" => $marcas,
            "categorias" => $categorias,
            "produtos" => $produtos,
            "qtdeProdutos" => count($produtos),
            "js" => [
                "modulos" => ["Produto"]
            ]
        ];

        // Carrega a view
        $this->view("site/produtos", $dados);

    } // End >> fun::produtos()



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