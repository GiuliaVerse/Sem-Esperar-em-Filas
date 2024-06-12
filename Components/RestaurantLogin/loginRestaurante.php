<?php
session_start();

// Obtém os dados do formulário
$username = $_POST['usuario'];
$password = $_POST['senha'];

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

// Escapando caracteres especiais para prevenir SQL Injection
$username = $conn->real_escape_string($username);
$password = $conn->real_escape_string($password);

// Consulta SQL para verificar o login e senha
$sql = "SELECT * FROM restaurante WHERE login = '$username' AND senha = '$password'";

$resultado = $conn->query($sql);

// Verifica se encontrou algum resultado
if ($resultado->num_rows > 0) {
    // Obtém os dados do restaurante
    $linha = $resultado->fetch_assoc();
    $id = $linha["codigo_restaurante"];
    $razaoSocial = $linha["razao_social"];
    $nomeFantasia = $linha["nome_fantasia"];
    $email = $linha["email"];
    $telefone = $linha["telefone"];

    // Armazena os dados na sessão
    $_SESSION['id'] = $id;
    $_SESSION['razaoSocial'] = $razaoSocial;
    $_SESSION['nomeFantasia'] = $nomeFantasia;
    $_SESSION['email'] = $email;
    $_SESSION['telefone'] = $telefone;

    // Retorna uma resposta JSON de sucesso
    echo json_encode(array("autenticado" => true));
} else {
    // Retorna uma resposta JSON de falha
    echo json_encode(array("autenticado" => false, "mensagem" => "Usuário ou senha incorretos."));
}

// Fecha a conexão
$conn->close();
?>