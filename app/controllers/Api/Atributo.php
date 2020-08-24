<?php

// NameSpace
namespace Controller\Api;

// Importações
use Model\AtributoProduto;
use Sistema\Controller;
use Sistema\Helper\File;
use Sistema\Helper\Seguranca;

// Classe
class Atributo extends Controller
{
    // Objetos
    private $objModelProduto;
    private $objModelAtributo;
    private $objModelAtributoProduto;

    private $objSeguranca;


    // Método construtor
    public function __construct()
    {
        // Chama o pai
        parent::__construct();

        // Instancia os objetos
        $this->objModelProduto = new \Model\Produto();
        $this->objModelAtributo = new \Model\Atributo();
        $this->objModelAtributoProduto = new AtributoProduto();
        $this->objSeguranca = new Seguranca();

    } // End >> fun::__construct()



    /**
     * Método responsável por cadastrar um novo atributo
     * no banco de dados.
     * -------------------------------------------------------
     * @url api/atributo/insert
     * @method POST
     */
    public function insert()
    {
        // Variaveis
        $dados = null;
        $usuario = null;
        $post = null;
        $obj = null;
        $caminho = "./storage/atributo/";
        $arquivo = null;

        // Recupera o usuário logado
        $usuario = $this->objSeguranca->security();

        // Verifica se possui permissão
        if($usuario->nivel == "admin")
        {
            // Recupera os dados post
            $post = $_POST;

            // Verifica se informou os dados obrigatórios
            if(!empty($post["nome"]) &&
                !empty($post["descricao"]))
            {
                // Verifica se informou a imagem
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
                    $objFile->setExtensaoValida(["jpg","jpeg","png","svg"]);
                    $objFile->setFile($_FILES["arquivo"]);

                    // Verifica se o tamanho é permitido
                    if($objFile->validaSize())
                    {
                        // Verifica se a extensão é correta
                        if($objFile->validaExtensao())
                        {
                            // Faz o upload
                            $arquivo = $objFile->upload();

                            // Verifica se fez o upload
                            if(!empty($arquivo))
                            {
                                // Monta o array de inserção
                                $salva = [
                                    "nome" => $post["nome"],
                                    "descricao" => $post["descricao"],
                                    "imagem" => $arquivo
                                ];

                                // Insere
                                $obj = $this->objModelAtributo->insert($salva);

                                // Verifica se inseriu
                                if(!empty($obj))
                                {
                                    // Busca o objeto inserido
                                    $obj = $this->objModelAtributo
                                        ->get(["id_atributo" => $obj])
                                        ->fetch(\PDO::FETCH_OBJ);

                                    // Retorno
                                    $dados = [
                                        "tipo" => true,
                                        "code" => 200,
                                        "mensagem" => "Atributo cadastrado com sucesso.",
                                        "objeto" => $obj
                                    ];
                                }
                                else
                                {
                                    // Deleta o arquivo
                                    unlink($caminho . $arquivo);

                                    // Msg
                                    $dados = ["mensagem" => "Ocorreu um erro ao inserir o atributo."];
                                } // Error >> Ocorreu um erro ao inserir o atributo.
                            }
                            else
                            {
                                // Msg
                                $dados = ["mensagem" => "Ocorreu um erro ao salvar a imagem."];
                            } // Error >> Ocorreu um erro ao salvar a imagem.
                        }
                        else
                        {
                            // Msg
                            $dados = ["mensagem" => "A extensão do arquivo é inválida."];
                        } // Error >> A extensão do arquivo é inválida.
                    }
                    else
                    {
                        // Msg
                        $dados = ["mensagem" => "O tamanho da imagem deve ser menor que 1MB"];
                    } // Error >> O tamanho da imagem deve ser menor que 1MB
                }
                else
                {
                    // Msg
                    $dados = ["mensagem" => "Imagem não informada."];
                } // Error >> Imagem não informada.
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
            $dados = ["mensagem" => "Usuário sem permissão"];
        } // Error >> Usuário sem permissão

        // Retorno
        $this->api($dados);

    } // End >> fun::insert()



    /**
     * Método responsável por alterar as informações
     * de um determinado atributo já cadastrado no sistema.
     * -------------------------------------------------------
     * @param $id [Id do atributo a ser alterado]
     * -------------------------------------------------------
     * @url api/atributo/update/[ID]
     * @method POST
     */
    public function update($id)
    {
        // Variaveis
        $dados = null;
        $usuario = null;
        $caminho = "./storage/atributo/";
        $arquivo = null;
        $obj = null;
        $objAlterado = null;
        $post = null;
        $altera = null;

        // Recupera o usuário
        $usuario = $this->objSeguranca->security();

        // Recupera os dados post
        $post = $_POST;

        // Verifica se o usuário possui permissão
        if($usuario->nivel == "admin")
        {
            // Busca o objeto a ser alterado
            $obj = $this->objModelAtributo
                ->get(["id_atributo" => $id])
                ->fetch(\PDO::FETCH_OBJ);

            // Verifica se encontrou o atributo
            if(!empty($obj))
            {
                // Monta o array de alteracao
                $altera = [
                    "nome" => $post["nome"],
                    "descricao" => $post["descricao"]
                ];

                // Verifica se vai alterar a imagem -----------------------
                // --------------------------------------------------------
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
                    $objFile->setExtensaoValida(["jpg","jpeg","png","svg"]);
                    $objFile->setFile($_FILES["arquivo"]);

                    // Verifica se o tamanho é permitido
                    if($objFile->validaSize())
                    {
                        // Verifica se a extensão é correta
                        if($objFile->validaExtensao())
                        {
                            // Faz o upload
                            $arquivo = $objFile->upload();

                            // Verifica se fez o upload
                            if(!empty($arquivo))
                            {
                                // Adiciona o arquivo no array
                                $altera["imagem"] = $arquivo;
                            }
                            else
                            {
                                // Msg
                                $this->api(["mensagem" => "Ocorreu um erro ao salvar a imagem."]);
                            } // Error >> Ocorreu um erro ao salvar a imagem.
                        }
                        else
                        {
                            // Msg
                           $this->api(["mensagem" => "A extensão do arquivo é inválida."]);
                        } // Error >> A extensão do arquivo é inválida.
                    }
                    else
                    {
                        // Msg
                        $this->api(["mensagem" => "O tamanho da imagem deve ser menor que 1MB"]);
                    } // Error >> O tamanho da imagem deve ser menor que 1MB
                }
                // --------------------------------------------------------
                // --------------------------------------------------------

                // Altera o atributo
                if($this->objModelAtributo->update($post, ["id_atributo" => $id]) != false)
                {
                    // Verifica se alterar a imagem
                    if(!empty($arquivo))
                    {
                        // verifica se possuia imagem
                        if(!empty($obj->imagem))
                        {
                            // Verifica se a imagem existe
                            if(is_file("./storage/atributo/" . $obj->imagem))
                            {
                                // Deleta a imagem antiga
                                unlink("./storage/atributo/" . $obj->imagem);
                            }
                        }
                    }

                    // Busca o objeto alterado
                    $objAlterado = $this->objModelAtributo
                        ->get(["id_atributo" => $id])
                        ->fetch(\PDO::FETCH_OBJ);

                    // Retorno
                    $dados = [
                        "tipo" => true,
                        "code" => 200,
                        "mensagem" => "Item alterado com sucesso.",
                        "objeto" => [
                            "antes" => $obj,
                            "atual" => $objAlterado
                        ]
                    ];
                }
                else
                {
                    // Verifica se fez upload
                    if(!empty($arquivo))
                    {
                        // Deleta
                        unlink($caminho . $arquivo);
                    }

                    // Msg
                    $dados = ["mensagem" => "Ocorreu um erro ao alterar o atributo."];
                } // Error >> Ocorreu um erro ao alterar o atributo.
            }
            else
            {
                // Msg
                $dados = ["mensagem" => "Atributo informado não foi encontrado."];
            } // Error >> Atributo informado não foi encontrado.
        }
        else
        {
            // Msg
            $dados = ["mensagem" => "Usuário sem permissão."];
        } // Error >> Usuário sem permissão

        // Api
        $this->api($dados);

    } // End >> fun::update()


    
    /**
     * Método responsável por deletar um determinado atributo
     * cadastro no sistema e todas a suas vinculações.
     * -------------------------------------------------------
     * @param $id [Id do atributo a ser deletado]
     * -------------------------------------------------------
     * @url api/atributo/delete/[ID]
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
            // Busca o objeto a ser deletado
            $obj = $this->objModelAtributo
                ->get(["id_atributo" => $id])
                ->fetch(\PDO::FETCH_OBJ);

            // Verifica se existe
            if(!empty($obj))
            {
                // Deleta as vinculações
                if($this->objModelAtributoProduto->delete(["id_atributo" => $id]) != false)
                {
                    // Deleta o atributo
                    if($this->objModelAtributo->delete(["id_atributo" => $id]) != false)
                    {
                        // verifica se possui imagem
                        if(!empty($obj->imagem))
                        {
                            // Verifica se a imagem existe
                            if(is_file("./storage/atributo/" . $obj->imagem))
                            {
                                // Deleta a imagem
                                unlink("./storage/atributo/" . $obj->imagem);
                            }
                        }

                        // Sucesso
                        $dados = [
                            "tipo" => true,
                            "code" => 200,
                            "mensagem" => "Atributo deletado com sucesso.",
                            "objeto" => $obj
                        ];
                    }
                    else
                    {
                        // Msg
                        $dados = ["mensagem" => "Ocorreu um erro ao deletar o atributo."];
                    } // Error >> Ocorreu um erro ao deletar o atributo.
                }
                else
                {
                    // Msg
                    $dados = ["mensagem" => "Ocorreu um erro ao deletar as vinculações."];

                } // Error >> Ocorreu um erro ao deletar as vinculações.
            }
            else
            {
                // Msg
                $dados = ["mensagem" => "O atributo informado não existe."];
            } // Error >> O atributo informado não existe.
        }
        else
        {
            // Msg
            $dados = ["mensagem" => "Usuário sem permissão."];
        } // Error >> Usuário sem permissão.

        // Api
        $this->api($dados);

    } // End >> fun::delete()



    /**
     * Método responsável por vincular um determinado atributo
     * a um produto já cadastrado.
     * -------------------------------------------------------
     * @param $idProduto
     * @param $idAtributo
     * -------------------------------------------------------
     * @url api/atributo/produto/[$idProduto]/[$idAtributo]
     * @method POST
     */
    public function vinculaProduto($idProduto, $idAtributo)
    {
        // Variaveis
        $dados = null;
        $usuario = null;
        $atributo = null;
        $produto = null;
        $obj = null;
        $salva = null;

        // Recupera o usuário
        $usuario = $this->objSeguranca->security();

        // Verifica se possui permissão
        if($usuario->nivel == "admin")
        {
            // Busca o produto
            $produto = $this->objModelProduto
                ->get(["id_produto" => $idProduto])
                ->fetch(\PDO::FETCH_OBJ);

            // Busca o atributo
            $atributo = $this->objModelAtributo
                ->get(["id_atributo" => $idAtributo])
                ->fetch(\PDO::FETCH_OBJ);

            // Verifica se existe
            if(!empty($atributo) && !empty($produto))
            {
                // Verifica se já não está vinculado
                if($this->objModelAtributoProduto->get(["id_atributo" => $idAtributo, "id_produto" => $idProduto])->rowCount() == 0)
                {
                    // Array de salvamento
                    $salva = [
                        "id_produto" => $idProduto,
                        "id_atributo" => $idAtributo
                    ];

                    // Insere
                    $obj = $this->objModelAtributoProduto->insert($salva);

                    // Verifica se inseriu
                    if(!empty($obj))
                    {
                        // Busca o objeto
                        $obj = $this->objModelAtributoProduto
                            ->get(["id_atributo_produto" => $obj])
                            ->fetch(\PDO::FETCH_OBJ);

                        // Array de sucesso
                        $dados = [
                            "tipo" => true,
                            "code" => 200,
                            "mensagem" => "Item vinculado com sucesso.",
                            "objeto" => $obj
                        ];
                    }
                    else
                    {
                        // Msg
                        $dados = ["mensagem" => "Ocorreu um erro ao vincular o produto ao atributo."];
                    } // Error >> Ocorreu um erro ao vincular o atributo.
                }
                else
                {
                    // Msg
                    $dados = ["mensagem" => "Esse atributo já esta vinculado ao produto."];
                } // Error >> Esse atributo já esta vinculado ao produto.
            }
            else
            {
                // Msg
                $dados = ["mensagem" => "Atributo ou produto informado não existe."];
            } // Error >> Atributo ou produto informado não existe.
        }
        else
        {
            // Msg
            $dados = ["mensagem" => "Usuário sem permissão."];
        } // Error >> Usuário sem permissão.

        // Retorno
        $this->api($dados);

    } // End >> fun::vinculaProduto()



    /**
     * Método responsável por deletar uma vinculação entre
     * um atributo e um produto.
     * -------------------------------------------------------
     * @param $id [Id da vinculação]
     * -------------------------------------------------------
     * @url api/atributo/produto/[ID]
     * @method DELETE
     */
    public function desvinculaProduto($id)
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
            // Busca o objeto a ser deletado
            $obj = $this->objModelAtributoProduto
                ->get(["id_atributo_produto" => $id])
                ->fetch(\PDO::FETCH_OBJ);

            // Verifica se encontrou
            if(!empty($obj))
            {
                // Deleta a vinculação
                if($this->objModelAtributoProduto->delete(["id_atributo_produto" => $id]) != false)
                {
                    // Sucesso
                    $dados = [
                        "tipo" => true,
                        "code" => 200,
                        "mensagem" => "Vinculação deletada com sucesso."
                    ];
                }
                else
                {
                    // Msg
                    $dados = ["mensagem" => "Ocorreu um erro ao deletar a vinculação."];
                } // Error >> Ocorreu um erro ao deletar a vinculação.
            }
            else
            {
                // Msg
                $dados = ["mensagem" => "Vinculação informada não foi encontrada."];
            } // Erro >> Vinculação informada não foi encontrada.
        }
        else
        {
            // Msg
            $dados = ["mensagem" => "Usuário não possui permissão"];
        } // Error >> Usuário não possui permissão

        // Api
        $this->api($dados);

    } // End >> fun::desvinculaProduto()

} // End >> Class::Atributo