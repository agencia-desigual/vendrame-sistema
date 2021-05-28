<?php

// NameSpace
namespace Controller\Api;

// Importações
use Helper\Apoio;
use Sistema\Controller;
use Sistema\Helper\Input;
use Sistema\Helper\Seguranca;

// Inicia a Classe
class Servico extends Controller
{
    // Objetos
    private $objModelServico;
    private $objHelperApoio;
    private $objSeguranca;

    // Método construtor
    public function __construct()
    {
        // Chama o construtor pai
        parent::__construct();

        // Instancia os objetos
        $this->objModelServico = new \Model\Servico();
        $this->objHelperApoio = new Apoio();
        $this->objSeguranca = new Seguranca();

    } // End >> fun::__construct()


    /**
     * Método responsável por adicionar um novo serviço
     * no sistema.
     * --------------------------------------------------
     * @url api/servico/insert
     * @method POST
     */
    public function insert()
    {
        // Variaveis
        $usuario = null;
        $dados = null;
        $obj = null;
        $post = null;

        // Recupera o usuario logado
        $usuario = $this->objSeguranca->security();

        // Recupera os dados post
        $post = $_POST;

        // Verifica se possui permissão
        if($usuario->nivel == "admin")
        {
            // Verifica se informou os campos obrigatórios
            if(!empty($post["nome"]) && !empty($post["valor"]))
            {
                // Limpa o valor
                $post["valor"] = str_replace(".","", $post["valor"]);
                $post["valor"] = str_replace(",",".", $post["valor"]);

                // Verifica se não informou uma marca
                if(empty($post["marca"]))
                {
                    // Remove
                    unset($post["marca"]);
                }

                // Insere
                $obj = $this->objModelServico->insert($post);

                // Verifica se inseriu
                if(!empty($obj))
                {
                    // Busca o objeto inserido
                    $obj = $this->objModelServico
                        ->get(["id_servico" => $obj])
                        ->fetch(\PDO::FETCH_OBJ);

                    // Informa que deu certo
                    $dados = [
                        "tipo" => true,
                        "code" => 200,
                        "mensagem" => "Adicionado com sucesso.",
                        "objeto" => $obj
                    ];
                }
                else
                {
                    // Msg
                    $dados = ["mensagem" => "Ocorreu um erro ao inserir o serviço."];
                } // Error >> Ocorreu um erro ao inserir o serviço.
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
            $dados = ["mensagem" => "Usuario sem permissão."];

        } // Error >> Usuario sem permissão.

        // Retorno
        $this->api($dados);

    } // End >> fun::insert()


    /**
     * Método responsável por alterar um determinado
     * serviço do sistema.
     * --------------------------------------------------
     * @param $id [Id do serviço]
     * --------------------------------------------------
     * @url api/servico/update/[ID]
     * @method POST
     */
    public function update($id)
    {
        // Veriaveis
        $dados = null;
        $usuario = null;
        $put = null;
        $obj = null;

        // Recupera o usuario
        $usuario = $this->objSeguranca->security();

        // Verifica se é admin
        if($usuario->nivel == "admin")
        {
            // Busca o objeto
            $obj = $this->objModelServico
                ->get(["id_servico" => $id])
                ->fetch(\PDO::FETCH_OBJ);

            // Verifica se existe
            if(!empty($obj))
            {
                // Recupera os dados post
                $put = $_POST;

                // Remove os dados que não pode ser alterado
                unset($put["id_servico"]);

                // Limpa o valor
                $put["valor"] = str_replace(".","", $put["valor"]);
                $put["valor"] = str_replace(",",".", $put["valor"]);

                // Verifica se não informou uma marca
                if(empty($put["id_marca"]))
                {
                    // Remove
                    $put["id_marca"] = null;
                }

                // Altera
                if($this->objModelServico->update($put, ["id_servico" => $id]) != false)
                {
                    // Retorna o sucesso
                    $dados = [
                        "tipo" => true,
                        "code" => 200,
                        "mensagem" => "Serviço alterado com sucesso."
                    ];
                }
                else
                {
                    // Msg
                    $dados = ["mensagem" => "Ocorreu um erro ao alterar serviço."];
                } // Error >> Ocorreu um erro ao alterar serviço.
            }
            else
            {
                // Msg
                $dados = ["mensagem" => "Serviço informado não foi encontrado."];
            } // Error >> Serviço informado não foi encontrado.
        }
        else
        {
            // Msg
            $dados = ["mensagem" => "Usuário sem permissão"];
        } // Error >> Usuário sem permissão

        // Retorno
        $this->api($dados);

    } // End >> fun::update()


    /**
     * Método responsável por deletar um determinado
     * serviço do sistema.
     * --------------------------------------------------
     * @param $id [Id do serviço]
     * --------------------------------------------------
     * @url api/servico/delete/[ID]
     * @method DELETE
     */
    public function delete($id)
    {
        // Variaveis
        $dados = null;
        $usuario = null;
        $obj = null;

        // Recupera o usuário
        $usuario = $this->objSeguranca->security();

        // Verifica se possui permissão
        if($usuario->nivel == "admin")
        {
            // Busca o objeto
            $obj = $this->objModelServico
                ->get(["id_servico" => $id])
                ->fetch(\PDO::FETCH_OBJ);

            // Verifica se o objeto existe
            if(!empty($obj))
            {
                // Deleta
                if($this->objModelServico->delete(["id_servico" => $id]) != false)
                {
                    // Informa que deletou
                    $dados = [
                        "tipo" => true,
                        "code" => 200,
                        "mensagem" => "Serviço deletado com sucesso."
                    ];
                }
                else
                {
                    // Msg
                    $dados = ["mensagem" => "Ocorreu um erro ao deletar o serviço."];
                } // Error >> Ocorreu um erro ao deletar o serviço.
            }
            else
            {
                // Msg
                $dados = ["mensagem" => "Esse serviço já foi deletado."];
            } // Error >> Esse serviço já foi deletado.
        }
        else
        {
            // Msg
            $dados = ["mensagem" => "Usuário sem permissão"];
        } // Error >> Usuário sem permissão

        // Retorno
        $this->api($dados);

    } // End >> fun::delete();

} // End >> Class::Servico