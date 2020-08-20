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
$Rotas->onGroup("api-usuario","GET","{p}","get");
$Rotas->onGroup("api-usuario","GET","","getAll");
$Rotas->onGroup("api-usuario","POST","","insert");
$Rotas->onGroup("api-usuario","PUT","{p}","update");
$Rotas->onGroup("api-usuario","DELETE","{p}","update");


// Imagem
$Rotas->group("api-imagem","api/imagem","Api\Imagem");
$Rotas->onGroup("api-imagem","GET","get","getAll");
$Rotas->onGroup("api-imagem","GET","get/{p}","get");
$Rotas->onGroup("api-imagem","POST","insert/{p}","insert");
$Rotas->onGroup("api-imagem","PUT","principal/{p}","principal");
$Rotas->onGroup("api-imagem","DELETE","delete/{p}","delete");