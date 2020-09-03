<?php
/**
 * Created by PhpStorm.
 * User: Igor
 * Date: 02/06/2020
 * Time: 10:52
 */

namespace Controller\Api;

// Importação
use Helper\Historico;
use Helper\Thumb;
use Sistema\Controller;
use Sistema\Helper\File;
use Sistema\Helper\Seguranca;

// Inicia a classe
class Imagem extends Controller
{
    // Objetos
    private $objModelImagem;
    private $objModelProduto;

    private $objHelperHistorico;
    private $objSeguranca;

    // Método construtor
    public function __construct()
    {
        // Chama o pai
        parent::__construct();

        // Instancia os objetos
        $this->objModelProduto = new \Model\Produto();
        $this->objModelImagem = new \Model\Imagem();

        $this->objHelperHistorico = new Historico();
        $this->objSeguranca = new Seguranca();

    } // End >> fun::__construct()


    /**
     * Método responsável por retornar um acesso especifico e suas
     * FK, deve ser informado via paramento o ID do item.
     * -----------------------------------------------------------------
     * @param $id
     * -----------------------------------------------------------------
     * @author igorcacerez
     * @url api/imagem/get/[ID]
     * @method GET
     */
    public function get($id)
    {
        // Variaveis
        $dados = null;
        $objeto = null;

        // Busca o Objeto com páginacao
        $objeto = $this->objModelImagem->get(["id_imagem" => $id]);

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
     * Método responsável por retornar todos os acessos cadastrados
     * no sistema, podendo informar a ordem, limit e where.
     * -----------------------------------------------------------------
     * @author igorcacerez
     * -----------------------------------------------------------------
     * @url api/imagem/get
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
        $objeto = $this->objModelImagem->get($where, $ordem, ($inicio . "," . $limite));

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
     * Método responsável por inserir uma determinada imagem para
     * um produto já existente. O método deve gerar as thumb e otimizar
     * as imagems.
     * -----------------------------------------------------------------
     * @param $id [Id do produto]
     * -----------------------------------------------------------------
     * @url api/imagem/insert/[ID]
     * @method POST
     */
    public function insert($id)
    {
        // Variaveis
        $dados = null;
        $usuario = null;
        $produto = null;
        $obj = null;
        $caminho = null;
        $arquivo = null;
        $salva = null;

        // Seguranca
        $usuario = $this->objSeguranca->security();

        // Busca o produto
        $produto = $this->objModelProduto
            ->get(["id_produto" => $id])
            ->fetch(\PDO::FETCH_OBJ);

        // Verifica se o produto existe
        if(!empty($produto))
        {
            // Verifica se o usuário Possui permissão
            if($usuario->nivel == "admin")
            {
                // Verifica se informou a imagem
                if($_FILES["arquivo"]["size"] > 0)
                {
                    // Instancia o objeto
                    $objFile = new File();

                    // Caminho
                    $caminho = "./storage/produto/" . $id . "/";

                    if(!is_dir($caminho))
                    {
                        // Cria
                        mkdir($caminho, 0777, true);
                    }

                    // Seta as configurações
                    $objFile->setStorange($caminho);
                    $objFile->setMaxSize(3 * MB);
                    $objFile->setExtensaoValida(["jpg","jpeg","png","wep"]);
                    $objFile->setFile($_FILES["arquivo"]);

                    // Verifica se o tamanho está no limite
                    if($objFile->validaSize())
                    {
                        // Verifica se é uma extensão permitida
                        if($objFile->validaExtensao())
                        {
                            // Realiza o upload
                            $arquivo = $objFile->upload();

                            // Verifica se deu certo
                            if(!empty($arquivo))
                            {
                                // Instancia o objeto de Thumb
                                $objThumb1 = new Thumb();

                                // Adiciona as informações
                                $objThumb1->setNome("thumb_" . $arquivo);
                                $objThumb1->setStorage($caminho);
                                $objThumb1->setTamanho("1000","1000");
                                $objThumb1->setFile($caminho . $arquivo);

                                // Salva a thumb
                                $arquivoAux = $objThumb1->save();

                                // Deleta o arquivo original
                                unlink($caminho .  $arquivo);

                                // Arquivo
                                $arquivo = $arquivoAux;

                                // Verifica se gerou a thumb
                                if(!empty($arquivo))
                                {
                                    // Otimiza a imagem
                                    $objFile->compressImage($caminho . $arquivo, $caminho . $arquivo);

                                    // Monta o array de inserção
                                    $salva = [
                                        "id_produto" => $id,
                                        "imagem" => $arquivo,
                                        "cadastro" => date("Y-m-d H:i:s")
                                    ];

                                    // Verifica se é a principal
                                    if(!empty($_POST["principal"]))
                                    {
                                        // Add o principal
                                        $salva["principal"] = true;
                                    }


                                    // Insere
                                    $img = $this->objModelImagem->insert($salva);

                                    // Verifica se inseriu
                                    if($img != false)
                                    {
                                        // Busca a imagem
                                        $img = $this->objModelImagem
                                            ->get(["id_imagem" => $img])
                                            ->fetch(\PDO::FETCH_OBJ);

                                        // Verifica se é principal
                                        if($img->principal == true)
                                        {
                                            // Altera o principal anterior
                                            $this->objModelImagem
                                                ->update(
                                                    ["principal" => false],
                                                    ["id_produto" => $id, "id_imagem !=" => $img->id_imagem]
                                                );
                                        }

                                        // HISTORICO ---------------------------------
                                        $this->objHelperHistorico->salva([
                                            "id_usuario" => $usuario->id_usuario,
                                            "tabela" => "imagem",
                                            "chavePrimaria" => $img->id_imagem,
                                            "acao" => "delete",
                                            "descricao" => "Adicionou uma imagem ao produto {$produto->nome} (#{$img->id_imagem})",
                                            "json" => json_encode($img)
                                        ]);
                                        // -------------------------------------------

                                        // Monta o Array de retorno
                                        $dados = [
                                            "tipo" => true,
                                            "code" => 200,
                                            "mensagem" => "Imagem adicionada com sucesso.",
                                            "objeto" => $img
                                        ];

                                    }
                                    else
                                    {
                                        // Deleta os arquivos
                                        unlink($caminho . "full/" . $arquivo);
                                        unlink($caminho . "thumb/" . $arquivo);

                                        // Msg
                                        $dados = ["mensagem" => "Ocorreu um erro ao inserir a imagem."];

                                    } // Error >> Ocorreu um erro ao inserir a imagem no banco de dados.
                                }
                                else
                                {
                                    // Msg
                                    $dados = ["mensagem" => "Ocorreu um erro ao redimensionar a imagem."];
                                } // Error >> Ocorreu um erro ao redimensionar a imagem.
                            }
                            else
                            {
                                // Msg
                                $dados = ["mensagem" => "Ocorreu um erro ao realizar o upload da imagem."];
                            } // Error >> Ocorreu um erro ao realizar o upload da imagem.
                        }
                        else
                        {
                            // Msg
                            $dados = ["mensagem" => "A extensão do arquivo não é permitida."];
                        } // Error >> A extensão utilizada não é permitida.
                    }
                    else
                    {
                        // Msg
                        $dados = ["mensagem" => "A imagem não pode ser maior que 3MB."];
                    } // Error >> A imagem não pode ser maior que 3MB.
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
                $dados = ["mensagem" => "Usuário sem permissão."];
            } // Error >> Usuário sem permissão
        }
        else
        {
            // Msg
            $dados = ["mensagem" => "Produto informado não foi encontrado."];
        } // Error >> Produto informado não foi encontrado.

        // Retorno
        $this->api($dados);

    } // End >> fun::insert()



    /**
     * Método responsável por setar uma determinada imagem como principal.
     * Apenas administradores podem utilizar.
     * ----------------------------------------------------
     * @param $id [Id da Imagem]
     * ----------------------------------------------------
     * @author igorcacerez
     * ----------------------------------------------------
     * @url api/imagem/principal/[Id da imagem]
     * @method PUT
     */
    public function principal($id)
    {
        // Variaveis
        $dados = null;
        $usuario = null;
        $imagem = null;

        // Recupera o usuário
        $usuario = $this->objSeguranca->security();

        // Where
        $where = ["id_imagem" => $id];

        // Busca a imagem
        $imagem = $this->objModelImagem
            ->get($where)
            ->fetch(\PDO::FETCH_OBJ);

        // Verifica se a imagem existe
        if(!empty($imagem))
        {
            // Busca o produto
            $produto = $this->objModelProduto
                ->get(["id_produto" => $imagem->id_produto])
                ->fetch(\PDO::FETCH_OBJ);

            // Verifica se o usuário possui permissão
            if($usuario->nivel == "admin")
            {
                // Verifica se a imagem já é principal
                if($imagem->principal == false)
                {
                    // Remove a principal atualmente
                    $this->objModelImagem
                        ->update(["principal" => false], ["id_produto" => $imagem->id_produto]);

                    // Adiciona a imagem como principal
                    if($this->objModelImagem->update(["principal" => true], $where) != false)
                    {

                        // HISTORICO ---------------------------------
                        $this->objHelperHistorico->salva([
                            "id_usuario" => $usuario->id_usuario,
                            "tabela" => "imagem",
                            "chavePrimaria" => $id,
                            "acao" => "update",
                            "descricao" => "Alterou a capa do produto {$produto->nome} (#{$imagem->id_imagem})",
                            "json" => null
                        ]);
                        // -------------------------------------------

                        // Array de sucesso
                        $dados = [
                            "tipo" => true,
                            "code" => 200,
                            "mensagem" => "A imagem principal foi alterada."
                        ];
                    }
                    else
                    {
                        // Msg
                        $dados = ["mensagem" => "Ocorreu um erro em setar a imagem como principal."];

                    } // Error >> Ocorreu um erro em setar a imagem como principal.
                }
                else
                {
                    // Msg
                    $dados = ["mensagem" => "A imagem já é a principal."];

                } // Error >> A imagem já é a principal.
            }
            else
            {
                // Msg
                $dados = ["mensagem" => "Usuário sem permissão."];
            } // Error >> Usuário sem permissão.
        }
        else
        {
            // Mag
            $dados = ["mensagem" => "Imagem informada não foi encontrada."];
        } // Error >> Imagem informada não foi encontrada.

        // Retorno
        $this->api($dados);

    } // End >> fun::principal()



    /**
     * Método responsável por deleter uma determinada imagem.
     * Apenas admins podem fazer isso.
     * ----------------------------------------------------
     * @param $id [Id da Imagem]
     * ----------------------------------------------------
     * @author igorcacerez
     * ----------------------------------------------------
     * @url api/imagem/delete/[Id da imagem]
     * @method DELETE
     */
    public function delete($id)
    {
        // Variaveis
        $dados = null;
        $usuario = null;
        $imagem = null;

        // Recupera o usuário
        $usuario = $this->objSeguranca->security();

        // Where
        $where = ["id_imagem" => $id];

        // Busca a imagem
        $imagem = $this->objModelImagem
            ->get($where)
            ->fetch(\PDO::FETCH_OBJ);

        // Verifica se a imagem existe
        if(!empty($imagem))
        {
            // Busca o produto
            $produto = $this->objModelProduto
                ->get(["id_produto" => $imagem->id_produto])
                ->fetch(\PDO::FETCH_OBJ);

            // Verifica se o usuário possui permissão
            if($usuario->nivel == "admin")
            {
                // Verifica se a imagem não é principal
                if($imagem->principal == false)
                {
                    // Deleta
                    if($this->objModelImagem->delete($where) != false)
                    {
                        // HISTORICO ---------------------------------
                        $this->objHelperHistorico->salva([
                            "id_usuario" => $usuario->id_usuario,
                            "tabela" => "imagem",
                            "chavePrimaria" => $id,
                            "acao" => "delete",
                            "descricao" => "Deletou a imagem #{$imagem->id_imagem} do produto {$produto->nome} (#{$imagem->id_imagem})",
                            "json" => json_encode($imagem)
                        ]);
                        // -------------------------------------------

                        // Deleta o arquivo
                        unlink("./storage/produto/" . $produto->id_produto . "/" . $imagem->imagem);

                        // Array de sucesso
                        $dados = [
                            "tipo" => true,
                            "code" => 200,
                            "mensagem" => "A imagem foi deletada.",
                            "objeto" => $imagem
                        ];
                    }
                    else
                    {
                        // Msg
                        $dados = ["mensagem" => "Ocorreu um erro ao tentar deletar a imagem."];

                    } // Error >> Ocorreu um erro ao tentar deletar a imagem.
                }
                else
                {
                    // Msg
                    $dados = ["mensagem" => "Impossível deletar. Essa imagem é a principal."];
                } // Error >> Imagem principal.
            }
            else
            {
                // Msg
                $dados = ["mensagem" => "Usuário sem permissão."];
            } // Error >> Usuário sem permissão.
        }
        else
        {
            // Mag
            $dados = ["mensagem" => "Imagem informada não foi encontrada."];
        } // Error >> Imagem informada não foi encontrada.

        // Retorno
        $this->api($dados);

    } // End >> fun::delete()

} // End >> Class::Api\Imagem