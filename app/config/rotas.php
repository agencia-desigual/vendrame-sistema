<?php

// Erro 404
$Rotas->onError("404", "Site::error404");


/**
 *  ===========================================================
 *                          ROTAS DA API
 *  ===========================================================
 */


// Usuário
$Rotas->group("api-usuario","api/usuario","Api\Usuario");
$Rotas->onGroup("api-usuario","POST","login","login");
$Rotas->onGroup("api-usuario","GET","get","getAll");
$Rotas->onGroup("api-usuario","GET","get/{p}","get");
$Rotas->onGroup("api-usuario","POST","insert","insert");
$Rotas->onGroup("api-usuario","PUT","update/{p}","update");
$Rotas->onGroup("api-usuario","DELETE","delete/{p}","delete");


// Imagem
$Rotas->group("api-imagem","api/imagem","Api\Imagem");
$Rotas->onGroup("api-imagem","GET","get","getAll");
$Rotas->onGroup("api-imagem","GET","get/{p}","get");
$Rotas->onGroup("api-imagem","POST","insert/{p}","insert");
$Rotas->onGroup("api-imagem","PUT","principal/{p}","principal");
$Rotas->onGroup("api-imagem","DELETE","delete/{p}","delete");


// Marca
$Rotas->group("api-marca","api/marca","Api\Marca");
$Rotas->onGroup("api-marca","GET","get","getAll");
$Rotas->onGroup("api-marca","GET","get/{p}","get");
$Rotas->onGroup("api-marca","POST","insert","insert");
$Rotas->onGroup("api-marca","POST","update/{p}","update");
$Rotas->onGroup("api-marca","DELETE","delete/{p}","delete");


// Categorias
$Rotas->group("api-categoria","api/categoria","Api\Categoria");
$Rotas->onGroup("api-categoria","GET","get","getAll");
$Rotas->onGroup("api-categoria","GET","get/{p}","get");
$Rotas->onGroup("api-categoria","POST","insert","insert");
$Rotas->onGroup("api-categoria","POST","update/{p}","update");
$Rotas->onGroup("api-categoria","DELETE","delete/{p}","delete");


// Indices
$Rotas->group("api-indice","api/indice","Api\Indice");
$Rotas->onGroup("api-indice","POST","insert","insert");
$Rotas->onGroup("api-indice","POST","update/{p}","update");
$Rotas->onGroup("api-indice","DELETE","delete/{p}","delete");


// Tratamento
$Rotas->group("api-tratamento","api/tratamento","Api\Tratamento");
$Rotas->onGroup("api-tratamento","POST","insert","insert");
$Rotas->onGroup("api-tratamento","POST","update/{p}","update");
$Rotas->onGroup("api-tratamento","DELETE","delete/{p}","delete");


// Tipos
$Rotas->group("api-tipo","api/tipo","Api\Tipo");
$Rotas->onGroup("api-tipo","GET","get","getAll");
$Rotas->onGroup("api-tipo","GET","get/{p}","get");
$Rotas->onGroup("api-tipo","POST","insert","insert");
$Rotas->onGroup("api-tipo","POST","update/{p}","update");
$Rotas->onGroup("api-tipo","DELETE","delete/{p}","delete");


// Produto
$Rotas->group("api-produto","api/produto","Api\Produto");
$Rotas->onGroup("api-produto","GET","get","getAll");
$Rotas->onGroup("api-produto","GET","get/{p}","get");
$Rotas->onGroup("api-produto","POST","insert","insert");
$Rotas->onGroup("api-produto","POST","update/{p}","update");
$Rotas->onGroup("api-produto","DELETE","delete/{p}","delete");
$Rotas->onGroup("api-produto","POST","pesquisa/{p}","pesquisa");
$Rotas->onGroup("api-produto","POST","reajuste","reajuste");
$Rotas->onGroup("api-produto","POST","desconto","desconto");


// Ficha Técnica
$Rotas->group("api-ficha","api/ficha","Api\FichaTecnica");
$Rotas->onGroup("api-ficha","POST","insert/{p}","insert");
$Rotas->onGroup("api-ficha","PUT","update/{p}","update");
$Rotas->onGroup("api-ficha","DELETE","delete/{p}","delete");


// Atributo
$Rotas->group("api-atributo","api/atributo","Api\Atributo");
$Rotas->onGroup("api-atributo","POST","insert","insert");
$Rotas->onGroup("api-atributo","POST","update/{p}","update");
$Rotas->onGroup("api-atributo","DELETE","delete/{p}","delete");

$Rotas->onGroup("api-atributo","DELETE","produto/{p}","desvinculaProduto");
$Rotas->onGroup("api-atributo","POST","produto/{p}/{p}","vinculaProduto");


// Banner
$Rotas->group("api-banner","api/banner","Api\Banner");
$Rotas->onGroup("api-banner","POST","insert","insert");
$Rotas->onGroup("api-banner","DELETE","delete/{p}","delete");


/**
 *  ===========================================================
 *                      ROTAS DO SITE
 *  ===========================================================
 */


// -- Rotas sem grupo --- INDEX
$Rotas->on("GET","","Site::index");

// -- Rotas sem grupo --- INDEX
$Rotas->on("GET","produtos","Site::produtos");
$Rotas->on("GET","produtos/{p}","Site::produtos");
$Rotas->on("GET","produto-detalhes/{p}","Site::produtoDetalhes");

// -- Rotas sem grupo --- LOGIN
$Rotas->on("GET","login","Site::login");

// -- Rotas sem grupo --- SAIR
$Rotas->on("GET","sair","Site::sair");




/**
 *  ===========================================================
 *                      ROTAS DO PAINEL
 *  ===========================================================
 */

// -- Dashboard
$Rotas->on("GET","painel","Site::dashboard");

// -- Usuario
$Rotas->on("GET","painel/usuarios","Usuario::listar");
$Rotas->on("GET","painel/usuario/adicionar","Usuario::adicionar");
$Rotas->on("GET","painel/usuario/alterar/{p}","Usuario::alterar");

// -- Marca
$Rotas->on("GET","painel/marcas","Marca::listar");
$Rotas->on("GET","painel/marca/adicionar","Marca::adicionar");
$Rotas->on("GET","painel/marca/alterar/{p}","Marca::alterar");

// -- Categoria
$Rotas->on("GET","painel/categorias","Categoria::listar");
$Rotas->on("GET","painel/categoria/adicionar","Categoria::adicionar");
$Rotas->on("GET","painel/categoria/alterar/{p}","Categoria::alterar");

// -- Indices
$Rotas->on("GET","painel/indices","Indice::listar");
$Rotas->on("GET","painel/indice/adicionar","Indice::adicionar");
$Rotas->on("GET","painel/indice/alterar/{p}","Indice::alterar");

// -- Tratamento
$Rotas->on("GET","painel/tratamentos","Tratamento::listar");
$Rotas->on("GET","painel/tratamento/adicionar","Tratamento::adicionar");
$Rotas->on("GET","painel/tratamento/alterar/{p}","Tratamento::alterar");

// -- Tipo
$Rotas->on("GET","painel/tipos","Tipo::listar");
$Rotas->on("GET","painel/tipo/adicionar","Tipo::adicionar");
$Rotas->on("GET","painel/tipo/alterar/{p}","Tipo::alterar");

// -- Atributo
$Rotas->on("GET","painel/atributos","Atributo::listar");
$Rotas->on("GET","painel/atributo/adicionar","Atributo::adicionar");
$Rotas->on("GET","painel/atributo/alterar/{p}","Atributo::alterar");

// -- PRODUTO
$Rotas->on("GET","painel/produtos","Produto::listar");
$Rotas->on("GET","painel/produto/adicionar","Produto::adicionar");
$Rotas->on("GET","painel/produto/alterar/{p}/{p}","Produto::alterar");
$Rotas->on("GET","painel/produto/alterar/{p}","Produto::alterar");
$Rotas->on("GET","painel/reajuste/{p}","Produto::reajuste");

// -- BANNER
$Rotas->on("GET","painel/banners","Banner::listar");
$Rotas->on("GET","painel/banner/adicionar","Banner::adicionar");