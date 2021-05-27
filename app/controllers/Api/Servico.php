<?php

// NameSpace
namespace Controller\Api;

// Importações
use Helper\Apoio;
use Sistema\Controller;
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
                // Insere
                $obj = $this->objModelServico->insert($post);

                // Verifica se inseriu
                if(!empty($obj))
                {
                    // Informa que deu certo
                    $dados = [
                        "tipo" => true,
                        "code" => 200,
                        "mensagem" => "Adicionado com sucesso."
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


    public function update($id)
    {
        // Veriaveis
        $dados = null;
        $usuario = null;


    } // End >> fun::update()

} // End >> Class::Servico