<?php
session_start();

// Obtém os dados enviados pelo formulário através do método POST
$nomeCardapio = $_POST['nomeCardapio'];
$categoria = $_POST['categoria'];      
$descricao = $_POST['descricao'];    
$restaurante_id =  $_SESSION['id'];


// Verifica se os campos obrigatórios estão preenchidos
if (empty($nomeCardapio) || empty($categoria) || empty($descricao)) {
    echo json_encode(array("success" => false, "message" => "Todos os campos são obrigatórios."));
    exit;
}

// Configurações do banco de dados
$host = "localhost";         
$usuario = "root";           
$senha_banco = "";       
$banco = "projeto";          

// Estabelece uma nova conexão com o banco de dados MySQL
$conn = new mysqli($host, $usuario, $senha_banco, $banco);

// Verifica se a conexão com o banco de dados foi bem-sucedida
if ($conn->connect_error) {
    // Caso haja erro na conexão, interrompe o script e exibe a mensagem de erro
    die("Falha na conexão: " . $conn->connect_error);
}

// Receber os detalhes do arquivo enviado
$image = $_FILES['image']['tmp_name'];
$imgContent = addslashes(file_get_contents($image)); // Converte a imagem para string

// Query SQL para inserir os dados do cardapio na tabela "cardapio"
$sql = "INSERT INTO cardapio (nome_cardapio, categoria, descricao, imagem_cardapio, restaurante_codigo_restaurante) 
        VALUES ('$nomeCardapio', '$categoria', '$descricao', '$imgContent', '$restaurante_id')";

// Executa a query SQL e verifica se foi bem-sucedida
if ($conn->query($sql)) {
    // Se a query foi executada com sucesso, retorna uma resposta JSON com sucesso
    echo json_encode(array("success" => true));
} else {
    // Se houver erro na execução da query, retorna uma mensagem de erro em JSON
    echo json_encode(array("success" => false, "message" => "Erro: " . $conn->error));
}

// Fecha a conexão com o banco de dados
$conn->close();
?>
