<?php

// Erro 404
$Rotas->onError("404", function (){
   echo "Erro - 404";
});

// -- Seta os grupos
//$Rotas->group("Site","api","Site");

// -- Rotas de Grupos
//$Rotas->onGroup("Site","GET","a","index");

// -- Rotas sem grupo --- INDEX
$Rotas->on("GET","","Site::index");

// -- Rotas sem grupo --- LOGIN
$Rotas->on("GET","login","Site::login");

// -- Rotas sem grupo --- SAIR
$Rotas->on("GET","sair","Site::sair");