<?php
/**
 * Created by PhpStorm.
 * User: Igor
 * Date: 27/08/2020
 * Time: 15:26
 */

namespace Controller;


use Helper\Apoio;
use Model\View\CategoriaFilha;
use Sistema\Controller;

class Categoria extends Controller
{
    // Objetos
    private $objModelCategoria;
    private $objModelViewCategoriaFilha;
    private $objHelperApoio;

    // Método construtor
    public function __construct()
    {
        // Chama o pai
        parent::__construct();

        // Instanci os objetos
        $this->objModelCategoria = new \Model\Categoria();
        $this->objModelViewCategoriaFilha = new CategoriaFilha();

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
        // Variaveis
        $dados = null;
        $usuario = null;
        $categorias = null;

        // Recupera o usuário logado
        $usuario = $this->objHelperApoio->seguranca();

        // Verifica se possui permissão
        if($usuario->nivel == "admin")
        {
            // Busca todas as categorias cadastradas
            $categorias = $this->objModelViewCategoriaFilha
                ->get()
                ->fetchAll(\PDO::FETCH_OBJ);

            // Percorre todas as categorias
            foreach ($categorias as $cat)
            {
                // Busca as filhas da categoria
                $cat->filhas = $this->objHelperApoio->getCategoriaFilha($cat->id_categoria);
            }

            // Array de retorno
            $dados = [
                "usuario" => $usuario,
                "categorias" => $categorias,
                "js" => [
                    "modulos" => ["Categoria"]
                ]
            ];

            // View
            $this->view("painel/categoria/listar", $dados);
        }

    } // End >> fun::listar()

    public function adicionar()
    {

    }

    public function alterar($id)
    {

    }

} // End >> Class::Categoria