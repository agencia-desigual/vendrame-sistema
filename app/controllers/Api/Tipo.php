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
use Model\View\CategoriaFilha;
use Sistema\Controller;
use Sistema\Helper\File;
use Sistema\Helper\Input;
use Sistema\Helper\Seguranca;

// Classe
class  Tipo extends Controller
{
    // Objeto
    private $objModelTipo;
    private $objModelProduto;
    private $objModelMarca;

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
        $this->objModelTipo = new \Model\Tipo();
        $this->objModelMarca = new \Model\Marca();

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
        $objeto = $this->objModelTipo->get(["id_tipo" => $id]);

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
        $objeto = $this->objModelTipo->get($where, $ordem, ($inicio . "," . $limite));

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
        $categoria = null;

        // Recupera o usuário
        $usuario = $this->usuario;

        // Busca os dados post
        $post = $_POST;

        // Verifica se o usuário possui permissão
        if($usuario->nivel == "admin")
        {
            // Verifica se informou os dados obrigatórios
            if(!empty($post["nome"]) &&
                !empty($post["id_marca"]))
            {
                // Busca a marca
                $marca = $this->objModelMarca
                    ->get(["id_marca" => $post["id_marca"]])
                    ->fetch(\PDO::FETCH_OBJ);

                // Verifica se a marca existe
                if(!empty($marca))
                {
                    // Insere
                    $tipo = $this->objModelTipo->insert($post);

                    // Verifica se inseriu
                    if($tipo != false)
                    {
                        // Busca a categoria inserida
                        $tipo = $this->objModelTipo
                            ->get(["id_tipo" => $tipo])
                            ->fetch(\PDO::FETCH_OBJ);

                        // Array de sucesso
                        $dados = [
                            "tipo" => true,
                            "code" => 200,
                            "mensagem" => "Tipo adicionado com sucesso.",
                            "objeto" => $categoria
                        ];
                    }
                    else
                    {
                        // Msg
                        $dados = ["mensagem" => "Ocorreu um erro ao inserir o tipo."];

                    } // Error >> Ocorreu um erro ao inserir a categoria.
                }
                else
                {
                    // Msg
                    $dados = ["mensagem" => "A marca informada não existe."];
                } // Error >> A marca informada não existe.
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
        $tipo = null;
        $tipoAlterado = null;

        // Recupera o usuário
        $usuario = $this->usuario;

        // Recupera os dados do post
        $post = $_POST;

        // Busca a categoria
        $tipo = $this->objModelTipo
            ->get(["id_tipo" => $id])
            ->fetch(\PDO::FETCH_OBJ);

        // Verifica se encontrou a categoria
        if(!empty($tipo))
        {
            // Verifica se o usuário possui permissão
            if($usuario->nivel == "admin")
            {
                // Remove os dados inauteraveis
                unset($post["id_tipo"]);

                // Altera os dados
                if($this->objModelTipo->update($post, ["id_tipo" => $id]) != false)
                {
                    // Busca a categoria alterada
                    $tipoAlterado = $this->objModelTipo
                        ->get(["id_tipo" => $id])
                        ->fetch(\PDO::FETCH_OBJ);

                    // Array de sucesso
                    $dados = [
                        "tipo" => true,
                        "code" => 200,
                        "mensagem" => "Tipo alterado com sucesso.",
                        "objeto" => [
                            "antes" => $tipo,
                            "atual" => $tipoAlterado
                        ]
                    ];

                }
                else
                {
                    // Msg
                    $dados = ["mensagem" => "Ocorreu um erro ao alterar o tipo."];

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
            $dados = ["mensagem" => "Tipo informado não foi encontrado."];

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
        $tipo = $this->objModelTipo
            ->get(["id_tipo" => $id])
            ->fetch(\PDO::FETCH_OBJ);

        // Verifica se encontrou a categoria
        if(!empty($tipo))
        {
            // Verifica se o usuário possui permissão
            if($usuario->nivel == "admin")
            {
                // Verifica se possui produto nessa categoria
                if($this->objModelProduto->get(["id_tipo" => $id])->rowCount() == 0)
                {
                    // Deleta
                    if($this->objModelTipo->delete(["id_tipo" => $id]) != false)
                    {
                        // Array de retorno
                        $dados = [
                            "tipo" => true,
                            "code" => 200,
                            "mensagem" => "Tipo deletado com sucesso.",
                            "objeto" => $categoria
                        ];
                    }
                    else
                    {
                        // Msg
                        $dados = ["mensagem" => "Ocorreu um erro ao deletar tipo."];
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
                $dados = ["mensagem" => "Usuário não possui permissão."];

            } // Error >> Usuário não possui permissão
        }
        else
        {
            // Msg
            $dados = ["mensagem" => "Tipo informado não foi encontrado."];

        } // Error >> Categorias informada não foi encontrada.

        // Retorno
        $this->api($dados);

    } // End >> fun::delete();
    
} // End >> Classe::Api\Categorias