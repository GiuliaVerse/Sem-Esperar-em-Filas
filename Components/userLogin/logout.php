<?php
// logout.php - Script para fazer o logout do usuário
session_start(); // Inicia a sessão para garantir que podemos destruí-la

// Obtém a URL básica da aplicação Web
$url = dirname($_SERVER['SCRIPT_NAME']); // Pega o caminho do script atual (caminho da URL do arquivo atual)
$url = substr($url, strrpos($url, "\\/") + 1, strlen($url)); // Remove o primeiro '/' encontrado na URL

// Verifica se ainda há mais de um '/' na URL
if (substr_count($url, '/') >= 1) { 
    // Remove o segundo '/' se ainda existir na URL
    $url = substr($url, strrpos($url, "\\/"), strlen($url)); 
    $url = strstr($url, '/', true); // Pega a parte da URL até o primeiro '/'
}

// Destroi a sessão do usuário para fazer o logout
session_destroy(); // Encerra a sessão, removendo todos os dados armazenados, efetivamente "deslogando" o usuário

// Monta a URL para redirecionar o usuário para a página inicial ou de login
$url = "Location: /" . $url . "/index.php"; // Cria a URL para redirecionamento para a página inicial

header($url); // Redireciona o usuário para a URL montada
exit(); // Interrompe a execução do script, garantindo que nada mais será executado após o redirecionamento
?>
