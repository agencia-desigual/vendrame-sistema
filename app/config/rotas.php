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