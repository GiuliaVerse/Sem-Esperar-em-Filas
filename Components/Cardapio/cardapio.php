<?php
session_start();

$nomeCardapio = $_POST['nomeCardapio'];
$categoria = $_POST['categoria'];      
$descricao = $_POST['descricao'];    
$restaurante_id =  $_SESSION['id'];


if (empty($nomeCardapio) || empty($categoria) || empty($descricao)) {
    echo json_encode(array("success" => false, "message" => "Todos os campos são obrigatórios."));
    exit;
}

$host = "localhost";         
$usuario = "root";           
$senha_banco = "";       
$banco = "projeto";          

// Estabelece uma nova conexão com o banco de dados MySQL
$conn = new mysqli($host, $usuario, $senha_banco, $banco);

// Verifica se a conexão com o banco de dados foi bem-sucedida
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

// Receber os detalhes do arquivo enviado
$image = $_FILES['image']['tmp_name'];
$imgContent = addslashes(file_get_contents($image));

// Query SQL para inserir os dados do cardapio na tabela "cardapio"
$sql = "INSERT INTO cardapio (nome_cardapio, categoria, descricao, imagem_cardapio, restaurante_codigo_restaurante) 
        VALUES ('$nomeCardapio', '$categoria', '$descricao', '$imgContent', '$restaurante_id')";

if ($conn->query($sql)) {
    echo json_encode(array("success" => true));
} else {
    echo json_encode(array("success" => false, "message" => "Erro: " . $conn->error));
}

$conn->close();
?>
