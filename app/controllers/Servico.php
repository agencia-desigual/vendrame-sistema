<?php

// NameSpace
namespace Controller;

// Importações
use Helper\Apoio;
use Sistema\Controller;

// Inicia a Classe
class Servico extends Controller
{
    // Objetos
    private $objModelServico;
    private $objModelMarca;
    private $objHelperApoio;

    // Método construtor
    public function __construct()
    {
        // Inicia o construtor
        parent::__construct();

        // Instancia os objetos
        $this->objModelServico = new \Model\Servico();
        $this->objModelMarca = new \Model\Marca();
        $this->objHelperApoio = new Apoio();

    } // End >> fun::__construct()


    /**
     * Método responsável por montar a página do painel
     * onde lista todos os servicos cadastrados no sitema
     * para o usuário admin gerenciar.
     * -----------------------------------------------------
     * @url painel/servicos
     * @method GET
     */
    public function listar()
    {
        // Variaveis
        $dados = null;
        $usuario = null;
        $servicos = null;
        $marcas = [];

        // Recupera o usuário logado
        $usuario = $this->objHelperApoio->seguranca();

        // Verifica se possui permissão
        if($usuario->nivel == "admin")
        {
            // Busca todos os produtos
            $servicos = $this->objModelServico
                ->get()
                ->fetchAll(\PDO::FETCH_OBJ);

            // Percorre todos os servicos
            foreach ($servicos as $servico)
            {
                // Verifica se não tem a marca salva
                if(!empty($servico->id_marca))
                {
                    if(empty($marcas[$servico->id_marca]))
                    {
                        // Busca a marca
                        $marcas[$servico->id_marca] = $this->objModelMarca
                            ->get(["id_marca" => $servico->id_marca])
                            ->fetch(\PDO::FETCH_OBJ);
                    }

                    // Adiciona os itens
                    $servico->marca = $marcas[$servico->id_marca]->nome;
                }
                else
                {
                    // Adiciona os itens
                    $servico->marca = " - ";
                }
            }

            // Retorno
            $dados = [
                "usuario" => $usuario,
                "servicos" => $servicos,
                "js" => [
                    "modulos" => ["Servico"]
                ]
            ];

            // View
            $this->view("painel/servico/listar", $dados);
        }

    } // End >> fun::listar()


    /**
     * Método responsável por montar a página com todas
     * as informações necessárias para adicionar um
     * novo servico.
     * -----------------------------------------------------
     * @url painel/servico/adicionar
     * @method GET
     */
    public function adicionar()
    {
        // Variaveis
        $dados = null;
        $usuario = null;
        $marcas = null;

        // Recupera o usuario
        $usuario = $this->objHelperApoio->seguranca();

        // Verifica se é admin
        if($usuario->nivel == "admin")
        {
            // Busca todas as marcas
            $marcas = $this->objModelMarca
                ->get()
                ->fetchAll(\PDO::FETCH_OBJ);

            // Dados
            $dados = [
                "marcas" => $marcas,
                "usuario" => $usuario,
                "js" => [
                    "modulos" => ["Servico"]
                ]
            ];

            // Retorno
            $this->view("painel/servico/adicionar", $dados);
        }

    } // End >> fun::adicionar()


    /**
     * Método responsável por montar a página com todas
     * as informações necessárias para alterar um servico
     * já existente.
     * -----------------------------------------------------
     * @url painel/servico/update/[ID]
     * @method GET
     */
    public function alterar($id)
    {
        // Variaveis
        $dados = null;
        $usuario = null;
        $obj = null;
        $marcas = null;

        // Recupera o usuário logado
        $usuario = $this->objHelperApoio->seguranca();

        // Verifica se é admin
        if($usuario->nivel == "admin")
        {
            // Busca o objeto a ser alterado
            $obj = $this->objModelServico
                ->get(["id_servico" => $id])
                ->fetch(\PDO::FETCH_OBJ);

            // Verifica se encontrou
            if(!empty($obj))
            {
                // Busca todas as marcas
                $marcas = $this->objModelMarca
                    ->get()
                    ->fetchAll(\PDO::FETCH_OBJ);

                // Retorno
                $dados = [
                    "usuario" => $usuario,
                    "marcas" => $marcas,
                    "servico" => $obj,
                    "js" => [
                        "modulos" => ["Servico"]
                    ]
                ];

                // Retorno
                $this->view("painel/servico/alterar", $dados);
            }
            else
            {
                $this->adicionar();
            } // O item existe manda inserir
        }

    } // End >> fun::deletar()

} // End >> Class::Servico