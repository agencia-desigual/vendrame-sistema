<?php
/**
 * Created by PhpStorm.
 * User: Igor
 * Date: 26/03/2019
 * Time: 18:29
 */

namespace Controller;

use Sistema\Controller as CI_controller;


class Site extends CI_controller
{

    // Método construtor
    function __construct()
    {
        // Carrega o contrutor da classe pai
        parent::__construct();
    }



    /**
     * Método responsável por montar a página inicial do
     * catalogo de produtos
     * ------------------------------------------------------
     * @url PRINCIPAL
     */
    public function index()
    {

        // Variaveis
        $dados = null;
        $view = "";
        $usuario = null;

        // Verificando se o usuario está logado
        $usuario = (!empty($_SESSION["usuario"])) ? $_SESSION["usuario"] : null;

        if (!empty($usuario))
        {

            // Busca as marcas
            $marcas = null;

            // View correta
            $view = "site/index";

            // As tags SEO e SMO
            $seo = $this->getSEO();

            // Dados da view
            $dados = [
                "seo" => $seo["seo"],
                "smo" => $seo["smo"],
                "usuario" => $usuario,
                "marcas" => $marcas,
                "js" => [
                    "modulos" => ["Produtos"]
                ]
            ];
        }
        else
        {
            // View correta
            $view = "site/acesso/login";

            // As tags SEO e SMO
            $seo = $this->getSEO();

            // Dados da view
            $dados = [
                "seo" => $seo["seo"],
                "smo" => $seo["smo"],
                "js" => [
                    "modulos" => ["Login"]
                ]
            ];
        }

        // Carrega a view
        $this->view($view,$dados);
    }



    /**
     * Método responsável por montar a página de sair para o
     * vendedor e o administrador.
     * ------------------------------------------------------
     * @url /sair
     */
    public function sair()
    {
        // Destroi a session
        session_destroy();

        // Chama a página de sair
        $this->view("site/acesso/sair");

    }// End >> fun::sair()


} // END::Class Site