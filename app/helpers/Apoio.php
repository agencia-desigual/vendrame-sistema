<?php

/**
 * Classe responsável por conter métodos que auxiliam no desenvolvimento
 * de softwares.
 */

// NameSpace
namespace Helper;

// Inicia a classe
use Model\Empresa;
use Model\Imagem;
use Model\Marca;
use Model\Produto;

class Apoio
{

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
               $marca->logo = BASE_STORAGE . "marca/" . $marca->logo;
            }
            else
            {
                $marca->logo = BASE_URL.'assets/theme/site/img/padrao/marca.png';
            }

            // Retorna
            return $marca;
        }

    } // End >> fun::getImagem()


} // End >> Class::Apoio()