<?php
/**
 * Created by PhpStorm.
 * User: Igor
 * Date: 15/04/2020
 * Time: 15:21
 */

// NameSpace
namespace Controller\Api;

// Importação
use Helper\Apoio;
use Model\Produto;
use Sistema\Controller;
use Sistema\Helper\File;
use Sistema\Helper\Input;
use Sistema\Helper\Seguranca;

// Classe
class Categoria extends Controller
{
    // Objeto
    private $objModelCategoria;
    private $objModelProduto;

    private $objHelperApoio;
    private $objSeguranca;
    private $objInput;

    // Usuario
    private $usuario;

    // Método construtor
    public function __construct()
    {
        // Chama o pai
        parent::__construct();

        // Instancia os objeto
        $this->objModelProduto = new Produto();
        $this->objModelCategoria = new \Model\Categoria();

        $this->objHelperApoio = new Apoio();
        $this->objSeguranca = new Seguranca();
        $this->objInput = new Input();

        // Seguranca
        $this->usuario = $this->objSeguranca->security();

    } // End >> fun::__construct()



    /**
     * Método responsável por retornar um endereco especifico e suas
     * FK, deve ser informado via paramento o ID do item.
     * -----------------------------------------------------------------
     * @param $id
     * -----------------------------------------------------------------
     * @author igorcacerez
     * @url api/categoria/get/[ID]
     * @method GET
     */
    public function get($id)
    {
        // Variaveis
        $dados = null;
        $objeto = null;

        // Busca o Objeto com páginacao
        $objeto = $this->objModelCategoria->get(["id_categoria" => $id]);

        // Fetch
        $total = $objeto->rowCount();
        $objeto = $objeto->fetch(\PDO::FETCH_OBJ);

        // Monta o array de retorno
        $dados = [
            "tipo" => true,
            "code" => 200,
            "objeto" => [
                "total" => $total,
                "item" => $objeto,
            ]
        ];

        // Retorna
        $this->api($dados);

    } // End >> fun::get()



    /**
     * Método responsável por retornar todos os usuários cadastrados
     * no sistema, podendo informar a ordem, limit e where.
     * -----------------------------------------------------------------
     * @author igorcacerez
     * -----------------------------------------------------------------
     * @url api/categoria/get
     * @method GET
     */
    public function getAll()
    {
        // Variaveis
        $dados = null;
        $objeto = null;
        $ordem = null;
        $where = null;

        // Variaveis Paginação
        $pag = (isset($_GET["pag"])) ? $_GET["pag"] : 1;
        $limite = (isset($_GET["limit"])) ? $_GET["limit"] : NUM_PAG;

        // Variveis da busca
        $orderBy = (isset($_GET["order_by"])) ? $_GET["order_by"] : null;
        $orderTipo = (isset($_GET["order_by_type"])) ? $_GET["order_by_type"] : "ASC";

        // Verifica se retornou o where
        $where = (isset($_GET["where"])) ? $_GET["where"] : null;

        // Verifica se foi informado a ordem
        if($orderBy != null)
        {
            // cria a ordem
            $ordem = $orderBy . " " . $orderTipo;
        }

        // Atribui a variável inicio, o inicio de onde os registros vão ser mostrados
        // por página, exemplo 0 à 10, 11 à 20 e assim por diante
        $inicio = ($pag * $limite) - $limite;

        // Busca o Objeto com páginacao
        $objeto = $this->objModelCategoria->get($where, $ordem, ($inicio . "," . $limite));

        // Fetch - Total
        $total = $objeto->rowCount();
        $objeto = $objeto->fetchAll(\PDO::FETCH_OBJ);

        // Monta o array de retorno
        $dados = [
            "tipo" => true,
            "code" => 200,
            "objeto" => [
                "total" => $total,
                "pagina" => $pag,
                "itens" => $objeto,
            ]
        ];

        // Retorna
        $this->api($dados);

    } // End >> fun::getAll()


    /**
     * Método responsável por inserir uma nova categoria.
     * Apenas usuários administradores podem realizar essa ação.
     * -----------------------------------------------------------------
     * @author igorcacerez
     * -----------------------------------------------------------------
     * @url api/categoria/insert
     * @method POST
     */
    public function insert()
    {
        // Variaveis
        $dados = null;
        $usuario = null;
        $post = null;
        $arquivo = null;
        $categoria = null;

        // Recupera o usuário
        $usuario = $this->usuario;

        // Busca os dados post
        $post = $_POST;

        // Verifica se o usuário possui permissão
        if($usuario->nivel == "admin")
        {
            // Verifica se informou os dados obrigatórios
            if(!empty($post["nome"]))
            {
                // Verifica se informou o pai
                if(isset($post["id_categoria_pai"]) && $post["id_categoria_pai"] == 0)
                {
                    // Remove
                    unset($post["id_categoria_pai"]);
                }

                // Insere
                $categoria = $this->objModelCategoria->insert($post);

                // Verifica se inseriu
                if($categoria != false)
                {
                    // Busca a categoria inserida
                    $categoria = $this->objModelCategoria
                        ->get(["id_categoria" => $categoria])
                        ->fetch(\PDO::FETCH_OBJ);

                    // Array de sucesso
                    $dados = [
                        "tipo" => true,
                        "code" => 200,
                        "mensagem" => "Categoria adicionada com sucesso.",
                        "objeto" => $categoria
                    ];
                }
                else
                {
                    if(!empty($arquivo))
                    {
                        // Deleta a imagem
                        unlink("./storage/categoria/" . $arquivo);
                    }

                    // Msg
                    $dados = ["mensagem" => "Ocorreu um erro ao inserir a categoria."];

                } // Error >> Ocorreu um erro ao inserir a categoria.
            }
            else
            {
                // Msg
                $dados = ["mensagem" => "Campos obrigatórios não informados."];

            } // Error >> Campos obrigatórios não informados.
        }
        else
        {
            // Msg
            $dados = ["mensagem" => "Você não possui permissão."];

        } // Error >> Usuário sem permissão

        // Retorno
        $this->api($dados);

    } // End >> fun::insert()


    /**
     * Método responsável por alterar uma determinada categoria.
     * Apenas usuários administradores podem realizar essa ação.
     * -----------------------------------------------------------------
     * @author igorcacerez
     * -----------------------------------------------------------------
     * @param int $id [id da categoria]
     * -----------------------------------------------------------------
     * @url api/categoria/update/[ID]
     * @method POST
     */
    public function update($id)
    {
        // Variaveis
        $dados = null;
        $usuario = null;
        $post = null;
        $categoria = null;
        $categoriaAlterada = null;

        // Recupera o usuário
        $usuario = $this->usuario;

        // Recupera os dados do post
        $post = $_POST;

        // Busca a categoria
        $categoria = $this->objModelCategoria
            ->get(["id_categoria" => $id])
            ->fetch(\PDO::FETCH_OBJ);

        // Verifica se encontrou a categoria
        if(!empty($categoria))
        {
            // Verifica se o usuário possui permissão
            if($usuario->nivel == "admin")
            {
                // Remove os dados inauteraveis
                unset($post["id_categoria"]);

                // Verifica se vai alterar o pai
                if(isset($post["id_categoria_pai"]) && $post["id_categoria_pai"] == 0)
                {
                    // Deixa como null
                    $post["id_categoria_pai"] = null;
                }

                // Altera os dados
                if($this->objModelCategoria->update($post, ["id_categoria" => $id]) != false)
                {
                    // Busca a categoria alterada
                    $categoriaAlterada = $this->objModelCategoria
                        ->get(["id_categoria" => $id])
                        ->fetch(\PDO::FETCH_OBJ);

                    // Array de sucesso
                    $dados = [
                        "tipo" => true,
                        "code" => 200,
                        "mensagem" => "Categoria alterada com sucesso.",
                        "objeto" => [
                            "antes" => $categoria,
                            "atual" => $categoriaAlterada
                        ]
                    ];

                }
                else
                {
                    // Msg
                    $dados = ["mensagem" => "Ocorreu um erro ao alterar a categoria."];

                } // Error >> Ocorreu um erro ao alterar a categoria.
            }
            else
            {
                // Msg
                $dados = ["mensagem" => "Usuário sem permissão."];

            } // Error >> Usuário sem permissão.
        }
        else
        {
            // Msg
            $dados = ["mensagem" => "Categorias informada não foi encontrada."];

        } // Error >> Categorias informada não foi encontrada.

        // Retorno
        $this->api($dados);

    } // End >> fun::update()



    /**
     * Método responsável por deletar uma determinada categoria.
     * Apenas usuários administradores podem realizar essa ação.
     * -----------------------------------------------------------------
     * @author igorcacerez
     * -----------------------------------------------------------------
     * @param int $id [id da categoria]
     * -----------------------------------------------------------------
     * @url api/categoria/delete/[ID]
     * @method DELETE
     */
    public function delete($id)
    {
        // Variaveis
        $dados = null;
        $usuario = null;
        $categoria = null;

        // Recupera o usuario
        $usuario = $this->usuario;

        // Busca a categoria
        $categoria = $this->objModelCategoria
            ->get(["id_categoria" => $id])
            ->fetch(\PDO::FETCH_OBJ);

        // Verifica se encontrou a categoria
        if(!empty($categoria))
        {
            // Verifica se o usuário possui permissão
            if($usuario->nivel == "admin")
            {
                // Verifica se possui categorias vinculadas
                if($this->objModelCategoria->get(["id_categoria_pai" => $id])->rowCount() == 0)
                {
                    // Verifica se possui produto nessa categoria
                    if($this->objModelProduto->get(["id_categoria" => $id])->rowCount() == 0)
                    {
                        // Deleta
                        if($this->objModelCategoria->delete(["id_categoria" => $id]) != false)
                        {
                            // Array de retorno
                            $dados = [
                                "tipo" => true,
                                "code" => 200,
                                "mensagem" => "Categorias deletada com sucesso.",
                                "objeto" => $categoria
                            ];
                        }
                        else
                        {
                            // Msg
                            $dados = ["mensagem" => "Ocorreu um erro ao deletar categoria."];
                        } // Error >> Ocorreu um erro ao deletar categoria.
                    }
                    else
                    {
                        // Msg
                        $dados = ["mensagem" => "A categoria possui produtos vinculados."];

                    } // Error >> A categoria possui produtos vinculados.
                }
                else
                {
                    // Msg
                    $dados = ["mensagem" => "A categoria possui outras categorias vinculadas."];
                } // Error >> A categoria possui outras categorias vinculadas.
            }
            else
            {
                // Msg
                $dados = ["mensagem" => "Usuário não possui permissão."];

            } // Error >> Usuário não possui permissão
        }
        else
        {
            // Msg
            $dados = ["mensagem" => "Categorias informada não foi encontrada."];

        } // Error >> Categorias informada não foi encontrada.

        // Retorno
        $this->api($dados);

    } // End >> fun::delete();
    
} // End >> Classe::Api\Categorias