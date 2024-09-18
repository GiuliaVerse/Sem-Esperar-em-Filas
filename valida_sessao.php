<?php
// valida_sessao.php

session_start();

$url = dirname($_SERVER['SCRIPT_NAME']);                   // Obtém URL básica da aplicação Web
$url = substr($url,strrpos($url,"\\/")+1,strlen($url));    // Retira 1o. '/'
if (substr_count($url, '/') >= 1){                          
    $url = substr($url,strrpos($url,"\\/"),strlen($url));  // Retira 2o. '/', se ainda houver esse caracter
    $url = strstr($url, '/',true);
}

// Verifica se o usuário está autenticado
if (!isset($_SESSION['login']) || $_SESSION['login'] !== true) {
    // Redireciona para a página de login
    //header("Location: login.html");
    $url = "Location: /" . $url . "/index.php";             // Monta URL para redirecionamento
    header($url);                                           // Vai para a página de login / inicial
    exit();
}

// Controle de inatividade - 30 minutos
$tempo_limite = 1800;  // 30 (min) * 60 (seg) 

if (isset($_SESSION['tempo']) && (time() - $_SESSION['tempo']) > $tempo_limite) {
    // Destrói a sessão se o tempo de inatividade for maior que o limite
    session_unset();
    session_destroy();
    //header("Location: login.html");
    $url = "Location: /" . $url . "/index.php";             // Monta URL para redirecionamento
    header($url);                                           // Vai para a página de login / inicial
    exit();
}

$_SESSION['tempo'] = time();
