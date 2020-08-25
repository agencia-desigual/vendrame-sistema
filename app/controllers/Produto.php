<?php
/**
 * Created by PhpStorm.
 * User: Igor
 * Date: 25/08/2020
 * Time: 11:58
 */

// NameSpace
namespace Controller;

// Importações
use Helper\Apoio;
use Sistema\Controller;

// Classe
class Produto extends Controller
{
    // Objetos
    private $objModelProduto;
    private $objHelperApoio;

    // Método construtor
    public function __construct()
    {
        // Chama o pai
        parent::__construct();

        // Instancia os objetos
        $this->objModelProduto = new \Model\Produto();
        $this->objHelperApoio = new Apoio();

    } // End >> fun::__construct()




} // End >> Class::Produto