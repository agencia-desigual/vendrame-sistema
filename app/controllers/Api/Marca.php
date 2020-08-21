<?php
/**
 * Created by PhpStorm.
 * User: Igor
 * Date: 21/08/2020
 * Time: 11:54
 */

// NameSpace
namespace Controller\Api;

// Importações
use Helper\Historico;
use Model\Produto;
use Sistema\Controller;
use Sistema\Helper\File;
use Sistema\Helper\Seguranca;

// Inicia a Classe
class Marca extends Controller
{
    // Objeto
    private $objModelMarca;
    private $objModelProduto;
    private $objHelperHistorico;
    private $objSeguranca;

    // Método construtor
    public function __construct()
    {
        // Chama o pai
        parent::__construct();

        // Instancia os objetos
        $this->objModelMarca = new \Model\Marca();
        $this->objModelProduto = new Produto();
        $this->objHelperHistorico = new Historico();
        $this->objSeguranca = new Seguranca();

    } // End >> fun::__construct()



    /**
     * Método responsável por retornar uma marca especifico e suas
     * FK, deve ser informado via paramento o ID do item.
     * -----------------------------------------------------------------
     * @param $id
     * -----------------------------------------------------------------
     * @author igorcacerez
     * @url api/marca/get/[ID]
     * @method GET
     */
    public function get($id)
    {
        // Variaveis
        $dados = null;
        $objeto = null;

        // Busca o Objeto com páginacao
        $objeto = $this->objModelMarca->get(["id_marca" => $id]);

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
     * Método responsável por retornar todas as marcas cadastradas
     * no sistema, podendo informar a ordem, limit e where.
     * -----------------------------------------------------------------
     * @author igorcacerez
     * -----------------------------------------------------------------
     * @url api/marca/get
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
        $objeto = $this->objModelMarca->get($where, $ordem, ($inicio . "," . $limite));

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
     * Método responsável por inserir uma nova marca.
     * Apenas usuários administradores podem realizar essa ação.
     * -----------------------------------------------------------------
     * @author igorcacerez
     * -----------------------------------------------------------------
     * @url api/marca/insert
     * @method POST
     */
    public function insert()
    {
        // Variaveis
        $dados = null;
        $usuario = null;
        $insert = null;
        $caminho = "./storage/marca/";
        $arquivo = null;

        // Seguranca
        $usuario = $this->objSeguranca->security();

        // Verifica se possui permissão
        if($usuario->nivel == "admin")
        {
            // Recupera os dados post
            $post = $_POST;

            // Verifica se informou os dados obrigatórios
            if(!empty($post["nome"]))
            {
                // Verifica se informou o arquivo
                if($_FILES["arquivo"]["size"] > 0)
                {
                    // Instancia o objeto
                    $objFile = new File();

                    // Verifica se o caminho existe
                    if(!is_dir($caminho))
                    {
                        // Cria
                        mkdir($caminho, 0777, true);
                    }

                    // Seta as configurações
                    $objFile->setStorange($caminho);
                    $objFile->setMaxSize(1 * MB);
                    $objFile->setExtensaoValida(["jpg","jpeg","png"]);
                    $objFile->setFile($_FILES["arquivo"]);

                    // Valida o tamanho
                    if($objFile->validaSize())
                    {
                        // Verifica se a extensão é válidada
                        if($objFile->validaExtensao())
                        {
                            // Faz o upload
                            $arquivo = $objFile->upload();

                            // Verifica se fez o upload
                            if(!empty($arquivo))
                            {
                                // Otimiza a imagem
                                $objFile->compressImage($caminho . $arquivo, $caminho . $arquivo);

                                // Array de inserção
                                $salva = [
                                    "nome" => $post["nome"],
                                    "logo" => $arquivo,
                                    "cadastro" => date("Y-m-d H:i:s")
                                ];

                                // Insere a marca
                                $obj = $this->objModelMarca->insert($salva);

                                // Verifica se inseriu corretamente
                                if(!empty($obj))
                                {
                                    // Busca o objeto inserido
                                    $obj = $this->objModelMarca
                                        ->get(["id_marca" => $obj])
                                        ->fetch(\PDO::FETCH_OBJ);

                                    // Retorno de sucesso
                                    $dados = [
                                        "tipo" => true,
                                        "code" => 200,
                                        "mensagem" => "Marca adicionada com sucesso.",
                                        "objeto" => $obj
                                    ];
                                }
                                else
                                {
                                    // Deleta a imagem
                                    unlink($caminho . $arquivo);

                                    // Msg
                                    $dados = ["mensagem" => "Ocorreu um erro ao adicionar a marca."];
                                } // Error >> Ocorreu um erro ao adicionar a marca.
                            }
                            else
                            {
                                // Msg
                                $dados = ["mensagem" => "Ocorreu um erro ao realizar o upload da imagem."];
                            } // Error >> Ocorreu um erro ao realizar o upload da imagem
                        }
                        else
                        {
                            // Msg
                            $dados = ["mensagem" => "A extensão do arquivo não é válida."];
                        } // Error >> A extensão do arquivo não é válida.
                    }
                    else
                    {
                        // Msg
                        $dados = ["mensagem" => "O arquivo ultrapassa o máximo de 1MB"];
                    } // Error >> O arquivo ultrapassa o máximo de 1MB
                }
                else
                {
                    // Msg
                    $dados = ["mensagem" => "Logo não informada."];
                } // Error >> Logo não informada.
            }
            else
            {
                // Msg
                $dados = ["mensagem" => "Dados obrigatórios não informados."];
            } // Error >> Dados obrigatórios não informados.
        }
        else
        {
            // Msg
            $dados = ["mensagem" => "Usuário sem permissão."];
        } // Error >> Usuário sem permissão

        // Retorno
        $this->api($dados);

    } // End >> fun::insert()



    /**
     * Método responsável por alterar uma determinada marca.
     * Apenas usuários administradores podem realizar essa ação.
     * -----------------------------------------------------------------
     * @author igorcacerez
     * -----------------------------------------------------------------
     * @param int $id [id do marca]
     * -----------------------------------------------------------------
     * @url api/marca/update/[ID]
     * @method POST
     */
    public function update($id)
    {
        // Variaveis
        $dados = null;
        $usuario = null;
        $obj = null;
        $objAlterado = null;
        $altera = null;
        $caminho = "./storage/marca/";
        $arquivo = null;

        // Recupera o usuário
        $usuario = $this->objSeguranca->security();

        // Verifica se possui permissão
        if($usuario->nivel == "admin")
        {
            // Recupera os dados post
            $post = $_POST;

            // Busca o objeto
            $obj = $this->objModelMarca
                ->get(["id_marca" => $id])
                ->fetch(\PDO::FETCH_OBJ);

            // Verifica se existe a marca
            if(!empty($obj))
            {
                // Adiciona o nome
                $altera = [
                    "nome" => $post["nome"]
                ];

                // Verifica se vai alterar a imagem --------
                if($_FILES["arquivo"]["size"] > 0)
                {
                    // Instancia o objeto
                    $objFile = new File();

                    // Verifica se o caminho existe
                    if(!is_dir($caminho))
                    {
                        // Cria
                        mkdir($caminho, 0777, true);
                    }

                    // Seta as configurações
                    $objFile->setStorange($caminho);
                    $objFile->setMaxSize(1 * MB);
                    $objFile->setExtensaoValida(["jpg","jpeg","png"]);
                    $objFile->setFile($_FILES["arquivo"]);

                    // Valida o tamanho
                    if($objFile->validaSize())
                    {
                        // Verifica se a extensão é válidada
                        if($objFile->validaExtensao())
                        {
                            // Faz o upload
                            $arquivo = $objFile->upload();

                            // Verifica se fez o upload
                            if(!empty($arquivo))
                            {
                                // Otimiza a imagem
                                $objFile->compressImage($caminho . $arquivo, $caminho . $arquivo);

                                // Array de alteração
                                $altera["logo"] = $arquivo;
                            }
                            else
                            {
                                // Msg
                                $this->api(["mensagem" => "Ocorreu um erro ao realizar o upload da imagem."]);
                            } // Error >> Ocorreu um erro ao realizar o upload da imagem
                        }
                        else
                        {
                            // Msg
                            $this->api(["mensagem" => "A extensão do arquivo não é válida."]);
                        } // Error >> A extensão do arquivo não é válida.
                    }
                    else
                    {
                        // Msg
                        $this->api(["mensagem" => "O arquivo ultrapassa o máximo de 1MB"]);
                    } // Error >> O arquivo ultrapassa o máximo de 1MB
                }
                // -----------------------------------------

                // Altera e verifica
                if($this->objModelMarca->update($altera, ["id_marca" => $id]) != false)
                {
                    // Busca o objeto alterado
                    $objAlterado = $this->objModelMarca
                        ->get(["id_marca" => $id])
                        ->fetch(\PDO::FETCH_OBJ);

                    // Retorno
                    $dados = [
                        "tipo" => true,
                        "code" => 200,
                        "mensagem" => "Marca alterada com sucesso.",
                        "objeto" => [
                            "antes" => $obj,
                            "atual" => $objAlterado
                        ]
                    ];
                }
                else
                {
                    // Verifica se fez uplaod
                    if(!empty($arquivo))
                    {
                        // Deleta o arquivo
                        unlink($caminho . $arquivo);
                    }

                    // Msg
                    $dados = ["mensagem" => "Marca alterada com sucesso."];
                } // Error >> Ocorreu um erro ao alterar a marca
            }
            else
            {
                // Verifica se fez uplaod
                if(!empty($arquivo))
                {
                    // Deleta o arquivo
                    unlink($caminho . $arquivo);
                }

                // Msg
                $dados = ["mensagem" => "Marca não encontrada."];
            } // Error >> Marca não encontrada.
        }
        else
        {
            // Msg
            $dados = ["mensagem" => "Usuário sem permissão."];
        } // Error >> Usuário sem permissão

        // Retorno
        $this->api($dados);

    } // End >> fun::update()



    /**
     * Método responsável por deletar uma determinada marca.
     * Apenas usuários administradores podem realizar essa ação.
     * -----------------------------------------------------------------
     * @author igorcacerez
     * -----------------------------------------------------------------
     * @param int $id [id da marca]
     * -----------------------------------------------------------------
     * @url api/marca/delete/[ID]
     * @method DELETE
     */
    public function delete($id)
    {
        // Variaveis
        $dados = null;
        $usuario = null;
        $obj = null;

        // Recupera o usuário logado
        $usuario = $this->objSeguranca->security();

        // Verifica se é admin
        if($usuario->nivel == "admin")
        {
            // Busca o objeto a ser deletado
            $obj = $this->objModelMarca
                ->get(["id_marca" => $id])
                ->fetch(\PDO::FETCH_OBJ);

            // Verifica se existe
            if(!empty($obj))
            {
                // Verifica se possui produtos vinculados
                if($this->objModelProduto->get(["id_marca" => $id])->rowCount() == 0)
                {
                    // Deleta
                    if($this->objModelMarca->delete(["id_marca" => $id]) != false)
                    {
                        // Deleta a imagem
                        if(!empty($obj->logo))
                        {
                            unlink("./storage/marca/" . $obj->logo);
                        }

                        // Informa que deletou
                        $dados = [
                            "tipo" => true,
                            "code" => 200,
                            "mensagem" => "Marca deletada com sucesso.",
                            "objeto" => $obj
                        ];
                    }
                    else
                    {
                        // Msg
                        $dados = ["mensagem" => "Ocorreu um erro ao deletar."];
                    } // Error >> Ocorreu um erro ao deletar.
                }
                else
                {
                    // Msg
                    $dados = ["mensagem" => "Essa marca possui produtos vinculados."];
                } // Error >> Essa marca possui produtos vinculados.
            }
            else
            {
                // Msg
                $dados = ["mensagem" => "A marca informada não foi encontada."];
            } // Error >> A marca informada não foi encontada.
        }
        else
        {
            // Msg
            $dados = ["mensagem" => "Usuário sem permissão"];
        } // Error >> Usuário sem permissão

        // Retorno api
        $this->api($dados);

    } // End >> fun::delete()

} // End >> Class::Marca