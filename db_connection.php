<?php
// Configurações do banco de dados
$host = "localhost"; // Nome do servidor MySQL
$usuario = "root"; // Nome de usuário do MySQL
$senha_banco = ""; // Senha do MySQL
$banco = "projeto"; // Nome do banco de dados a ser acessado

// Conexão com o banco de dados
$conn = new mysqli($host, $usuario, $senha_banco, $banco);

// Verifica a conexão com o banco de dados
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

return $conn;
?>