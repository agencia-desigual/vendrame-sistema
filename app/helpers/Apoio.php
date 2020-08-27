<?php

/**
 * Classe responsável por conter métodos que auxiliam no desenvolvimento
 * de softwares.
 */

// NameSpace
namespace Helper;

// Inicia a classe
use Model\Categoria;
use Model\Empresa;
use Model\Imagem;
use Model\Marca;
use Model\Produto;

class Apoio
{

    /**
     * Método responsável por validar possui um usuário logado com session
     * salva. Caso não haja envia para a tela de login, caso haja porem o
     * token expirou, envia para a tela de logof.
     * ---------------------------------------------------------------------
     * @return mixed
     */
    public function seguranca()
    {
        // Recupera os dados da sessao
        $user = $_SESSION["usuario"];
        $token = $_SESSION["token"];


        // Verifica se possui algo
        if(!empty($user->id_usuario))
        {
            // Verifica se o token está valido
            if($token->data_expira > date("Y-m-d H:i:s"))
            {
                // Add o token ao usuario
                $user->token = $token;

                // Retorna o usuario
                return $user;
            }
            else
            {
                // Deleta a session
                session_destroy();

                // Redireciona para a tela de logof
                header( "Location: " . BASE_URL . "login");
            } // Error - Token Expirado
        }
        else
        {
            // Redireciona para a tela de login
            header( "Location: " . BASE_URL . "login");
        } // Error - usuario não logado

    } // End >> fun::seguranca()


    /**
     * Método responsável por formatar um numero na casa do milhar, deixando
     * em siglas K,M,B,T,Q
     * ---------------------------------------------------------------------
     * @param null|int $numero
     * @return string
     */
    public function formatNumero($numero = null)
    {
        // Variaveis
        $cont = 0;
        $array  = ["","K","M","B","T","Q"];

        // Divide o numero por mil
        while ($numero >= 1000)
        {
            $numero = $numero / 1000;
            $cont++;
        }


        // Verifica se o numero não é inteiro
        if(is_int($numero) == false)
        {
            // Deixa com duas casas decimais
            $numero = number_format($numero,2,".");
        }

        // Retorna o numero com a letra
        return $numero . $array[$cont];
    }



    /**
     * Método responsável por configurar a imagem padrão
     * de um produto ou de uma marca.
     * --------------------------------------------------------------
     * @param $id [Id do produto ou marca]
     * @param $tipo [marca ou produto]
     * @return array|string
     */
    public function getImagem($id, $tipo = "produto")
    {
        // Verifica se é produto ou marca
        if($tipo == "produto")
        {
            // Objeto
            $objModelProduto = new Produto();
            $objModelImagem = new Imagem();

            // Busca o produto selecionado
            $produto = $objModelProduto
                ->get(["id_produto" => $id])
                ->fetch(\PDO::FETCH_OBJ);

            // Busca as imagens do produto
            $imagens = $objModelImagem
                ->get(["id_produto" => $id])
                ->fetchAll(\PDO::FETCH_OBJ);

            // Verifica se não encontrou
            if(empty($imagens))
            {
                // Imagem padrão
                $imagens = BASE_URL . 'assets/theme/site/img/padrao/produto.png';
            }

            // Retorna
            return $imagens;
        }
        elseif ($tipo == "marca")
        {
            // Objeto
            $objModelMarca = new Marca();

            // Busca a empresa
            $marca = $objModelMarca
                ->get(["id_marca" => $id])
                ->fetch(\PDO::FETCH_OBJ);

            // Verifica se tem logo
            if(!empty($marca->logo))
            {
               $imagem = BASE_STORAGE . "marca/" . $marca->logo;
            }
            else
            {
                $imagem = BASE_URL.'assets/theme/site/img/padrao/marca.png';
            }

            // Retorna
            return $imagem;
        }

    } // End >> fun::getImagem()



    /**
     * Método responsável por buscas todas as categorias
     * do catalogos e também busca suas filhas.
     * --------------------------------------------------------------
     * @return array|string
     */
    public function getCategorias()
    {
        // Varieveis
        $retorno = null;

        // Busca as categorias
        $retorno = $this->getCategoriaFilha(null);

        // Retorna as categorias
        return $retorno;

    } // End >> fun::getCategorias()

    private function getCategoriaFilha($idPai)
    {
        // Objetos
        $objModelCategoria = new Categoria();

        // Variaveis
        $categorias = null;

        // Verifica se informou o pai
        if(!empty($idPai))
        {
            // Busca as categorias filhas da pai
            $categorias = $objModelCategoria
                ->get(["id_categoria_pai" => $idPai])
                ->fetchAll(\PDO::FETCH_OBJ);
        }
        else
        {
            // Busca todas as categorias PAI
            $categorias = $objModelCategoria
                ->get(["id_categoria_pai" => "IS NULL"])
                ->fetchAll(\PDO::FETCH_OBJ);
        }


        // Verifica se encontrou
        if (!empty($categorias))
        {
            // Percorre as categorias pai
            foreach ($categorias as $cat)
            {
                // Busca as categorias Filhas
                $cat->filhas = $this->getCategoriaFilha($cat->id_categoria);
            }
        }

        // Retorna as categorias
        return $categorias;
    }




} // End >> Class::Apoio()