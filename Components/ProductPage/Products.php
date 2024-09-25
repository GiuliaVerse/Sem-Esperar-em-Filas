<?php
// Obtém os dados enviados pelo formulário através do método POST
$nomeProduto = $_POST['NomeProduto'];        // Nome do produto
$valorProduto = $_POST['ValorProduto'];      // Valor (preço) do produto
$ingredientes = $_POST['Ingredientes'];      // Ingredientes do produto

// Verifica se os campos obrigatórios estão preenchidos
if (empty($nomeProduto) || empty($valorProduto) || empty($ingredientes)) {
    // Retorna uma resposta JSON informando que todos os campos são obrigatórios
    echo json_encode(array("success" => false, "message" => "Todos os campos são obrigatórios."));
    exit; // Interrompe a execução do script
}

// Configurações do banco de dados
$host = "localhost";         // Endereço do servidor do banco de dados
$usuario = "root";           // Nome de usuário do banco de dados
$senha_banco = "";           // Senha do banco de dados (vazia no caso de localhost)
$banco = "projeto";          // Nome do banco de dados utilizado

// Estabelece uma nova conexão com o banco de dados MySQL
$conn = new mysqli($host, $usuario, $senha_banco, $banco);

// Verifica se a conexão com o banco de dados foi bem-sucedida
if ($conn->connect_error) {
    // Caso haja erro na conexão, interrompe o script e exibe a mensagem de erro
    die("Falha na conexão: " . $conn->connect_error);
}

// Query SQL para inserir os dados do produto na tabela "produtos"
// cardapio_codigo_cardapio está sendo definido como '1' para fins de exemplo
$sql = "INSERT INTO produtos (nome_produto, valor_produto, ingredientes, cardapio_codigo_cardapio) 
        VALUES ('$nomeProduto', '$valorProduto', '$ingredientes', 1)";

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
