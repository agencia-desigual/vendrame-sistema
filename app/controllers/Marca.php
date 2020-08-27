<?php
/**
 * Created by PhpStorm.
 * User: Igor
 * Date: 27/08/2020
 * Time: 11:54
 */

namespace Controller;


use Helper\Apoio;
use Sistema\Controller;

class Marca extends Controller
{
    // Objeto
    private $objModelMarca;
    private $objModelProduto;
    private $objHelperApoio;

    // Método construtor
    public function __construct()
    {
        // Chama o pai
        parent::__construct();

        // Instancia os objetos
        $this->objModelMarca = new \Model\Marca();
        $this->objModelProduto = new \Model\Produto();

        $this->objHelperApoio = new Apoio();

    } // End >> fun::__construct()


    /**
     * Método responsável por listar todas as
     * marcas cadastradas no sistema.
     * ---------------------------------------------
     * @url painel/marcas
     */
    public function listar()
    {
        // Variaveis
        $dados = null;
        $usuario = null;
        $marcas = null;

        // Busca o usuário logado
        $usuario = $this->objHelperApoio->seguranca();

        // Verifica se possui permissão
        if($usuario->nivel == "admin")
        {
            // Busca as marcas
            $marcas = $this->objModelMarca
                ->get()
                ->fetchAll(\PDO::FETCH_OBJ);

            // Percorre as marcas
            foreach ($marcas as $marca)
            {
                // Faz a somatoria de produto
                $marca->produtos = $this->objModelProduto
                    ->get(["id_marca" => $marca->id_marca])
                    ->rowCount();
            }

            // Array de listagem
            $dados = [
                "usuario" => $usuario,
                "marcas" => $marcas,
                "js" => [
                    "modulos" => ["Marca"]
                ]
            ];

            // View
            $this->view("painel/marca/listar", $dados);
        }

    } // End >> fun::listar()


    /**
     * Método responsável por adicionar uma nova
     * marca no sistema.
     * ---------------------------------------------
     * @url painel/marca/adicionar
     */
    public function adicionar()
    {
        // Variaveis
        $dados = null;
        $usuario = null;

        // Busca o usuário
        $usuario = $this->objHelperApoio->seguranca();

        // Verifica se possui permissão
        if($usuario->nivel == "admin")
        {
            // Array de retorno
            $dados = [
                "usuario" => $usuario,
                "js" => [
                    "modulos" => ["Marca"]
                ]
            ];

            // View
            $this->view("painel/marca/adicionar", $dados);
        }

    } // End >> fun::adicionar()


    /**
     * Método responsável por alterar os dados de uma
     * determinada marca ja cadastrada.
     * ----------------------------------------------
     * @param $id
     * ---------------------------------------------
     * @url painel/marca/alterar/{ID}
     */
    public function alterar($id)
    {
        // Variaveis
        $dados = null;
        $usuario = null;
        $marca = null;

        // Busca o usuário
        $usuario = $this->objHelperApoio->seguranca();

        // Verifica se possui permissão
        if($usuario->nivel == "admin")
        {
            // Busca marca a ser altera
            $marca = $this->objModelMarca
                ->get(["id_marca" => $id])
                ->fetch(\PDO::FETCH_OBJ);

            // Retorno
            $dados = [
                "usuario" => $usuario,
                "marca" => $marca,
                "js" => [
                    "modulos" => ["Marca"]
                ]
            ];

            // View
            $this->view("painel/marca/alterar", $dados);
        }

    } // End >> fun::alterar()

} // End >> Class::Marca