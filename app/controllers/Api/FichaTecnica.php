<?php
/**
 * Created by PhpStorm.
 * User: Igor
 * Date: 27/05/2020
 * Time: 15:55
 */

namespace Controller\Api;

// Importações
use Sistema\Controller;
use Sistema\Helper\Input;
use Sistema\Helper\Seguranca;

// Classe
class FichaTecnica extends Controller
{
    // Objetos
    private $objModelProduto;
    private $objModelUsuario;
    private $objModelFichaTecnica;

    private $objSeguranca;
    private $objInput;

    // Variavel Global
    private $usuario;

    // Método construtor
    public function __construct()
    {
        // Construtor da classe pai
        parent::__construct();

        // Instancia os objetos
        $this->objModelProduto = new \Model\Produto();
        $this->objModelUsuario = new \Model\Usuario();
        $this->objModelFichaTecnica = new \Model\FichaTecnica();

        $this->objSeguranca = new Seguranca();
        $this->objInput = new Input();

        // Seguranca
        $this->usuario = $this->objSeguranca->security();

    } // End >> fun::__construct()



    /**
     * Método responsável por adicionar uma nova conta bancária para um
     * determinado usuário cadastrado.
     * -----------------------------------------------------------------
     * @author igorcacerez
     * -----------------------------------------------------------------
     * @url api/ficha/insert/[Id do produto]
     * @method POST
     */
    public function insert($id)
    {
        // Variaveis
        $dados = null;
        $usuario = null;
        $obj = null;
        $post = null;
        $produto = null;

        // Busca o usuário logado
        $usuario = $this->usuario;

        // Busca o produto
        $produto = $this->objModelProduto
            ->get(["id_produto" => $id])
            ->fetch(\PDO::FETCH_OBJ);

        // Verifica se o usuário possui permissão
        if($usuario->nivel == "admin")
        {
            // Recupera os dados POST
            $post = $_POST;

            // Verifica se informou os dados obrigatórios
            if(!empty($post["campo"]) && !empty($post["descricao"]))
            {
                // Array de inserção
                $salva = [
                    "id_produto" => $id,
                    "campo" => $post["campo"],
                    "descricao" => $post["descricao"]
                ];

                // Insere
                $obj = $this->objModelFichaTecnica->insert($salva);

                // Verifica se inseriu
                if($obj != false)
                {
                    // Busca o objeto inserido
                    $obj = $this->objModelFichaTecnica
                        ->get(["id_ficha_tecnica" => $obj])
                        ->fetch(\PDO::FETCH_OBJ);

                    // Array de retorno
                    $dados = [
                        "tipo" => true,
                        "code" => 200,
                        "objeto" => $obj,
                        "mensagem" => "Informação inserida com sucesso."
                    ];
                }
                else
                {
                    // Msg
                    $dados = ["mensagem" => "Ocorreu um erro ao inserir informação."];
                } // Error >> Erro ao inserir
            }
            else
            {
                // Msg
                $dados = ["mensagem" => "Campos obrigatórios não foram informados."];
            } // Error >> Campos obrigatórios não foram informados
        }
        else
        {
            // Msg
            $dados = ["mensagem" => "Usuário sem permissão."];
        } // Error >> Usuário sem permissão

        // Api
        $this->api($dados);

    } // End >> fun::insert()




    /**
     * Método responsável por alterar as configurações de uma
     * conta bancaria já cadastrada.
     * -------------------------------------------------------
     * @param $id [Id da ficha]
     * -------------------------------------------------------
     * @url api/ficha/update/[ID]
     * @method PUT
     */
    public function update($id)
    {
        // Variaveis
        $dados = null;
        $usuario = null;
        $obj = null;
        $objAltera = null;
        $put = null;
        $produto = null;

        // Recupera o usuário
        $usuario = $this->usuario;

        // Busca o objeto
        $obj = $this->objModelFichaTecnica
            ->get(["id_ficha_tecnica" => $id])
            ->fetch(\PDO::FETCH_OBJ);

        // Verifica se o objeto foi encontrado
        if(!empty($obj))
        {
            // Busca o produto
            $produto = $this->objModelProduto
                ->get(["id_produto" => $obj->id_produto])
                ->fetch(\PDO::FETCH_OBJ);

            // Verifica se o usuário possui permissão
            if($usuario->nivel == "admin")
            {
                // Recupera os dados PUT
                $put = $this->objInput->put();

                // Altera e verifica
                if($this->objModelFichaTecnica->update($put, ["id_ficha_tecnica" => $id]) != false)
                {
                    // Busca as informações do objeto alterado
                    $objAltera = $this->objModelFichaTecnica
                        ->get(["id_produto" => $obj->id_produto])
                        ->fetch(\PDO::FETCH_OBJ);

                    // Retorno
                    $dados = [
                        "tipo" => true,
                        "code" => 200,
                        "mensagem" => "Informações alteradas com sucesso.",
                        "objeto" => [
                            "antes" => $obj,
                            "atual" => $objAltera
                        ]
                    ];
                }
                else
                {
                    // Msg
                    $dados = ["mensagem" => "Ocorreu um erro ao alterar informações."];
                } // Error >> Ocorreu um erro ao alterar.
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
            $dados = ["mensagem" => "Item informado não existe."];
        } // Error >> Item informado não existe.

        // Retorno
        $this->api($dados);

    } // End >> fun::update()


    /**
     * Método responsável por deletar uma conta bancária,
     * verificando antes se possui vinculações.
     * ------------------------------------------------------
     * @param $id
     * ------------------------------------------------------
     * @url api/ficha/delete/[ID da Ficha]
     * @method DELETE
     */
    public function delete($id)
    {
        // Variaveis
        $dados = null;
        $usuario = null;
        $obj = null;
        $produto = null;

        // Recupera o usuário
        $usuario = $this->usuario;

        // Busca o objeto
        $obj = $this->objModelFichaTecnica
            ->get(["id_ficha_tecnica" => $id])
            ->fetch(\PDO::FETCH_OBJ);

        // Verifica se o objeto foi encontrado
        if(!empty($obj))
        {
            // Busca o produto
            $produto = $this->objModelProduto
                ->get(["id_produto" => $obj->id_produto])
                ->fetch(\PDO::FETCH_OBJ);

            // Verifica se o usuário possui permissão
            if($usuario->nivel == "admin")
            {
                // Deleta e verifica
                if($this->objModelFichaTecnica->delete(["id_ficha_tecnica" => $id]) != false)
                {
                    // Retorno
                    $dados = [
                        "tipo" => true,
                        "code" => 200,
                        "mensagem" => "Informações deletadas com sucesso.",
                        "objeto" => $obj,
                    ];
                }
                else
                {
                    // Msg
                    $dados = ["mensagem" => "Ocorreu um erro ao deletar informações."];
                } // Error >> Ocorreu um erro ao deletar.
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
            $dados = ["mensagem" => "Item informado não existe."];
        } // Error >> Item informado não existe.

        // Retorno
        $this->api($dados);

    } // End >> fun::delete()

} // End >> Class::Api\Conta