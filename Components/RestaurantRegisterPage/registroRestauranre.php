<?php
// Obtém os dados do formulário
$razaoSocial = $_POST['restaurantName'];
$nomeFantasia = $_POST['ownerName'];
$email = $_POST['email'];
$cnpj = $_POST['cnpj'];
$telefone = $_POST['phone'];
$instituicao = $_POST['institution'];
$login = $_POST['username'];
$senha = $_POST['password'];

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

// Insere o restaurante no banco de dados
$sql = "INSERT INTO restaurante (razao_social, nome_fantasia, cnpj, email, telefone, instituicao_codigo_instituicao) 
        VALUES ('$razaoSocial', '$nomeFantasia', '$cnpj', '$email', '$telefone', '$instituicao')";

if ($conn->query($sql) === TRUE) {
    echo json_encode(array("success" => true));
} else {
    echo json_encode(array("success" => false, "message" => "Erro: " . $conn->error));
}

// Fecha a conexão
$conn->close();
?>
