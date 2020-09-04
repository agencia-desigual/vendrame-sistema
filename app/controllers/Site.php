<?php

// NameSpace
namespace Controller;

// Importação
use Helper\Apoio;
use Model\AtributoProduto;
use Model\Categoria;
use Model\FichaTecnica;
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
    private $objModelFichaTecnica;
    private $objModelAtributo;
    private $objModelAtributoProduto;


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
        $this->objModelFichaTecnica = new FichaTecnica();
        $this->objModelAtributo = new \Model\Atributo();
        $this->objModelAtributoProduto = new AtributoProduto();

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
        $categoriasMarca = null;

        // Verificando se o usuario está logado
        $usuario = $this->objHelperApoio->seguranca();



        // ==============================================================
        // FILTROS ======================================================

        // Array de filtros na url
        $filtro = [
            "busca" => "",
            "marca" => "",
            "categoria" => "",
            "order" => ""
        ];

        // URL
        $url = BASE_URL . "produtos?c=true";

        // Monta o SQL
        $sql = "SELECT * FROM produto WHERE status = true";

        // Verifica se tem filtro por categoria
        if(!empty($_GET["categoria"]))
        {
            // Busca a categoria
            $categoria = $this->objModelCategoria
                ->get(["id_categoria" => $_GET["categoria"]])
                ->fetch(\PDO::FETCH_OBJ);

            // Verifica se encontrou algo
            if(!empty($categoria))
            {
                // Busca todos os filhos
                $categoria = $this->objHelperApoio->getCategorias(null, $_GET["categoria"]);

                $ids = "";

                foreach ($categoria as $cat)
                {
                    // Concatena todas as categorias PAI
                    $ids .= $cat->id_categoria.',';

                    // Verifica se tem FILHOS
                    if (!empty($cat->filhos))
                    {
                        // Percorre todas as categorias FILHOS
                        foreach ($cat->filhos as $filho)
                        {
                            // Concatena todos as categorias FILHOS
                            $ids .= $filho->id_categoria.',';
                        }
                    }
                }

                // Removendo o ultimo caractere que sempre vai ser a ","
                $ids = substr($ids, 0, -1);

                // Monta a sql
                $sql .= " AND id_categoria IN({$ids})";

                // Add na url
                $url .= "&categoria=" . $_GET["categoria"];

                // Item para formação de novas urls
                $filtro["categoria"] = "&cat=" . $_GET['categoria'];
            }

            // Verifica se tem marca na url
            if (!empty($_GET['marca']))
            {
                // Busca todas as categorias da marca
                $categoriasMarca = $this->objHelperApoio->getCategorias($_GET['marca'],$_GET['categoria']);
            }
            else
            {
                // Busca todas as categorias da marca
                $categoriasMarca = $this->objHelperApoio->getCategorias("",$_GET['categoria']);
            }
        }

        // Verifica se fez uma busca por texto
        if(!empty($_GET["busca"]))
        {
            // Add a query
            $sql .= " AND nome LIKE '%{$_GET["busca"]}%'";

            // Add na url
            $url .= "&busca=" . $_GET["busca"];

            // Item para formação de novas urls
            $filtro["busca"] = "&b=" . $_GET['busca'];
        }

        // Verifica se fez uma busca por marca
        if(!empty($_GET["marca"]))
        {
            // Add a query
            $sql .= " AND id_marca = {$_GET["marca"]}";

            // Add na url
            $url .= "&marca=" . $_GET["marca"];

            // Item para formação de novas urls
            $filtro["marca"] = "&marca=" . $_GET['marca'];


            // Verifica se tem categoria na url
            if (!empty($_GET['categoria']))
            {
                // Busca todas as categorias da marca
                $categoriasMarca = $this->objHelperApoio->getCategorias($_GET['marca'],$_GET['categoria']);
            }
            else
            {
                // Busca todas as categorias da marca
                $categoriasMarca = $this->objHelperApoio->getCategorias($_GET['marca']);
            }

        }



        // ==============================================================
        // PAGINAÇÃO ====================================================

        // Url
        $urlPaginacao = $url . "&";

        // Recupera os dados get
        $get = $_GET;

        // Group By
        $sql .= " GROUP BY id_produto";

        // Ordem de exibição
        if(!empty($_GET["order"]))
        {
            // Verifica como deve ordernar
            switch ($_GET["order"])
            {
                case "recente":
                    $sql .= " ORDER BY id_produto DESC";

                    // Add na url
                    $url .= "&order=recente";

                    // Item para formação de novas urls
                    $filtro["order"] = "&order=recente";
                    break;

                case "menor-preco":
                    $sql .= " ORDER BY valorVenda ASC";

                    // Add na url
                    $url .= "&order=" . $_GET["order"];

                    // Item para formação de novas urls
                    $filtro["order"] = "&order=" . $_GET['order'];
                    break;

                case "maior-preco":
                    $sql .= " ORDER BY valorVenda DESC";

                    // Add na url
                    $url .= "&order=" . $_GET["order"];

                    // Item para formação de novas urls
                    $filtro["order"] = "&order=" . $_GET['order'];
                    break;

                case "antigo":
                    $sql .= " ORDER BY id_produto ASC";

                    // Add na url
                    $url .= "&order=" . $_GET["order"];

                    // Item para formação de novas urls
                    $filtro["order"] = "&order=" . $_GET['order'];
                    break;

                default:
                    $sql .= " ORDER BY valorVenda ASC";

                    // Add na url
                    $url .= "&order=" . $_GET["order"];

                    // Item para formação de novas urls
                    $filtro["order"] = "&order=" . $_GET['order'];
                    break;
            }
        }
        else
        {
            // Sql - Ordena pelos mais recentes
            $sql .= " ORDER BY valorVenda ASC";
        }

        // Informações sobre paginação ---------------------------
        $pag = (isset($get["pag"])) ? $get["pag"] : 1;
        $limite = NUM_PAG;

        // Atribui a variável inicio, o inicio de onde os registros vão ser mostrados
        // por página, exemplo 0 à 10, 11 à 20 e assim por diante
        $inicio = ($pag * $limite) - $limite;



        // ==============================================================
        // BUSCAS =======================================================

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

        // Busca todos os produtos
        $produtos = $this->objModelProduto
            ->query($sql . " LIMIT {$inicio},{$limite}")
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
                    $produto->imagem = $produto->imagem[0]->imagem;
                }
            }
        }

        // Total de resultados
        $total = $this->objModelProduto
            ->query($sql)
            ->rowCount();

        // Total de páginas
        $totalPaginas = $total / $limite;
        $totalPaginas = ceil($totalPaginas);

        // Dados da view
        $dados = [
            "usuario" => $usuario,
            "filtro" => $filtro,
            "marcas" => $marcas,
            "categorias" => $categoriasMarca,
            "produtos" => $produtos,
            "qtdeProdutos" => count($produtos),
            "paginacao" => [
                "url" => $urlPaginacao,
                "pag" => $pag,
                "total" => $totalPaginas,
                "total_itens" => $total
            ],
            "js" => [
                "modulos" => ["Produto"]
            ]
        ];


        // Carrega a view
        $this->view("site/produtos", $dados);

    } // End >> fun::produtos()



    /**
     * Método responsável por montar a página inicial do
     * catalogo de produtos
     * ------------------------------------------------------
     * @url produto-detalhes{id}
     */
    public function produtoDetalhes($id = null)
    {

        // Variaveis
        $dados = null;
        $usuario = null;
        $fichaTecnica = null;

        // Verificando se o usuario está logado
        $usuario = $this->objHelperApoio->seguranca();

        // Busca o produto
        $produto = $this->objModelProduto
            ->get(["id_produto" => $id]);

        // Verifica se encontrou o produto
        if ($produto->rowCount() == 1)
        {
            // Busca todos os dados do produto
            $produto = $produto->fetch(\PDO::FETCH_OBJ);

            // Busca todas as imagens do produtos
            $imagens = $this->objHelperApoio->getImagem($produto->id_produto,"produto");
            $produto->imagem = $imagens;

            // Busca todas as as categorias do produto
            $categoria = $this->objHelperApoio->getCategoriasLista($produto->id_categoria);
            $produto->categoria = $categoria;

            // Busca a ficha tecnica
            $fichaTecnica = $this->objModelFichaTecnica
                ->get(["id_produto" => $produto->id_produto])
                ->fetchAll(\PDO::FETCH_OBJ);

            // Busca os atributos
            $atributos = $this->objModelAtributoProduto
                ->get(["id_produto" => $produto->id_produto])
                ->fetchAll(\PDO::FETCH_OBJ);

            // Verifica se tem algum atirbuto
            if(!empty($atributos))
            {
                foreach ($atributos as $atributo)
                {
                    // Busca os detalhes do atributo
                    $detalhes = $this->objModelAtributo
                        ->get(["id_atributo" => $atributo->id_atributo])
                        ->fetch(\PDO::FETCH_OBJ);

                    if (empty($detalhes->imagem))
                    {
                        $detalhes->imagem = BASE_STORAGE . 'atributo/padrao.png';
                    }
                    else
                    {
                        $detalhes->imagem = BASE_STORAGE . 'atributo/'.$detalhes->imagem;
                    }

                    // Vincula os detalhes ao atributo
                    $atributo->detalhes = $detalhes;
                }
            }

            //$this->debug($atributos);

            $dados = [
                "produto" => $produto,
                "fichaTecnica" => $fichaTecnica,
                "atributos" => $atributos
            ];

            $this->view("site/produto-detalhe", $dados);

        }
        else
        {
            // Redireciona para a pagina com filtros
            header('Location: '.BASE_URL.'produtos');
        }

    }


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