<?php
header("Content-Type: application/json");

$tipoPagina = 'restaurante';
require('../../valida_sessao.php');
$idRestaurante = $_SESSION['id'];

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
$sql = "SELECT codigo_cardapio, nome_cardapio FROM CARDAPIO WHERE restaurante_codigo_restaurante = $idRestaurante";

// Executa a query SQL e verifica se foi bem-sucedida
$cardapios = [];
if ($resultado = $conn->query($sql)) { // Executa a consulta
    while(  $linha = $resultado->fetch_assoc() ) {
        $cardapios[] = $linha; // Nome do cliente
    }
    echo json_encode($cardapios);
} else {
    // Se houver erro na execução da query, retorna uma mensagem de erro em JSON
    echo json_encode(array("success" => false, "message" => "Erro: " . $conn->error));
}

// Fecha a conexão com o banco de dados
$conn->close();
?>
