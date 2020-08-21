<?php

// Erro 404
$Rotas->onError("404", "Site\Principal::error404");


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
$Rotas->onGroup("api-usuario","POST","insert/{p}","insert");
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
$Rotas->onGroup("api-marca","POST","insert/{p}","insert");
$Rotas->onGroup("api-marca","PUT","update/{p}","update");
$Rotas->onGroup("api-marca","DELETE","delete/{p}","delete");


/**
 *  ===========================================================
 *                      ROTAS DO SITE
 *  ===========================================================
 */


// -- Rotas sem grupo --- INDEX
$Rotas->on("GET","","Site::index");

// -- Rotas sem grupo --- LOGIN
$Rotas->on("GET","login","Site::login");

// -- Rotas sem grupo --- SAIR
$Rotas->on("GET","sair","Site::sair");
