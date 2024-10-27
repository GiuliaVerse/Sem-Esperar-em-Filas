<?php
session_start(); // Inicia uma sessão para armazenar os dados do usuário autenticado

// Obtém os dados enviados pelo formulário via método POST
$username = $_POST['usuario']; // Coleta o nome de usuário enviado pelo formulário
$password = $_POST['senha']; // Coleta a senha enviada pelo formulário

// Verifica se o usuário e a senha correspondem ao administrador
if ($username === 'admin' && $password === '1234') {
    // Se as credenciais estiverem corretas, define as variáveis de sessão
    $_SESSION['login'] = true; // Define que o usuário está autenticado
    $_SESSION['tipo'] = 'admin'; // Define o tipo de usuário como admin

    // Retorna uma resposta JSON indicando sucesso na autenticação
    echo json_encode(array("autenticado" => true, "tipo" => $_SESSION['tipo']));
} else {
    // Se as credenciais estiverem incorretas, retorna uma resposta JSON de falha
    echo json_encode(array("autenticado" => false, "erro" => "Usuário ou senha inválidos!"));
}
?>
