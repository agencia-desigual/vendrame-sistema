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


} // End >> Class::Usuario