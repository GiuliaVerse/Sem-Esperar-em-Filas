<?php
$nome = $_POST['nome'];
$cpf = $_POST['cpf'];
$email = $_POST['email'];
$telefone = $_POST['telefone'];
$login = $_POST['login'];
$senha = $_POST['senha'];

// Verifica se os campos estão vazios
if ($nome === "" || $cpf === "" || $email === "" || $telefone === "" || $login === "" || $senha === "") {
    // Se algum campo estiver vazio, retorna uma mensagem de erro em formato JSON
    echo json_encode(array("success" => false, "message" => "Todos os campos são obrigatórios."));
    exit; // Termina a execução do script

}

// Configurações do banco de dados
$host = "localhost";
$usuario = "root";
$senha_banco = "";
$banco = "projeto";

// Conexão com o banco de dados
$conn = new mysqli($host, $usuario, $senha_banco, $banco);

// Verifica a conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

// Insere o cliente no banco de dados
$sql = "CALL inserir_cliente_usuario('$nome', '$cpf', '$email', '$telefone', '$login', '$senha')";

// Executando a consulta SQL
if ($conn->query($sql)) {
    echo json_encode(array("success" => true));
} else {
    echo json_encode(array("success" => false, "message" =>  $conn->error));
}

// Fecha a conexão
$conn->close();
?>