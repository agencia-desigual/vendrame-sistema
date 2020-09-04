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
use Model\Tipo;
use Model\View\CategoriaFilha;

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
                ->get(["id_produto" => $id],"principal DESC")
                ->fetchAll(\PDO::FETCH_OBJ);

            // Verifica se não encontrou
            if(empty($imagens))
            {
                // Imagem padrão
                $imagens = BASE_URL . 'assets/theme/site/img/padrao/produto.png';
            }
            else
            {
                foreach ($imagens as $imagem)
                {
                    $imagem->imagem = BASE_STORAGE . 'produto/'. $produto->id_produto . '/' . $imagem->imagem;
                }
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
     * Método responsável por buscas no banco de dados e retornas
     * as categorias mãe e seus filhos
     * -------------------------------------------------------------
     * @return array
     */
    public function getCategorias($idMarca = null, $idCat = null)
    {
        // Instancia o objeto
        $objModelCategoria = new Categoria();

        $where = ["id_categoria_pai" => "IS NULL"];

        if (!empty($idMarca))
        {
            $where = ["id_marca" => $idMarca, "id_categoria_pai" => "IS NULL"];
        }

        if (!empty($idCat))
        {
            $where = ["id_categoria" => $idCat];
        }

        // Busca as categorias pai
        $categorias = $objModelCategoria
            ->get($where, "nome ASC")
            ->fetchAll(\PDO::FETCH_OBJ);

        // Percorre as categorias encontradas
        foreach ($categorias as $cat)
        {
            // Busca os filhos
            $catFilho = $objModelCategoria
                ->get(["id_categoria_pai" => $cat->id_categoria])
                ->fetchAll(\PDO::FETCH_OBJ);

            // Verifica se encontrou algo
            if(!empty($catFilho))
            {
                // Percorre as categorias filho
                foreach ($catFilho as $filho)
                {
                    // Salva a imagem
                    $filho->img = $this->getImagem($filho->id_categoria, "categoria");
                }

                // Adiciona na categoria
                $cat->filhos = $catFilho;
            }

            // Busca a imagem da categoria
            $cat->img = $this->getImagem($cat->id_categoria, "categoria");
        }

        // retorna as categorias
        return $categorias;

    } // End >> fun::getCategorias()




    /**
     * Método responsável por buscas no banco de dados e retornas
     * as categorias mãe e seus filhos para o painel admin
     * -------------------------------------------------------------
     * @return array
     */
    public function getCategoriasLista($id = null, $idMarca = null)
    {

        // Instancia o objeto
        $objModelCategoria = new Categoria();

        // Variaveis
        $where = null;
        $categorias = null;

        // Verifica se informou id
        if(!empty($id))
        {
            // Add o where
            $where["id_categoria"] = $id;
        }

        // Verifica se informou id
        if(!empty($idMarca))
        {
            // Add o where
            $where["id_marca"] = $idMarca;
        }

        // Buscando todas as CATEGORIAS
        $categorias = $objModelCategoria
            ->get($where)
            ->fetchAll(\PDO::FETCH_OBJ);

        // Percorre as CATEGORIAS
        foreach ($categorias as $categoria)
        {
            // Verificando se possui categoria pai
            if($categoria->id_categoria_pai != null)
            {
                // Add ao objeto
                $categoria->sub = $categoria->nome;
                $categoria->sub = $this->getCategoriaPai($categoria);
            }
        }

        // Retrona a lista de categorias
        return $categorias;

    } // End >> fun::getCategoriasLista()


    /**
     * Método responsável por buscas no banco de dados e retornas
     * as tipos mãe e seus filhos para o painel admin
     * -------------------------------------------------------------
     * @return array
     */
    public function getTiposLista($id = null, $idMarca = null)
    {
        // Instancia o objeto
        $objModelTipo = new Tipo();

        // Variaveis
        $where = null;
        $tipos = null;

        // Verifica se informou id
        if(!empty($id))
        {
            // Add o where
            $where["id_tipo"] = $id;
        }

        // Verifica se informou id
        if(!empty($idMarca))
        {
            // Add o where
            $where["id_marca"] = $idMarca;
        }

        // Buscando todas as CATEGORIAS
        $tipos = $objModelTipo
            ->get($where)
            ->fetchAll(\PDO::FETCH_OBJ);

        // Percorre as CATEGORIAS
        foreach ($tipos as $tipo)
        {
            // Verificando se possui categoria pai
            if($tipo->id_tipo_pai != null)
            {
                // Add ao objeto
                $tipo->sub = $tipo->nome;
                $tipo->sub = $this->getTipoPai($tipo);
            }
        }

        // Retrona a lista de categorias
        return $tipos;

    } // End >> fun::getTiposLista()


    /* ===========================================
     *               MÉTODOS PRIVADOS
     * ===========================================
     */


    /**
     * Método recursivo para listar em ordem as ligações
     * das categorias pais.
     * ----------------------------------------------------
     * @param int|null $obj
     * @return string|null
     */
    private function getCategoriaPai($obj)
    {
        // Instancia o objeto
        $objModelCategoria = new Categoria();
        $retorno = null;

        // Busca a categoria pai
        $categoria = $objModelCategoria
            ->get(["id_categoria" => $obj->id_categoria_pai])
            ->fetch(\PDO::FETCH_OBJ);

        // Monta o texto do sub
        $retorno =  $categoria->nome . " > " . $obj->sub;

        // Verifica se possui pai
        if(!empty($categoria->id_categoria_pai))
        {
            // Monta o sub
            $categoria->sub = $retorno;

            // Busca o pai do pai
            $retorno = $this->getCategoriaPai($categoria);
        }

        // Retorna o texto
        return $retorno;
    } // End >> fun::getCategoriaPai()


    /**
     * Método recursivo para listar em ordem as ligações
     * das categorias pais.
     * ----------------------------------------------------
     * @param int|null $obj
     * @return string|null
     */
    private function getTipoPai($obj)
    {
        // Instancia o objeto
        $objModelTipo = new Tipo();
        $retorno = null;

        // Busca a categoria pai
        $tipo = $objModelTipo
            ->get(["id_tipo" => $obj->id_tipo_pai])
            ->fetch(\PDO::FETCH_OBJ);

        // Monta o texto do sub
        $retorno =  $tipo->nome . " > " . $obj->sub;

        // Verifica se possui pai
        if(!empty($tipo->id_tipo_pai))
        {
            // Monta o sub
            $tipo->sub = $retorno;

            // Busca o pai do pai
            $retorno = $this->getTipoPai($tipo);
        }

        // Retorna o texto
        return $retorno;
    } // End >> fun::getTipoPai()

} // End >> Class::Apoio()