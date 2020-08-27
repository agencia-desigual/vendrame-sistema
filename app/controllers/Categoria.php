<?php
/**
 * Created by PhpStorm.
 * User: Igor
 * Date: 27/08/2020
 * Time: 15:26
 */

namespace Controller;


use Helper\Apoio;
use Sistema\Controller;

class Categoria extends Controller
{
    // Objetos
    private $objModelCategoria;
    private $objHelperApoio;

    // Método construtor
    public function __construct()
    {
        // Chama o pai
        parent::__construct();

        // Instanci os objetos
        $this->objModelCategoria = new \Model\Categoria();
        $this->objHelperApoio = new Apoio();

    } // End >> fun::__construct()


    /**
     * Método responsável por listar todas as
     * categorias cadastradas no sistema.
     * ---------------------------------------------
     * @url painel/categorias
     */
    public function listar()
    {
       $a =  $this->objHelperApoio->getCategorias();

       $this->debug($a);

    } // End >> fun::listar()

    public function adicionar()
    {

    }

    public function alterar($id)
    {

    }

} // End >> Class::Categoria