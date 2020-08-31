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
        $aa = [];

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
        // Variaveis
        $dados = null;
        $usuario = null;
        $categorias = null;

        $aux = [];

        // Recupera o logado
        $usuario = $this->objHelperApoio->seguranca();

        // Verifica se possui permissão
        if($usuario->nivel == "admin")
        {
            $categorias  = $this->objModelCategoria
                ->get()
                ->fetchAll(\PDO::FETCH_OBJ);

            foreach ($categorias as $cat)
            {
                $cat->pai = $this->getCategoriaPai($cat->id_categoria);
            }

            $this->debug($categorias);
        }

    } // End >> fun::adicionar()

    public function alterar($id)
    {

    }




    /**
     * Método responsável por buscar todas as categorias
     * filhas de uma determinada categoria existente.
     * -----------------------------------------------------------------
     * @param $idPai [Id da categoria - Pode ser null]
     * @return array|null
     */
    public function getCategoriaPai($idPai)
    {
        // Objetos
        $objModelCategoria = new CategoriaFilha();

        // Variaveis
        $categorias = null;

//
//        $sql = "SELECT * FROM categoria cat
//                    LEFT JOIN categoria_filha c1
//                        ON cat.id_categoria = c1.id_pai
//                    WHERE id_categoria = " . $idPai;
//
//        // Busca as categorias filhas da pai
//        $categoria = $objModelCategoria
//            ->query($sql)
//            ->fetch(\PDO::FETCH_OBJ);
//
//        // Verifica se encontrou
//        if (!empty($categoria))
//        {
//            // Busca as categorias Filhas
//            $categoria->pai = $this->getCategoriaPai($categoria->id_filha);
//        }

        // Retorna as categorias
        return $categoria;
    } // End >> fun::getCategoriaFilha()




} // End >> Class::Categoria