<?php
// Obtém os dados do formulário
$razaoSocial = $_POST['razaoSocial'];
$nomeFantasia = $_POST['nomeFantasia'];
$email = $_POST['email'];
$cnpj = $_POST['cnpj'];
$telefone = $_POST['telefone'];
$instituicao = $_POST['instituicao'];
$login = $_POST['usuario'];
$senha = $_POST['senha'];

// Verifica se todos os campos estão preenchidos
if (empty($razaoSocial) || empty($nomeFantasia) || empty($email) || empty($cnpj) || empty($telefone) || empty($instituicao) || empty($login) || empty($senha)) {
    echo json_encode(array("success" => false, "message" => "Todos os campos são obrigatórios."));
    exit;
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

$sql = "CALL inserir_restaurante_usuario('$razaoSocial', '$nomeFantasia', '$cnpj', '$email', '$telefone', '$instituicao', '$login', '$senha')";

if ($conn->query($sql)) {
    echo json_encode(array("success" => true));
} else {
    echo json_encode(array("success" => false, "message" => "Erro: " . $conn->error));
}

// Fecha a conexão
$conn->close();
?>
