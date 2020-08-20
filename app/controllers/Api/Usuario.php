<?php
/**
 * Created by PhpStorm.
 * User: Igor
 * Date: 20/08/2020
 * Time: 11:38
 */

// NameSpace
namespace Controller\Api;

// Importações
use Helper\Historico;
use Sistema\Controller;
use Sistema\Helper\Input;
use Sistema\Helper\Seguranca;

// Inicia a Classe
class Usuario extends Controller
{
    // Objetos
    private $objModelUsuario;
    private $objHelperHistorico;
    private $objSeguranca;

    // Método Construtor
    public function __construct()
    {
        // Chama o pai
        parent::__construct();

        // Instancia os objetos
        $this->objModelUsuario = new \Model\Usuario();
        $this->objHelperHistorico = new Historico();
        $this->objSeguranca = new Seguranca();

    } // End >> fun::__construct()


    /**
     * Método responsável por realizar o login de um
     * determinado usuário, independente do seu nivel.
     * -----------------------------------------------
     * @url api/usuario/login
     * @method POST
     */
    public function login()
    {
        // Variaveis
        $dados = null;
        $usuario = null;
        $token = null;
        $dadosLogin = null;

        // Recupera os dados de login
        $dadosLogin = $this->objSeguranca->getDadosLogin();

        // Criptografa a senha
        $dadosLogin["senha"] = md5($dadosLogin["senha"]);

        // Limpa o CPF
        $dadosLogin["usuario"] = preg_replace("/[^0-9]/", "", $dadosLogin["usuario"]);

        // Busca o usuário
        $usuario = $this->objModelUsuario
            ->get(["cpf" => $dadosLogin["usuario"], "senha" => $dadosLogin["senha"]])
            ->fetch(\PDO::FETCH_OBJ);

        // Verifica se encontrou o usuário
        if(!empty($usuario))
        {
            // Verifica se está ativo
            if($usuario->status == true)
            {
                // Gera um token
                $token = $this->objSeguranca->getToken($usuario->id_usuario);

                // Verifica se gerou o token
                if($token != false)
                {
                    // Remove a senha
                    unset($usuario->senha);

                    // Salva os dados na session
                    $_SESSION["usuario"] = $usuario;
                    $_SESSION["token"] = $token;


                    // Salva o historico --------------------
                    $this->objHelperHistorico->salva([
                        "id_usuario" => $usuario->id_usuario,
                        "acao" => "login",
                        "descricao" => "Realizou login no sistema"
                    ]);
                    // ---------------------------------------


                    // Array de retorno
                    $dados = [
                        "tipo" => true,
                        "code" => 200,
                        "mensagem" => "Sucesso! Aguarde...",
                        "objeto" => [
                            "usuario" => $usuario,
                            "token" => $token
                        ]
                    ];
                }
                else
                {
                    // Msg
                    $dados = ["mensagem" => "Ocorre um erro ao conceder um token de acesso."];
                } // Error >> Ocorre um erro ao conceder um token de acesso.
            }
            else
            {
                // Msg
                $dados = ["mensagem" => "Sua conta está desativada, entre em contato com o suporte para mais informações"];
            } // Error >> Conta desativada.
        }
        else
        {
            // Msg
            $dados = ["mensagem" => "E-mail ou senha informados estão incorretos."];

        } // Error >> Dados de login estão incorretos.

        // Retorno
        $this->api($dados);

    } // End >> fun::login()



    /**
     * Método responsável por retornar um usuario especifico e suas
     * FK, deve ser informado via paramento o ID do item.
     * -----------------------------------------------------------------
     * @param $id
     * -----------------------------------------------------------------
     * @author igorcacerez
     * @url api/usuario/[ID]
     * @method GET
     */
    public function get($id)
    {
        // Seguranca
        $usuario = $this->objSeguranca->security();

        // Verifica se é admin
        if($usuario->nivel == "admin")
        {
            // Variaveis
            $dados = null;
            $objeto = null;

            // Busca o Objeto com páginacao
            $objeto = $this->objModelUsuario->get(["id_usuario" => $id]);

            // Fetch
            $total = $objeto->rowCount();
            $objeto = $objeto->fetch(\PDO::FETCH_OBJ);

            // Verifica se retornou algo
            if(!empty($objeto))
            {
                // Remove informações
                unset($objeto->senha);
                unset($objeto->status);
            }

            // Monta o array de retorno
            $dados = [
                "tipo" => true,
                "code" => 200,
                "objeto" => [
                    "total" => $total,
                    "item" => $objeto,
                ]
            ];
        }
        else
        {
            // Msg
            $dados = ["mensagem" => "Usuário sem permissão"];
        } // Error >> Usuário sem permissão

        // Retorna
        $this->api($dados);

    } // End >> fun::get()



    /**
     * Método responsável por retornar todos os usuários cadastrados
     * no sistema, podendo informar a ordem, limit e where.
     * -----------------------------------------------------------------
     * @author igorcacerez
     * -----------------------------------------------------------------
     * @url api/usuario
     * @method GET
     */
    public function getAll()
    {
        // Seguranca
        $usuario = $this->objSeguranca->security();

        // Verifica se é admin
        if($usuario->nivel == "admin")
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
            $objeto = $this->objModelUsuario->get($where, $ordem, ($inicio . "," . $limite));

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
        }
        else
        {
            // Msg
            $dados = ["mensagem" => "Usuário sem permissão"];
        } // Error >> Usuáiro sem permissão

        // Retorna
        $this->api($dados);

    } // End >> fun::getAll()



    /**
     * Método responsável por inserir um determinado usuário no
     * sistema. Verificando se o mesmo possui nivel suficiente
     * para execultar a ação.
     * -----------------------------------------------------------------
     * @author igorcacerez
     * -----------------------------------------------------------------
     * @url api/usuario
     * @method POST
     */
    public function insert()
    {
        // Variaveis
        $dados = null;
        $usuario = null;
        $post = null;
        $salva = null;
        $obj = null;

        // Verifica se está logado
        $usuario = $this->objSeguranca->security();

        // Recupera os dados post
        $post = $_POST;

        // Verifica se o usuário possui permissão
        if($usuario->nivel == "admin")
        {
            // Verifica se informou os campos obrigatórios
            if(!empty($post["nome"]) &&
                !empty($post["cpf"]) &&
                !empty($post["senha"]))
            {
                // Limpa o cpf
                $cpf = preg_replace("/[^0-9]/", "", $post["cpf"]);

                // Verifica se já existe um usuário com o mesmo cpf
                if($this->objModelUsuario->get(["cpf" => $cpf])->rowCount() == 0)
                {
                    // Array de inserção
                    $salva = [
                        "nome" => $post["nome"],
                        "cpf" => $cpf,
                        "senha" => md5($post["senha"]),
                        "status" => (!empty($post["status"]) ? $post["status"] : true),
                        "cadastro" => date("Y-m-d H:i:s")
                    ];

                    // Insere
                    $obj = $this->objModelUsuario->insert($salva);

                    // Verifica se inseriu
                    if(!empty($obj))
                    {
                        // Busca o usuário recem adicionado
                        $obj = $this->objModelUsuario
                            ->get(["id_usuario" => $obj])
                            ->fetch(\PDO::FETCH_OBJ);

                        // Retorno de sucesso
                        $dados = [
                            "tipo" => true,
                            "code" => 200,
                            "mensagem" => "Usuário adicionado com sucesso.",
                            "objeto" => $obj
                        ];
                    }
                    else
                    {
                        // Msg
                        $dados = ["mensagem" => "Ocorreu um erro ao inserir o usuário."];
                    } // Error >> Ocorreu um erro ao inserir o usuário.
                }
                else
                {
                    // Msg
                    $dados = ["mensagem" => "Já existe um cadastro com o cpf informado."];
                } // Error >> Já existe um cadastro com o cpf informado.
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
            $dados = ["mensagem" => "Usuário sem permissão."];
        } // Error >> Usuário sem permissão.

        // Retorno
        $this->api($dados);

    } // End >> fun::insert()


    /**
     * Método responsável por alterar os dados de um determinado
     * usuário, verificando se o mesmo possui permissão.
     * -----------------------------------------------------------------
     * @author igorcacerez
     * -----------------------------------------------------------------
     * @param $id [Id do usuário a ser alterado]
     * -----------------------------------------------------------------
     * @url api/usuario/{ID}
     * @method PUT
     */
    public function update($id)
    {
        // Variaveis
        $dados = null;
        $usuario = null;
        $objAltera = null;
        $objAlterado = null;

        // Seguranca
        $usuario = $this->objSeguranca->security();

        // Recupera os dados put
        $objInput = new Input();
        $put = $objInput->put();

        // Verifica se o usuário possui permissão
        if($usuario->nivel == "admin" || $usuario->id_usuario == $id)
        {
            // Busca o usuário a ser alterado
            $objAltera = $this->objModelUsuario
                ->get(["id_usuario" => $id])
                ->fetch(\PDO::FETCH_OBJ);

            // Verifica se o usuário existe
            if(!empty($objAltera))
            {
                // Verifica se vai alterar a senha
                if(!empty($put["senha"]))
                {
                    // Criptografa
                    $put["senha"] = md5($put["senha"]);
                }
                else
                {
                    // Deleta a senha
                    unset($put["senha"]);
                }

                // Verifica se vai alterar algo
                if(!empty($put))
                {
                    // Altera e verifica
                    if($this->objModelUsuario->update($put, ["id_usuario" => $id]) != false)
                    {
                        // Busca o objeto alterado
                        $objAlterado = $this->objModelUsuario
                            ->get(["id_usuario" => $id])
                            ->fetch(\PDO::FETCH_OBJ);

                        // Retorno de sucesso
                        $dados = [
                            "tipo" => true,
                            "code" => 200,
                            "mensagem" => "Informações alteradas com sucesso.",
                            "objeto" => [
                                "antes" => $objAltera,
                                "atual" => $objAlterado
                            ]
                        ];
                    }
                    else
                    {
                        // Msg
                        $dados = ["mensagem" => "Ocorreu um erro ao alterar as informações."];
                    } // Error >> Ocorreu um erro ao alterar as informações.
                }
                else
                {
                    // Msg
                    $dados = ["mensagem" => "Nada está sendo alterado."];
                } // Error >> Nada está sendo alterado.
            }
            else
            {
                // Msg
                $dados = ["mensagem" => "Usuário informado não foi encontraodo."];
            } // Error >> Usuário informado não foi encontraodo
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
     * Método responsável por deletar um determinado usuário do banco,
     * verificando se possui permissão e se não está deletando a ele
     * mesmo.
     *-----------------------------------------------------------------
     * @author igorcacerez
     * -----------------------------------------------------------------
     * @param $id [Id do usuário a ser deletado]
     * -----------------------------------------------------------------
     * @url api/usuario/{ID}
     * @method DELETE
     */
    public function delete($id)
    {
        // Variaveis
        $dados = null;
        $usuario = null;
        $objeto = null;

        // Recupera o usuário
        $usuario = $this->objSeguranca->security();

        // Verifica se possui permissão
        if($usuario->nivel == "admin")
        {
            // Verifica se não vai deletar ele mesmo
            if($usuario->id_usuario == $id)
            {
                // Busca o usuário a ser deletado
                $objeto = $this->objModelUsuario
                    ->get(["id_usuario" => $id])
                    ->fetch(\PDO::FETCH_OBJ);

                // Verifica se encontrou
                if(!empty($objeto))
                {
                    // Deleta o objeto
                    if($this->objModelUsuario->delete(["id_usuario" => $id]) != false)
                    {
                        // Retorno de sucesso
                        $dados = [
                            "tipo" => true,
                            "code" => 200,
                            "mensagem" => "Usuário deletado com sucesso.",
                            "objeto" => $objeto
                        ];
                    }
                    else
                    {
                        // Msg
                        $dados = ["mensagem" => "O Usuário foi deletado com sucesso."];
                    } // Error >> O Usuário foi deletado com sucesso.
                }
                else
                {
                    // Msg
                    $dados = ["mensagem" => "O usuário a ser deletado não foi encontrado."];
                } // Error >> O usuário a ser deletado não foi encontrado.
            }
            else
            {
                // Msg
                $dados = ["mensagem" => "Impossível deletar você mesmo"];
            } // Error >> Impossível deletar você mesmo
        }
        else
        {
            // Msg
            $dados = ["mensagem" => "Usuário sem permissão suficiente."];
        } // Error >> Usuário sem permissão

        // Retorno
        $this->api($dados);

    } // End >> fun::delete()

} // End >> Class::Usuario