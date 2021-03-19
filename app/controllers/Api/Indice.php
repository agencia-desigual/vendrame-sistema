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
class Indice extends Controller
{
    // Objeto
    private $objModelIndice;
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
        $this->objModelCategoria = new \Model\Indice();
        $this->objModelMarca = new \Model\Marca();

        $this->objHelperApoio = new Apoio();
        $this->objSeguranca = new Seguranca();
        $this->objInput = new Input();

        // Seguranca
        $this->usuario = $this->objSeguranca->security();

    } // End >> fun::__construct()


    /**
     * Método responsável por inserir uma nova categoria.
     * Apenas usuários administradores podem realizar essa ação.
     * -----------------------------------------------------------------
     * @author igorcacerez
     * -----------------------------------------------------------------
     * @url api/indice/insert
     * @method POST
     */
    public function insert()
    {
        // Variaveis
        $dados = null;
        $usuario = null;
        $post = null;
        $arquivo = null;
        $indice = null;

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
                // Insere
                $indice = $this->objModelIndice->insert($post);

                // Verifica se inseriu
                if($indice != false)
                {
                    // Busca a categoria inserida
                    $indice = $this->objModelIndice
                        ->get(["id_indice" => $indice])
                        ->fetch(\PDO::FETCH_OBJ);

                    // Array de sucesso
                    $dados = [
                        "tipo" => true,
                        "code" => 200,
                        "mensagem" => "Adicionado com sucesso.",
                        "objeto" => $indice
                    ];
                }
                else
                {
                    // Msg
                    $dados = ["mensagem" => "Ocorreu um erro ao inserir."];

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
     * @param int $id [id]
     * -----------------------------------------------------------------
     * @url api/indice/update/[ID]
     * @method POST
     */
    public function update($id)
    {
        // Variaveis
        $dados = null;
        $usuario = null;
        $post = null;
        $indice = null;
        $indiceAlterado = null;

        // Recupera o usuário
        $usuario = $this->usuario;

        // Recupera os dados do post
        $post = $_POST;

        // Busca a categoria
        $indice = $this->objModelIndice
            ->get(["id_indice" => $id])
            ->fetch(\PDO::FETCH_OBJ);

        // Verifica se encontrou a categoria
        if(!empty($indice))
        {
            // Verifica se o usuário possui permissão
            if($usuario->nivel == "admin")
            {
                // Remove os dados inauteraveis
                unset($post["id_indice"]);

                // Altera os dados
                if($this->objModelIndice->update($post, ["id_indice" => $id]) != false)
                {
                    // Busca a categoria alterada
                    $indiceAlterado = $this->objModelIndice
                        ->get(["id_indice" => $id])
                        ->fetch(\PDO::FETCH_OBJ);

                    // Array de sucesso
                    $dados = [
                        "tipo" => true,
                        "code" => 200,
                        "mensagem" => "Alterado com sucesso.",
                        "objeto" => [
                            "antes" => $indice,
                            "atual" => $indiceAlterado
                        ]
                    ];

                }
                else
                {
                    // Msg
                    $dados = ["mensagem" => "Ocorreu um erro ao alterar."];

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
            $dados = ["mensagem" => "Indice informado não foi encontrado."];

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
     * @param int $id [id]
     * -----------------------------------------------------------------
     * @url api/indice/delete/[ID]
     * @method DELETE
     */
    public function delete($id)
    {
        // Variaveis
        $dados = null;
        $usuario = null;
        $indice = null;

        // Recupera o usuario
        $usuario = $this->usuario;

        // Busca a categoria
        $indice = $this->objModelIndice
            ->get(["id_indice" => $id])
            ->fetch(\PDO::FETCH_OBJ);

        // Verifica se encontrou a categoria
        if(!empty($indice))
        {
            // Verifica se o usuário possui permissão
            if($usuario->nivel == "admin")
            {
                // Verifica se possui produto nessa categoria
                if($this->objModelProduto->get(["id_indice" => $id])->rowCount() == 0)
                {
                    // Deleta
                    if($this->objModelIndice->delete(["id_indice" => $id]) != false)
                    {
                        // Array de retorno
                        $dados = [
                            "tipo" => true,
                            "code" => 200,
                            "mensagem" => "Deletado com sucesso.",
                            "objeto" => $indice
                        ];
                    }
                    else
                    {
                        // Msg
                        $dados = ["mensagem" => "Ocorreu um erro ao deletar."];
                    } // Error >> Ocorreu um erro ao deletar categoria.
                }
                else
                {
                    // Msg
                    $dados = ["mensagem" => "Possui produtos vinculados."];

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
            $dados = ["mensagem" => "Indice informado não foi encontrado."];

        } // Error >> Categorias informada não foi encontrada.

        // Retorno
        $this->api($dados);

    } // End >> fun::delete();
    
} // End >> Classe::Api\Categorias