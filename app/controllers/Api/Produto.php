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
use Helper\Apoio;
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

    // Helpers
    private $objHelperApoio;

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

        // Instancia helpers
        $this->objHelperApoio = new Apoio();

        $this->objSeguranca = new Seguranca();

    } // End >> fun::__construct()


    /**
     * Método responsável por retornar a busca de produtos
     * por nome, conforme preenchido no input de pesquisa
     * -----------------------------------------------------------------
     * @param $nome
     * -----------------------------------------------------------------
     * @author edilson-pereira
     * @url api/produto/pesquisa/[nome]
     * @method GET
     */
    public function pesquisa($nome)
    {
        // Variaveis
        $dados = null;
        $objeto = null;
        $sql = null;

        $sql = "SELECT * FROM produto WHERE status = true AND nome LIKE '%{$nome}%' LIMIT 0,10";

        // Busca o produto
        $produtos = $this->objModelProduto->query($sql)->fetchAll(\PDO::FETCH_OBJ);

        // Veirifca se encontrou o produto
        if (!empty($produtos))
        {


            foreach ($produtos as $produto)
            {
                // Busca as imagens do produto
                $produto->imagem = $this->objHelperApoio->getImagem($produto->id_produto, "produto");
            }

            $this->debug($produtos);

        }



        // Monta o array de retorno
        $dados = [
            "tipo" => true,
            "code" => 200,
            "produtos" =>  $produtos
        ];

        // Retorna
        $this->api($dados);

    } // End >> fun::pesquisa()


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
            $post["referencia"] = "NAO INFORMADO";

            // Verifica se informou os dados obrigatórios
            if(!empty($post["nome"]) &&
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

                        // Configura a porcentagem do desconto fornecedor
                        $post["descontoFornecedor"] = str_replace(".","", $post["descontoFornecedor"]);
                        $post["descontoFornecedor"] = str_replace(",",".", $post["descontoFornecedor"]);

                        // Calcula o valor de venda
                        $aux = $post["valorPago"] - (($post["descontoFornecedor"] / 100 ) * $post["valorPago"]);
                        $post["valorVenda"] = (($post["lucro"] / 100 ) * $aux) + $aux;

                        // Verifica se tem desconto
                        if(!empty($post["desconto"]))
                        {
                            // Configura o valor do desconto
                            $post["desconto"] = str_replace(".","", $post["desconto"]);
                            $post["desconto"] = str_replace(",",".", $post["desconto"]);
                        }

                        // Verifica se tem promoção
                        if(!empty($post["valorPromocao"]))
                        {
                            // Configura o valor do desconto
                            $post["valorPromocao"] = str_replace(".","", $post["valorPromocao"]);
                            $post["valorPromocao"] = str_replace(",",".", $post["valorPromocao"]);
                        }

                        // Verifica se tem esferico Min
                        if(!empty($post["esfMin"]))
                        {
                            // Configura o valor do desconto
                            $post["esfMin"] = str_replace(".","", $post["esfMin"]);
                            $post["esfMin"] = str_replace(",",".", $post["esfMin"]);
                        }

                        // Verifica se tem esferico Max
                        if(!empty($post["esfMax"]))
                        {
                            // Configura o valor do desconto
                            $post["esfMax"] = str_replace(".","", $post["esfMax"]);
                            $post["esfMax"] = str_replace(",",".", $post["esfMax"]);
                        }

                        // Verifica se tem adicao Min
                        if(!empty($post["adicaoMin"]))
                        {
                            // Configura o valor do desconto
                            $post["adicaoMin"] = str_replace(".","", $post["adicaoMin"]);
                            $post["adicaoMin"] = str_replace(",",".", $post["adicaoMin"]);
                        }

                        // Verifica se tem adicao Max
                        if(!empty($post["adicaoMax"]))
                        {
                            // Configura o valor do desconto
                            $post["adicaoMax"] = str_replace(".","", $post["adicaoMax"]);
                            $post["adicaoMax"] = str_replace(",",".", $post["adicaoMax"]);
                        }

                        // Verifica se tem cilindrico
                        if(!empty($post["cil"]))
                        {
                            // Configura o valor do desconto
                            $post["cil"] = str_replace(".","", $post["cil"]);
                            $post["cil"] = str_replace(",",".", $post["cil"]);
                        }

                        // Verifica se tem altura
                        if(!empty($post["altura"]))
                        {
                            // Configura o valor do desconto
                            $post["altura"] = str_replace(".","", $post["altura"]);
                            $post["altura"] = str_replace(",",".", $post["altura"]);
                        }


                        // Array de inserção
                        $salva = [
                            "id_categoria" => $post["id_categoria"],
                            "id_marca" => $post["id_marca"],
                            "id_indice" => $post["id_indice"],
                            "id_tratamento" => $post["id_tratamento"],
                            "id_tipo" => $post["id_tipo"],
                            "id_usuario" => $usuario->id_usuario,
                            "nome" => $post["nome"],
                            "referencia" => $post["referencia"],
                            "descricao" => (!empty($post["descricao"])) ? $post["descricao"] : null,
                            "valorPago" => $post["valorPago"],
                            "valorVenda" => $post["valorVenda"],
                            "lucro" => $post["lucro"],
                            "descontoFornecedor" => $post["descontoFornecedor"],
                            "prazoEntrega" => $post["prazoEntrega"],

                            "valorPromocao" => $post["valorPromocao"],
                            "esfMin" => $post["esfMin"],
                            "esfMax" => $post["esfMax"],
                            "cil" => $post["cil"],
                            "adicaoMin" => $post["adicaoMin"],
                            "adicaoMax" => $post["adicaoMax"],
                            "altura" => $post["altura"],

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


                // Verifica se vai alterar o lucro
                if(!empty($post["descontoFornecedor"]))
                {
                    // Configura o valor pago
                    $post["descontoFornecedor"] = str_replace(".","", $post["descontoFornecedor"]);
                    $post["descontoFornecedor"] = str_replace(",",".", $post["descontoFornecedor"]);
                }

                // Verifica se vai alterar o desconto
                if(!empty($post["desconto"]))
                {
                    // Configura o valor pago
                    $post["desconto"] = str_replace(".","", $post["desconto"]);
                    $post["desconto"] = str_replace(",",".", $post["desconto"]);
                }


                // Verifica se tem promoção
                if(!empty($post["valorPromocao"]))
                {
                    // Configura o valor do desconto
                    $post["valorPromocao"] = str_replace(".","", $post["valorPromocao"]);
                    $post["valorPromocao"] = str_replace(",",".", $post["valorPromocao"]);
                }

                // Verifica se tem esferico Min
                if(!empty($post["esfMin"]))
                {
                    // Configura o valor do desconto
                    $post["esfMin"] = str_replace(".","", $post["esfMin"]);
                    $post["esfMin"] = str_replace(",",".", $post["esfMin"]);
                }

                // Verifica se tem esferico Max
                if(!empty($post["esfMax"]))
                {
                    // Configura o valor do desconto
                    $post["esfMax"] = str_replace(".","", $post["esfMax"]);
                    $post["esfMax"] = str_replace(",",".", $post["esfMax"]);
                }

                // Verifica se tem adicao Min
                if(!empty($post["adicaoMin"]))
                {
                    // Configura o valor do desconto
                    $post["adicaoMin"] = str_replace(".","", $post["adicaoMin"]);
                    $post["adicaoMin"] = str_replace(",",".", $post["adicaoMin"]);
                }

                // Verifica se tem adicao Max
                if(!empty($post["adicaoMax"]))
                {
                    // Configura o valor do desconto
                    $post["adicaoMax"] = str_replace(".","", $post["adicaoMax"]);
                    $post["adicaoMax"] = str_replace(",",".", $post["adicaoMax"]);
                }

                // Verifica se tem cilindrico
                if(!empty($post["cil"]))
                {
                    // Configura o valor do desconto
                    $post["cil"] = str_replace(".","", $post["cil"]);
                    $post["cil"] = str_replace(",",".", $post["cil"]);
                }

                // Verifica se tem altura
                if(!empty($post["altura"]))
                {
                    // Configura o valor do desconto
                    $post["altura"] = str_replace(".","", $post["altura"]);
                    $post["altura"] = str_replace(",",".", $post["altura"]);
                }
                

                // Reculcula o valor de venda
                $aux = $post["valorPago"] - (($post["descontoFornecedor"] / 100 ) * $post["valorPago"]);
                $post["valorVenda"] = (($post["lucro"] / 100 ) * $aux) + $aux;

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




    public function reajuste()
    {
        // Variaveis
        $dados = null;
        $usuario = null;
        $post = null;
        $where = null;
        $altera = null;

        // Recupera o usuário logado
        $usuario = $this->objHelperApoio->seguranca();

        // Verifica se o usuário possui permissão
        if(!empty($usuario))
        {
            // Recupera os dados post
            $post = $_POST;

            // Verifica se informou a marca
            if(!empty($post["id_marca"]))
            {
                // Where
                $where["id_marca"] = $post["id_marca"];
            }

            // Verifica se informou a marca
            if(!empty($post["id_categoria"]))
            {
                // Where
                $where["id_categoria"] = $post["id_categoria"];
            }

            // Verifica se informou a marca
            if(!empty($post["id_tipo"]))
            {
                // Where
                $where["id_tipo"] = $post["id_tipo"];
            }

            // Verifica o que vai alterar
            if(!empty($post["valorPago"]))
            {
                // Limpa o array
                $post["valorPago"] = str_replace(".","", $post["valorPago"]);
                $post["valorPago"] = str_replace(",",".", $post["valorPago"]);

                if(strtolower($post["acao"]) == "aumentar")
                {
                    // Array de alteração
                    $altera = ["valorPago =" => "((({$post["valorPago"]} / 100) * valorPago) + valorPago)"];
                }
                else
                {
                    // Array de alteração
                    $altera = ["valorPago =" => "(valorPago - (({$post["valorPago"]} / 100) * valorPago))"];
                }
            }
            elseif(!empty($post["lucro"]))
            {
                // Limpa o array
                $post["lucro"] = str_replace(".","", $post["lucro"]);
                $post["lucro"] = str_replace(",",".", $post["lucro"]);

                // Array de alteração
                $altera = ["lucro" => $post["lucro"]];
            }
            elseif(!empty($post["desconto"]))
            {
                // Limpa o array
                $post["desconto"] = str_replace(".","", $post["desconto"]);
                $post["desconto"] = str_replace(",",".", $post["desconto"]);

                // Array de alteração
                $altera = ["desconto" => $post["desconto"]];
            }

            // Verifica se está alterando alguma coisa
            if(!empty($altera))
            {
                // Altera e verifica
                if($this->objModelProduto->update($altera, $where) != false)
                {
                    // Verifica se alterou
                    if($this->objModelProduto->update(["valorVenda =" => "(((lucro / 100) * valorPago) + valorPago)"], $where) != false)
                    {
                        // Recupera o numero de produtos alterados
                        $numProdutos = $this->objModelProduto
                            ->get($where)
                            ->rowCount();

                        // Retorno
                        $dados = [
                            "tipo" => true,
                            "code" => 200,
                            "mensagem" => "Produtos reajustados com sucesso.",
                            "objeto" => [
                                "total" => $numProdutos
                            ]
                        ];
                    }
                    else
                    {
                        // Msg
                        $dados = ["mensagem" => "Ocorreu um erro ao alterar produto."];
                    } // Error >> Ocorreu um erro ao alterar produto
                }
                else
                {
                    // Msg
                    $dados = ["mensagem" => "Ocorreu um erro ao reajustar dados."];
                } // Error >> Ocorreu um erro ao reajustar dados.
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
            $dados = ["mensagem" => "Usuário sem permissão"];
        } // Error >> Usuário sem permissão.

        // Retorno
        $this->api($dados);

    } // End >> fun::reajuste()




    /**
     * Método responsável por dar desconto
     * em um determinado produto
     * --------------------------------------------------
     * @url api/produto/desconto
     * @method POST
     */
    public function desconto()
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
        if($usuario->nivel == "admin" || $usuario->nivel == "vendedor")
        {
            // Verifica se informou os dados obrigatórios
            if(!empty($post["id_usuario"]) && !empty($post["id_produto"]))
            {
                // Busca o produto
                $produto = $this->objModelProduto
                    ->get(["id_produto" => $post["id_produto"]])
                    ->fetch(\PDO::FETCH_OBJ);

                // Verifica se o produto existe
                if(!empty($produto))
                {

                    // Verificando se existe desconto
                    if(!empty($produto->desconto))
                    {
                        // Aplica o desconto
                        $produto->valorVenda = $produto->valorVenda - (($produto->desconto / 100) * $produto->valorVenda);
                        $produto->valorVenda = number_format($produto->valorVenda, 2, ',', '.');

                        // Retorno
                        $dados = [
                            "tipo" => true,
                            "code" => 200,
                            "mensagem" => "Desconto adicionado com sucesso",
                            "objeto" => $produto
                        ];
                    }
                    else
                    {
                        // Msg
                        $dados = ["mensagem" => "Sem desconto no momento."];

                    } // Error >> Sem desconto.

                }
                else
                {
                    // Msg
                    $dados = ["mensagem" => "Produto não foi encontrado."];

                } // Error >> Produto não foi encontrado.
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

    } // End >> fun::desconto()

} // End >> Class::Produto