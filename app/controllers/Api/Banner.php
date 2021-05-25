<?php

// NameSpace
namespace Controller\Api;

// Importações
use Helper\Historico;
use Sistema\Controller;
use Sistema\Helper\File;
use Sistema\Helper\Seguranca;

// Inicia a Classe
class Banner extends Controller
{
    // Objetos
    private $objModelBanner;
    private $objSeguranca;
    private $objHelperHistorico;

    // Método construtor
    public function __construct()
    {
        // Chama o pai
        parent::__construct();

        // Instancia os objetos
        $this->objModelBanner = new \Model\Banner();
        $this->objSeguranca = new Seguranca();
        $this->objHelperHistorico = new Historico();

    } // End >> fun::__construct()


    /**
     * Método responsável por inserir um novo banner no
     * sistema. Fazendo o upload da imagem.
     * -----------------------------------------------------
     * @url api/banner/insert
     * @method POST
     */
    public function insert()
    {
        // Variaveis
        $dados = null;
        $usuario = null;

        // Recupera o usuario
        $usuario = $this->objSeguranca->security();

        // Verifica se possui permissão
        if($usuario->nivel == "admin")
        {
            // Verifica se informou a imagem
            if(!empty($_FILES["arquivo"]) && $_FILES["arquivo"]["size"] > 0)
            {
                // Caminho
                $caminho = "./storage/banner/";

                // Por preocaução cria o diretorio se não existir
                (!is_dir($caminho) ? mkdir($caminho, 0777, true) : "");

                // Instancia o método responsável pelo upload
                $objFile = new File();

                // Informa as configurações
                $objFile->setMaxSize(1 * MB);
                $objFile->setExtensaoValida(["png","jpg","jpeg","gif"]);
                $objFile->setFile($_FILES["arquivo"]);

                // Verifica se o tamanho está no limite
                if($objFile->validaSize())
                {
                    // Verifica se a extensão é suportada
                    if($objFile->validaExtensao())
                    {
                        // Realiza o upload
                        $arquivo = $objFile->upload();

                        // Verifica se fez o upload
                        if(!empty($arquivo))
                        {
                            // Array de inserção
                            $salva = [
                                "arquivo" => $arquivo,
                                "cadastro" => date("Y-m-d H:i:s")
                            ];

                            // Insere
                            $obj = $this->objModelBanner->insert($salva);

                            // Verifica se inseriu no banco
                            if(!empty($obj))
                            {
                                // Busca o banner
                                $obj = $this->objModelBanner
                                    ->get(["id_banner" => $obj])
                                    ->fetch(\PDO::FETCH_OBJ);

                                // HISTORICO ---------------------------------
                                $this->objHelperHistorico->salva([
                                    "id_usuario" => $usuario->id_usuario,
                                    "tabela" => "banner",
                                    "chavePrimaria" => $obj->id_banner,
                                    "acao" => "insert",
                                    "descricao" => "Adicionou um novo banner (#{$obj->id_banner})",
                                    "json" => json_encode($obj)
                                ]);
                                // -------------------------------------------

                                // Monta o Array de retorno
                                $dados = [
                                    "tipo" => true,
                                    "code" => 200,
                                    "mensagem" => "Banner adicionado com sucesso.",
                                    "objeto" => $obj
                                ];
                            }
                            else
                            {
                                // Msg
                                $dados = ["mensagem" => "Ocorreu um erro ao salvar o banner."];
                            } // Error >> Ocorreu um erro ao salvar o banner.
                        }
                        else
                        {
                            // Msg
                            $dados = ["mensagem" => "Ocorreu um erro ao realizar o upload."];
                        } // Error >> Ocorreu um erro ao realizar o upload.
                    }
                    else
                    {
                        // Msg
                        $dados = ["mensagem" => "A extensão do arquivo informado não é suportado."];
                    } // Error >> A extensão do arquivo informado não é suportado.
                }
                else
                {
                    // Msg
                    $dados = ["mensagem" => "O arquivo é maior que o permitido."];
                } // Error >> O arquivo é maior que o permitido.
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

        } // Error >> Usuário sem permissão.

        // Retorno
        $this->api($dados);

    } // End >> fun::insert()


    /**
     * Método responsável por deletar um determindado
     * banner do sistema, deletando a imagem do servidor
     * e o registro no banco de dados.
     * -----------------------------------------------------
     * @param $id [ID do banenr]
     * -----------------------------------------------------
     * @url api/banner/delete
     * @method DELETE
     */
    public function delete($id)
    {
        // Variaveis
        $dados = null;
        $usuario = null;
        $obj = null;

        // Recupera o usuario
        $usuario = $this->objSeguranca->security();

        // Verifica se é admin
        if($usuario->nivel == "admin")
        {
            // Busca o objeto
            $obj = $this->objModelBanner
                ->get(["id_banner" => $id])
                ->fetch(\PDO::FETCH_OBJ);

            // Verifica encontrou o banner informado existe
            if(!empty($obj))
            {
                // Deleta o banner
                if($this->objModelBanner->delete(["id_banner" => $id]) != false)
                {
                    // Deleta a imagem do servidor
                    unlink("./storage/banner/" .  $obj->imagem);

                    // HISTORICO ---------------------------------
                    $this->objHelperHistorico->salva([
                        "id_usuario" => $usuario->id_usuario,
                        "tabela" => "banner",
                        "chavePrimaria" => $obj->id_banner,
                        "acao" => "delete",
                        "descricao" => "Deletou um banner do sistema (#{$obj->id_banner})",
                        "json" => json_encode($obj)
                    ]);
                    // -------------------------------------------

                    // Informa que deu certo
                    $dados = [
                        "tipo" => true,
                        "code" => 200,
                        "mensagem" => "Banner deletado com sucesso.",
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
                $dados = ["mensagem" => "Banner não encontrado ou já deletado."];
            } // Error >> Banner não encontrado ou já deletado.
        }
        else
        {
            // Msg
            $dados = ["mensagem" => "Usuário sem permissão."];
        } // Error >> Usuário sem permissão.

        // Retorno
        $this->api($dados);

    } // End >> fun::update()

} // End >> Class::Banner