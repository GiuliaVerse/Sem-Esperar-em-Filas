<?php
// Obtém os dados do formulário
$nomeProduto = $_POST['NomeProduto'];
$valorProduto = $_POST['ValorProduto'];
$ingredientes = $_POST['Ingredientes'];

// Verifica se todos os campos estão preenchidos
if (empty($nomeProduto) || empty($valorProduto) || empty($ingredientes)) {
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

$sql = "INSERT INTO produtos (nome_produto, valor_produto, ingredientes, cardapio_codigo_cardapio) 
        VALUES ('$nomeProduto', '$valorProduto', '$ingredientes', 1)";

if ($conn->query($sql)) {
    echo json_encode(array("success" => true));
} else {
    echo json_encode(array("success" => false, "message" => "Erro: " . $conn->error));
}

// Fecha a conexão
$conn->close();
?>