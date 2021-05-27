<?php

// NameSpace
namespace Controller;

// Importações
use Helper\Apoio;
use Sistema\Controller;

// Inicia o banner
class Banner extends Controller
{
    // Objetos
    private $objModelBanner;
    private $objHelperApoio;

    // Método construtor
    public function __construct()
    {
        // Chama o construtor pai
        parent::__construct();

        // Instancia os objetos
        $this->objModelBanner = new \Model\Banner();
        $this->objHelperApoio = new Apoio();

    } // End >> fun::__construct()


    /**
     * Método responsável por listar todos os
     * banners cadastrados no sistema.
     * ---------------------------------------------
     * @url painel/banners
     */
    public function listar()
    {
        // Variaveis
        $dados = null;
        $usuario = null;
        $banners = null;

        // Recupera o usuário logado
        $usuario = $this->objHelperApoio->seguranca();

        // Verifica se possui permissão
        if($usuario->nivel == "admin")
        {
            // Busca todos os banners
            $banners = $this->objModelBanner
                ->get(null, "id_banner DESC")
                ->fetchAll(\PDO::FETCH_OBJ);

            // Array de retorno
            $dados = [
                "usuario" => $usuario,
                "banners" => $banners,
                "js" => [
                    "modulos" => ["Banner"]
                ]
            ];

            // View
            $this->view("painel/banner/listar", $dados);
        }

    } // End >> fun::listar()


    /**
     * Método responsável por adicionar um novo banner
     * no sistema, verificando se o usuário possui
     * permissão.
     * --------------------------------------------------
     * @url painel/banner/adicionar
     */
    public function adicionar()
    {
        // Variaveis
        $dados = null;
        $usuario = null;
        $banners = null;

        // Recupera o usuário logado
        $usuario = $this->objHelperApoio->seguranca();

        // Verifica se possui permissão
        if($usuario->nivel == "admin")
        {
            // Array de retorno
            $dados = [
                "usuario" => $usuario,
                "js" => [
                    "modulos" => ["Banner"]
                ]
            ];

            // View
            $this->view("painel/banner/adicionar", $dados);
        }

    } // End >> fun::adicionar()

} // End >> Class::Banner