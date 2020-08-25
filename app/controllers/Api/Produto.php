<?php
/**
 * Created by PhpStorm.
 * User: Igor
 * Date: 24/08/2020
 * Time: 09:56
 */

// NameSpace
namespace Controller\Api;

// Importações
use Model\AtributoProduto;
use Sistema\Controller;
use Sistema\Helper\Seguranca;

// Classe
class Produto extends Controller
{
    // Objetos
    private $objModelProduto;
    private $objModelCategoria;
    private $objModelMarca;

    private $objSeguranca;

    // Método construtor
    public function __construct()
    {
        // Chama o pai
        parent::__construct();

        // Instancia os objetos
        $this->objModelProduto = new \Model\Produto();
        $this->objModelCategoria = new \Model\Categoria();
        $this->objModelMarca = new \Model\Marca();

        $this->objSeguranca = new Seguranca();

    } // End >> fun::__construct()


    /**
     * Método responsável por inserir um determinado
     * produto no sistema.
     * --------------------------------------------------
     * @url api/usuario/insert
     * @method POST
     */
    public function insert()
    {
        // Variaveis
        $dados = null;
        $usuario = null;
        $salva = null;
        $post = null;

        // Recupera os dados do usuário
        $usuario = $this->objSeguranca->security();

        // Recupera os dados post
        $post = $_POST;

        // Verifica se o usuário possui permissão
        if($usuario->nivel == "admin")
        {
            // Verifica se informou os dados obrigatórios
            if(!empty($post["nome"]) &&
                !empty($post["referencia"]) &&
                !empty($post["id_marca"]) &&
                !empty($post["id_categoria"]) &&
                !empty($post["valorPago"]) &&
                !empty($post["lucro"]))
            {
                // Busca a marca
                $marca = $this->objModelMarca
                    ->get(["id_marca" => $post["id_marca"]])
                    ->fetch(\PDO::FETCH_OBJ);

                // Verifica se a marca existe
                if(!empty($marca))
                {
                    // Busca a categoria
                    $categoria = $this->objModelCategoria
                        ->get(["id_categoria" => $post["id_categoria"]])
                        ->fetch(\PDO::FETCH_OBJ);

                    // Verifica se a categoria existe
                    if(!empty($categoria))
                    {
                        // Configura o valor pago
                        $post["valorPago"] = str_replace(".","", $post["valorPago"]);
                        $post["valorPago"] = str_replace(",",".", $post["valorPago"]);

                        // Configura a porcentagem do lucro
                        $post["lucro"] = str_replace(".","", $post["lucro"]);
                        $post["lucro"] = str_replace(",",".", $post["lucro"]);

                        // Calcula o valor de venda
                        $post["valorVenda"] = (($post["lucro"] * 100 ) / $post["valorPago"]) + $post["valorPago"];

                        // Verifica se tem desconto
                        if(!empty($post["desconto"]))
                        {
                            // Configura o valor do desconto
                            $post["desconto"] = str_replace(".","", $post["desconto"]);
                            $post["desconto"] = str_replace(",",".", $post["desconto"]);
                        }

                        // Array de inserção
                        $salva = [
                            "id_categoria" => $post["id_categoria"],
                            "id_marca" => $post["id_marca"],
                            "id_usuario" => $usuario->id_usuario,
                            "nome" => $post["nome"],
                            "referencia" => $post["referencia"],
                            "descricao" => (!empty($post["descricao"])) ? $post["descricao"] : null,
                            "valorPago" => $post["valorPago"],
                            "valorVenda" => $post["valorVenda"],
                            "lucro" => $post["lucro"],
                            "desconto" => (!empty($post["desconto"])) ? $post["desconto"] : 0,
                            "status" => (isset($post["status"])) ? $post["status"] : true,
                            "cadastro" => date("Y-m-d H:i:s")
                        ];

                        // Insere o produto
                        $obj = $this->objModelProduto->insert($salva);

                        // Verifica se inseriu
                        if(!empty($obj))
                        {
                            // Busca o produto
                            $obj = $this->objModelProduto
                                ->get(["id_produto" => $obj])
                                ->fetch(\PDO::FETCH_OBJ);

                            // Retorno
                            $dados = [
                                "tipo" => true,
                                "code" => 200,
                                "mensagem" => "Produto adicionado com sucesso.",
                                "objeto" => $obj
                             ];
                        }
                        else
                        {
                            // Msg
                            $dados = ["mensagem" => "Ocorreu um erro ao inserir o produto."];
                        } // Error >> Ocorreu um erro ao inserir o produto.
                    }
                    else
                    {
                        // Msg
                        $dados = ["mensagem" => "Categoria informada não foi encontrada."];
                    } // Error >> Categoria informada não foi encontrada.
                }
                else
                {
                    // Msg
                    $dados = ["mensagem" => "Marca informada não foi encontrada."];
                } // Error >> Marca informada não foi encontrada.
            }
            else
            {
                // Msg
                $dados = ["mensagem" => "Campos obrigatórios não foram preenchidos."];
            } // Error >> Campos obrigatórios não foram preenchidos.
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
     * Método responsável por realizar uma alteração em
     * um determinado produto já cadastrado.
     * --------------------------------------------------
     * @param $id [Id produto]
     * --------------------------------------------------
     * @url api/usuario/update/[ID]
     * @method POST
     */
    public function update($id)
    {
        // Variaveis
        $dados = null;
        $usuario = null;
        $post = null;
        $obj = null;
        $objAlterado = null;
        $altera = null;

        // Recupera o usuário
        $usuario = $this->objSeguranca->security();

        // Recupera os dados post
        $post = $_POST;

        // Verifica se o usuário possui permissão
        if($usuario->nivel == "admin")
        {
            // Busca o objeto a ser alterado
            $obj = $this->objModelProduto
                ->get(["id_produto" => $id])
                ->fetch(\PDO::FETCH_OBJ);

            // Verifica se existe
            if(!empty($obj))
            {
                // Recupera os valores
                $valorPago = $obj->valorPago;
                $lucro = $obj->lucro;

                // Verifica se vai alterar o valor pago
                if(!empty($post["valorPago"]))
                {
                    // Configura o valor pago
                    $post["valorPago"] = str_replace(".","", $post["valorPago"]);
                    $post["valorPago"] = str_replace(",",".", $post["valorPago"]);

                    $valorPago = $post["valorPago"];
                }

                // Verifica se vai alterar o lucro
                if(!empty($post["lucro"]))
                {
                    // Configura o valor pago
                    $post["lucro"] = str_replace(".","", $post["lucro"]);
                    $post["lucro"] = str_replace(",",".", $post["lucro"]);

                    $lucro = $post["lucro"];
                }

                // Verifica se vai alterar o desconto
                if(!empty($post["desconto"]))
                {
                    // Configura o valor pago
                    $post["desconto"] = str_replace(".","", $post["desconto"]);
                    $post["desconto"] = str_replace(",",".", $post["desconto"]);
                }

                // Reculcula o valor de venda
                $post["valorVenda"] = (($lucro * 100 ) / $valorPago) + $valorPago;

                // Altera as informações
                if($this->objModelProduto->update($post, ["id_produto" => $id]) != false)
                {
                    // Recupera o produto alterado
                    $objAlterado = $this->objModelProduto
                        ->get(["id_produto" => $id])
                        ->fetch(\PDO::FETCH_OBJ);

                    // Retorno
                    $dados = [
                        "tipo" => true,
                        "code" => 200,
                        "mensagem" => "Produto alterado com sucesso.",
                        "objeto" => [
                            "antes" => $obj,
                            "atual" => $objAlterado
                        ]
                    ];
                }
                else
                {
                    // Msg
                    $dados = ["mensagem" => "Ocorreu um erro ao alterar o produto."];
                } // Error >> Ocorreu um erro ao alterar o produto.
            }
            else
            {
                // Msg
                $dados = ["mensagem" => "O produto informado não foi encontrado."];
            } // Error >> O produto informado não foi encontrado
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
     * Método responsável por deletar um determinado produto
     * do banco de dados.
     * -----------------------------------------------------
     * @param $id [Id do produto]
     * -----------------------------------------------------
     * @url api/usuario/delete/[ID]
     * @method DELETE
     */
    public function delete($id)
    {
        // Variaveis
        $dados = null;
        $usuario = null;
        $obj = null;

        // Objetos
        $objModelImagem = new \Model\Imagem();
        $objModelFichaTecnica = new \Model\FichaTecnica();
        $objModelAtributoProduto = new AtributoProduto();

        // Recupera o usuário
        $usuario = $this->objSeguranca->security();

        // Verifica se possui permissão
        if($usuario->nivel == "admin")
        {
            // Busca o objeto a ser deletado
            $obj = $this->objModelProduto
                ->get(["id_produto" => $id])
                ->fetch(\PDO::FETCH_OBJ);

            // Verifica se existe
            if(!empty($obj))
            {
                // Busca todas as imagens
                $imagens = $objModelImagem
                    ->get(["id_produto" => $id])
                    ->fetchAll(\PDO::FETCH_OBJ);

                // Caminho
                $caminho = "./storage/produto/" . $obj->id_produto . "/";

                // Percorre as imagens
                foreach ($imagens as $img)
                {
                    // Deleta a imagem
                    unlink($caminho . $img->imagem);

                    // Deleta
                    $objModelImagem->delete(["id_imagem" => $img->id_imagem]);
                }

                // Deleta as ficha tecnicas
                $objModelFichaTecnica->delete(["id_produto" => $id]);

                // Deleta os atributos
                $objModelAtributoProduto->delete(["id_produto" => $id]);

                // Deleta o produto
                if($this->objModelProduto->delete(["id_produto" => $id]) != false)
                {
                    // Array de sucesso
                    $dados = [
                        "tipo" => true,
                        "code" => 200,
                        "mensagem" => "Produto deletado com sucesso.",
                        "objeto" => $obj
                    ];
                }
                else
                {
                    // Msg
                    $dados = ["mensagem" => "Ocorreu um erro ao deletar o produto."];
                } // Error >> Ocorreu um erro ao deletar o produto.
            }
            else
            {
                // Msg
                $dados = ["mensagem" => "Produto informado não existe."];
            } // Error >> Produto informado não existe.
        }
        else
        {
            // Msg
            $dados = ["mensagem" => "Usuário sem permissão."];
        } // Error >> Usuário sem permissão

        // Retorno
        $this->api($dados);

    } // End >> fun::delete()


} // End >> Class::Produto