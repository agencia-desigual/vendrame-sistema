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
    private $objModelTipo;
    private $objModelIndice;
    private $objModelTratamento;


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
        $this->objModelTipo = new \Model\Tipo();
        $this->objModelTratamento = new \Model\Tratamento();
        $this->objModelIndice = new \Model\Indice();

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

        // Busca todas as marcas
        $marcas = $this->objModelMarca
            ->get("","id_marca DESC")
            ->fetchAll(\PDO::FETCH_OBJ);

        if (!empty($marcas))
        {
            foreach ($marcas as $marca)
            {
                $marca->logo = $this->objHelperApoio->getImagem($marca->id_marca,"marca");
            }
        }

        // Dados da view
        $dados = [
            "usuario" => $usuario,
            "marcas" => $marcas,
            "js" => [
                "modulos" => ["Produto"]
            ]
        ];

        // Carrega a view
        $this->view("site/index", $dados);

    } // End >> fun::index()

    private function getIdsCategorias($categoria)
    {
        // Concatena todas as categorias PAI
        $ids = (!empty($categoria->ids) ? $categoria->ids : null);
        $ids .= $categoria->id_categoria.',';

        $categoria->filhos = $this->objModelCategoria
            ->get(['id_categoria_pai' => $categoria->id_categoria])
            ->fetchAll(\PDO::FETCH_OBJ);

        // Verifica se tem FILHOS
        if (!empty($categoria->filhos))
        {
            // Percorre todas as categorias FILHOS
            foreach ($categoria->filhos as $filho)
            {
               // Concatena todos as categorias FILHOS
               $filho->ids = $ids;

               // Pegando os IDS
               $ids =  $this->getIdsCategorias($filho);
            }
        }
         return $ids;
    }

    private function getIdsTipos($tipo)
    {
        // Concatena todas as categorias PAI
        $ids = (!empty($tipo->ids) ? $tipo->ids : null);
        $ids .= $tipo->id_tipo.',';

        $tipo->filhos = $this->objModelTipo
            ->get(['id_tipo_pai' => $tipo->id_tipo])
            ->fetchAll(\PDO::FETCH_OBJ);

        // Verifica se tem FILHOS
        if (!empty($tipo->filhos))
        {
            // Percorre todas as categorias FILHOS
            foreach ($tipo->filhos as $filho)
            {
                // Concatena todos as categorias FILHOS
                $filho->ids = $ids;

                // Pegando os IDS
                $ids =  $this->getIdsTipos($filho);
            }
        }
        return $ids;
    }


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
        $tipo = null;
        $filtroNome = null;

        // Verificando se o usuario está logado
        $usuario = $this->objHelperApoio->seguranca();



        // ==============================================================
        // FILTROS ======================================================

        // Array de filtros na url
        $filtro = [
            "busca" => "",
            "marca" => "",
            "categoria" => "",
            "tipo" => "",
            "indice" => "",
            "tratamento" => "",
            "preco" => "",
            "order" => ""
        ];

        $precos = [
            1 => [
                "nome" => "Até R$100,00",
                "valor" => "valorVenda <= 100"
            ],
            2 => [
                "nome" => "De R$100,00 à R$250,00",
                "valor" => "(valorVenda >= 100 AND valorVenda < 250)"
            ],
            3 => [
                "nome" => "De R$250,00 à R$500,00",
                "valor" => "(valorVenda >= 250 AND valorVenda < 500)"
            ],
            4 => [
                "nome" => "De R$500,00 à R$800,00",
                "valor" => "(valorVenda >= 500 AND valorVenda < 800)"
            ],
            5 => [
                "nome" => "De R$800,00 à R$1100,00",
                "valor" => "(valorVenda >= 800 AND valorVenda < 1100)"
            ],
            6 => [
                "nome" => "De R$1100,00 à R$1600,00",
                "valor" => "(valorVenda >= 100 AND valorVenda < 1600)"
            ],
            7 => [
                "nome" => "De R$1600,00 à R$2100,00",
                "valor" => "(valorVenda >= 1600 AND valorVenda < 2100)"
            ],
            8 => [
                "nome" => "De R$2100,00 à R$2600,00",
                "valor" => "(valorVenda >= 1100 AND valorVenda <= 2600)"
            ],
            9 => [
                "nome" => "Acima de R$2600,00",
                "valor" => "valorVenda >= 2600"
            ],
        ];

        // URL
        $url = BASE_URL . "produtos?c=true";

        // Monta o SQL
        $sql = "SELECT produto.*, 
                    (SELECT nome FROM tipo t WHERE t.id_tipo = produto.id_tipo) as nomeLinha 
                    FROM produto
                        WHERE status = true";

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
               $ids = $this->getIdsCategorias($categoria);

                // Removendo o ultimo caractere que sempre vai ser a ","
                $ids = substr($ids, 0, -1);

                // Monta a sql
                $sql .= " AND id_categoria IN({$ids})";

                // Add na url
                $url .= "&categoria=" . $_GET["categoria"];

                // Item para formação de novas urls
                $filtro["categoria"] = "&categoria=" . $_GET['categoria'];

            }
        }
        else
        {
            // Busca todas as categorias da marca
            $categoriasMarca = $this->objHelperApoio->getCategorias();
        }

        // Verifica se tem filtro por indice
        if(!empty($_GET["indice"]))
        {
            // Busca o indice
            $indice = $this->objModelIndice
                ->get(["id_indice" => $_GET["indice"]])
                ->fetch(\PDO::FETCH_OBJ);

            // Verifica se encontrou algo
            if(!empty($indice))
            {
                // Monta a sql
                $sql .= " AND id_indice = {$indice->id_indice}";

                // Add na url
                $url .= "&indice=" . $_GET["indice"];

                // Item para formação de novas urls
                $filtro["indice"] = "&indice=" . $_GET['indice'];

            }
        }
        else
        {
            // Busca o indice
            $indice = $this->objModelIndice
                ->get()
                ->fetchAll(\PDO::FETCH_OBJ);
        }


        // Verifica se tem filtro por indice
        if(!empty($_GET["tratamento"]))
        {
            // Busca o indice
            $tratamento = $this->objModelTratamento
                ->get(["id_tratamento" => $_GET["tratamento"]],"nome ASC")
                ->fetch(\PDO::FETCH_OBJ);

            // Verifica se encontrou algo
            if(!empty($tratamento))
            {
                // Monta a sql
                $sql .= " AND id_tratamento = {$tratamento->id_tratamento}";

                // Add na url
                $url .= "&tratamento=" . $_GET["tratamento"];

                // Item para formação de novas urls
                $filtro["tratamento"] = "&tratamento=" . $_GET['tratamento'];

            }
        }
        else
        {
            // Busca o indice
            $tratamento = $this->objModelTratamento
                ->get(null, "nome ASC")
                ->fetchAll(\PDO::FETCH_OBJ);
        }


        // Verifica se tem filtro por indice
        if(!empty($_GET["preco"]))
        {
            // Busca o indice
            $precoAux = $precos[$_GET["preco"]];

            // Verifica se encontrou algo
            if(!empty($precoAux))
            {
                // Monta a sql
                $sql .= " AND " . $precoAux["valor"];

                // Add na url
                $url .= "&preco=" . $_GET["preco"];

                // Item para formação de novas urls
                $filtro["preco"] = "&preco=" . $_GET['preco'];

            }
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

            // Busca todos os tipos da marca
            $tipo = $this->objHelperApoio->getTipos("",$_GET['marca']);
        }

        // Verifica se fez uma busca por marca
        if(!empty($_GET["tipo"]))
        {
            // Busca a categoria
            $tipo = $this->objModelTipo
                ->get(["id_tipo" => $_GET["tipo"]], "nome ASC")
                ->fetch(\PDO::FETCH_OBJ);

            // Verifica se encontrou algo
            if(!empty($tipo))
            {
                $ids = $this->getIdsTipos($tipo);

                // Removendo o ultimo caractere que sempre vai ser a ","
                $ids = substr($ids, 0, -1);

                // Monta a sql
                $sql .= " AND id_tipo IN({$ids})";

                // Add na url
                $url .= "&tipo=" . $_GET["tipo"];

                // Item para formação de novas urls
                $filtro["tipo"] = "&tipo=" . $_GET['tipo'];

            }

            // Busca todos os tipos da marca
            $tipo = $this->objHelperApoio->getTipos($_GET['tipo'],$_GET['marca']);
        }

        // Verifica se fez uma busca por texto
        if(!empty($_GET["busca"]))
        {
            // Add a query
            $sql .= " AND nome LIKE '%{$_GET["busca"]}%'";

            // Add na url
            $url .= "&busca=" . $_GET["busca"];

            // Item para formação de novas urls
            $filtro["busca"] = "&busca=" . $_GET['busca'];

            // Vincula o nome
            $filtroNome["busca"] = $_GET['busca'];
        }



        // ==============================================================
        // PAGINAÇÃO ====================================================

        // Recupera os dados get
        $get = $_GET;

        // Group By
        $sql .= " GROUP BY id_produto";

        // Ordem de exibição
//        if(!empty($_GET["order"]))
//        {
//            // Verifica como deve ordernar
//            switch ($_GET["order"])
//            {
//                case "recente":
//                    $sql .= " ORDER BY id_produto DESC";
//
//                    // Add na url
//                    $url .= "&order=recente";
//
//                    // Item para formação de novas urls
//                    $filtro["order"] = "&order=recente";
//                    break;
//
//                case "menor-preco":
//                    $sql .= " ORDER BY valorVenda ASC";
//
//                    // Add na url
//                    $url .= "&order=" . $_GET["order"];
//
//                    // Item para formação de novas urls
//                    $filtro["order"] = "&order=" . $_GET['order'];
//                    break;
//
//                case "maior-preco":
//                    $sql .= " ORDER BY valorVenda DESC";
//
//                    // Add na url
//                    $url .= "&order=" . $_GET["order"];
//
//                    // Item para formação de novas urls
//                    $filtro["order"] = "&order=" . $_GET['order'];
//                    break;
//
//                case "antigo":
//                    $sql .= " ORDER BY id_produto ASC";
//
//                    // Add na url
//                    $url .= "&order=" . $_GET["order"];
//
//                    // Item para formação de novas urls
//                    $filtro["order"] = "&order=" . $_GET['order'];
//                    break;
//
//                default:
//                    $sql .= " ORDER BY valorVenda ASC";
//
//                    // Add na url
//                    $url .= "&order=" . $_GET["order"];
//
//                    // Item para formação de novas urls
//                    $filtro["order"] = "&order=" . $_GET['order'];
//                    break;
//            }
//        }
//        else
//        {
//            // Sql - Ordena pelos mais recentes
//            $sql .= " ORDER BY valorVenda ASC";
//        }


        $sql .= " ORDER BY nomeLinha ASC";

        // Url
        $urlPaginacao = $url . "&";

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
                $produto->linha = $this->objModelTipo
                    ->get(["id_tipo" => $produto->id_tipo])
                    ->fetch(\PDO::FETCH_OBJ);
            }
        }

        // Total de resultados
        $total = $this->objModelProduto
            ->query($sql)
            ->rowCount();

        // Total de páginas
        $totalPaginas = $total / $limite;
        $totalPaginas = ceil($totalPaginas);

        // Veirificando os filtros
        if (!empty($filtro))
        {
            if (!empty($filtro['marca']))
            {
                $idMarca = explode("=",$filtro['marca']);
                $idMarca = $idMarca['1'];

                // Busca o nome da marca
                $nomeMarca = $this->objModelMarca
                    ->get(['id_marca' => $idMarca])
                    ->fetch(\PDO::FETCH_OBJ);

                // Vincula o nome
                $filtroNome["marca"] = $nomeMarca->nome;

            }

            if (!empty($filtro['indice']))
            {
                $idIndice = explode("=",$filtro['indice']);
                $idIndice = $idIndice['1'];

                // Busca o nome da marca
                $nomeIndice = $this->objModelIndice
                    ->get(['id_indice' => $idIndice])
                    ->fetch(\PDO::FETCH_OBJ);

                // Vincula o nome
                $filtroNome["indice"] = $nomeIndice->nome;

            }

            if (!empty($filtro['tratamento']))
            {
                $idTratamento = explode("=",$filtro['tratamento']);
                $idTratamento = $idTratamento['1'];

                // Busca o nome da marca
                $nomeTratamento = $this->objModelTratamento
                    ->get(['id_tratamento' => $idTratamento])
                    ->fetch(\PDO::FETCH_OBJ);

                // Vincula o nome
                $filtroNome["tratamento"] = $nomeTratamento->nome;

            }

            if (!empty($filtro['categoria']))
            {
                $idCategoria = explode("=",$filtro['categoria']);
                $idCategoria = $idCategoria['1'];

                // Busca o nome da marca
                $nomeCategoria = $this->objHelperApoio->getCategoriasLista($idCategoria,'');

                // Vincula o nome
                if (!empty($nomeCategoria[0]->sub))
                {
                    $filtroNome["categoria"] = $nomeCategoria[0]->sub;

                }
                else
                {
                    $filtroNome["categoria"] = $nomeCategoria[0]->nome;

                }

            }

            if (!empty($filtro['tipo']))
            {
                $idTipo = explode("=",$filtro['tipo']);
                $idTipo = $idTipo['1'];

                // Busca o nome da marca
                $nomeTipo = $this->objHelperApoio->getTiposLista($idTipo,"");

                // Vincula o nome
                if (!empty($nomeTipo[0]->sub))
                {
                    $filtroNome["tipo"] = $nomeTipo[0]->sub;

                }
                else
                {
                    $filtroNome["tipo"] = $nomeTipo[0]->nome;

                }

            }

            if (!empty($filtro['preco']))
            {
                $idpreco = explode("=",$filtro['preco']);
                $idpreco = $idpreco['1'];

                // Vincula o nome
                $filtroNome["preco"] = $precos[$idpreco]["nome"];
            }
        }


        // Dados da view
        $dados = [
            "usuario" => $usuario,
            "filtro" => $filtro,
            "tipos" => $tipo,
            "indices" => $indice,
            "tratamentos" => $tratamento,
            "precos" => $precos,
            "marcas" => $marcas,
            "categorias" => $categoriasMarca,
            "produtos" => $produtos,
            "qtdeProdutos" => count($produtos),
            "filtroNome" => $filtroNome,
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

//            $this->debug($usuario);

            $dados = [
                "usuario" => $usuario,
                "produto" => $produto,
                "fichaTecnica" => $fichaTecnica,
                "atributos" => $atributos,
                "js" => [
                    "modulos" => ["Produto"]
                ]
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