<?php
$id = $_POST["id"];

$mensagem = "";


$host = "localhost"; // Nome do servidor MySQL
$usuario = "root"; // Nome de usuário do MySQL
$senha_banco = ""; // Senha do MySQL (deixe vazio se não houver senha)
$banco = "ClienteServidor"; // Nome do banco de dados

// conexão com o banco
$conn = new mysqli(
    $host,
    $usuario,
    $senha_banco,
    $banco
);

// Verifica a conexão
if ($conn->connect_error) {
    die("Falha na conexão: " .
        $conn->connect_error);
}

// Excluir dados do Usuario
$sql = "DELETE FROM usuario 
        WHERE id = $id";

if ($conn->query($sql) === true) {
    echo json_encode(array("mensagem" => "ok"));
} else {
    echo json_encode(array("mensagem" => $conn->error));
}