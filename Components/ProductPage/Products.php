<?php
// Obtém os dados enviados pelo formulário através do método POST
$nomeProduto = $_POST['NomeProduto'];
$valorProduto = str_replace(',', '.', $_POST['ValorProduto']);     
$ingredientes = $_POST['Ingredientes'];      
$cardapio = $_POST['Cardapio'];      

// Verifica se os campos obrigatórios estão preenchidos
if (empty($nomeProduto) || empty($valorProduto) || empty($ingredientes) || empty($cardapio)) {
    // Retorna uma resposta JSON informando que todos os campos são obrigatórios
    echo json_encode(array("success" => false, "message" => "Todos os campos são obrigatórios."));
    exit; // Interrompe a execução do script
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

// Query SQL para inserir os dados do produto na tabela "produtos"
$sql = "INSERT INTO produtos (nome_produto, valor_produto, ingredientes, cardapio_codigo_cardapio) 
        VALUES ('$nomeProduto', '$valorProduto', '$ingredientes', '$cardapio')";

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
