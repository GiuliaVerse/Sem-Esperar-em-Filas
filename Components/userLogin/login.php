<?php
session_start();

// Obtém os dados do formulário
$username = $_POST['usuario'];
$password = $_POST['senha'];

// Configurações do banco de dados
$host = "localhost"; // Nome do servidor MySQL
$usuario = "root"; // Nome de usuário do MySQL
$senha_banco = ""; // Senha do MySQL (deixe vazio se não houver senha)
$banco = "projeto"; // Nome do banco de dados

// Conexão com o banco de dados
$conn = new mysqli($host, $usuario, $senha_banco, $banco);

// Verifica a conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

// Prepara a consulta SQL para evitar SQL Injection (ataques com dados maliciosos)
$stmt = $conn->prepare("SELECT * FROM cliente WHERE login = ? AND senha = ?");
$stmt->bind_param("ss", $username, $password);

// Executa a consulta
$stmt->execute();
$resultado = $stmt->get_result();

// Verifica se encontrou algum resultado
if ($resultado->num_rows > 0) {
    // Obtém os dados do usuário
    $linha = $resultado->fetch_assoc();
    $id = $linha["codigo_cliente"];
    $nome = $linha["nome"];
    $email = $linha["email"];
    $telefone = $linha["telefone"];

    // Armazena os dados na sessão
    $_SESSION['id'] = $id;
    $_SESSION['nome'] = $nome;
    $_SESSION['email'] = $email;
    $_SESSION['telefone'] = $telefone;

    // Retorna uma resposta JSON de sucesso
    echo json_encode(array("autenticado" => true, "id" => $id));
} else {
    // Retorna uma resposta JSON de falha
    echo json_encode(array("autenticado" => false));
}

// Fecha a declaração e a conexão
$stmt->close();
$conn->close();
?>