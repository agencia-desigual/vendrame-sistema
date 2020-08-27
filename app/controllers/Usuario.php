<?php

// NameSpace
namespace Controller;

// Importação
use Helper\Apoio;
use Sistema\Controller;

// Inicia a classe
class Usuario extends Controller
{
    // Objetos
    private $objModelUsuario;
    private $objHelperApoio;

    // Método construtor
    public function __construct()
    {
        // Chama o pai
        parent::__construct();

        // Instancia os objetos
        $this->objModelUsuario = new \Model\Usuario();
        $this->objHelperApoio = new Apoio();

    } // End >> fun::__construct()



    /**
     * Método responsável por listar todos os usuários
     * cadastrados no sistema.
     * ------------------------------------------------
     * @url painel/usuarios
     */
    public function listar()
    {
        // Variaveis
        $dados = null;
        $usuario = null;
        $usuarios = null;

        // Recupera o usuário
        $usuario = $this->objHelperApoio->seguranca();

        // Verifica se possui permissão
        if($usuario->nivel == "admin")
        {
            // Busca todos os usuários do sistema
            $usuarios = $this->objModelUsuario
                ->get()
                ->fetchAll(\PDO::FETCH_OBJ);

            // Retorno
            $dados = [
                "usuario" => $usuario,
                "usuarios" => $usuarios,
                "js" => [
                    "modulos" => ["Usuario"]
                ]
            ];

            // View
            $this->view("painel/usuario/listar", $dados);
        }
        else
        {
            // Manda para a home
            header("Location: " . BASE_URL);
        } // Error >> Usuário sem permissão

    } // End >> fun::listar()


    /**
     * Método responsável por adicionar um novo usuário
     * no sistema.
     * ------------------------------------------------
     * @url painel/usuario/adicionar
     */
    public function adicionar()
    {
        // Variaveis
        $dados = null;
        $usuario = null;

        // Recupera o usuário
        $usuario = $this->objHelperApoio->seguranca();

        // Verifica se tem permissão
        if($usuario->nivel == "admin")
        {
            // Array de retorno
            $dados = [
                "usuario" => $usuario,
                "js" => [
                    "modulos" => ["Usuario"]
                ]
            ];

            // Retorno
            $this->view("painel/usuario/adicionar", $dados);
        }
        else
        {
            // Manda para a home
            header("Location: " . BASE_URL);
        } // Error >> Usuário sem permissão

    } // End >> fun::adicionar()


    /**
     * Método responsável por alterar as informações de
     * um determinado usuário já cadastrado.
     * -------------------------------------------------
     * @param $id [Id do usuário]
     * -------------------------------------------------
     * @url painel/usuario/alterar/{Id do usuário}
     */
    public function alterar($id)
    {
        // Variaveis
        $dados = null;
        $usuario = null;
        $user = null;

        // Busca o usuário logado
        $usuario = $this->objHelperApoio->seguranca();

        // Verifica se o usuário possui permissão
        if($usuario->nivel == "admin")
        {
            // Busca o usuário a ser alterado
            $user = $this->objModelUsuario
                ->get(["id_usuario" => $id])
                ->fetch(\PDO::FETCH_OBJ);

            // Array de retorno
            $dados = [
                "usuario" => $usuario,
                "user" => $user,
                "js" => [
                    "modulos" => ["Usuario"]
                ]
            ];

            // View
            $this->view("painel/usuario/alterar", $dados);
        }

    } // End >> fun::alterar()

} // End >> Class::Usuario