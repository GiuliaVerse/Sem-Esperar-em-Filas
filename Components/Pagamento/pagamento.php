<?php
$data = json_decode(file_get_contents("php://input"), true);

/*
// Verifique se os dados foram recebidos e decodificados corretamente
if ($data) {
    // Exemplo: imprimir o conteúdo para verificação
    echo "<pre>";
    print_r($data);
    echo "</pre>";
}
*/
    echo json_encode(array("success" => TRUE));

/*
$nome = $_POST['nome'];
$cpf = $_POST['cpf'];
$email = $_POST['email'];
$telefone = $_POST['telefone'];
$login = $_POST['login'];
$senha = $_POST['senha'];

// Verifica se os campos estão vazios
if ($nome === "" || $cpf === "" || $email === "" || $telefone === "" || $login === "" || $senha === "") {
    // Se algum campo estiver vazio, retorna uma mensagem de erro em formato JSON
    echo json_encode(array("success" => false, "message" => "Todos os campos são obrigatórios."));
    exit; // Termina a execução do script
}

// Codifica a senha usando password_hash
$senha_codificada = password_hash($senha, PASSWORD_DEFAULT);
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

// Iniciar transação
$conn->begin_transaction();

try {

    // Insere o cliente no banco de dados
    // 1. Inserir o cliente
    $sqlCliente = "INSERT INTO cliente (nome, cpf, email, telefone, data_criacao)
                    VALUES (?, ?, ?, ?, CURRENT_DATE())";
    $stmtCliente = $conn->prepare($sqlCliente);
    $stmtCliente->bind_param("ssss", $nome, $cpf, $email, $telefone);
    $stmtCliente->execute();

    // 2. Obter o ID do cliente recém-inserido
    $cliente_id = $conn->insert_id;

    // 3. Inserir o usuário correspondente ao cliente
    $sqlUsuario = "INSERT INTO usuario (nome, login, senha, email, perfil_codigo_perfil, cliente_codigo_cliente)
                    VALUES (?, ?, ?, ?, 1, ?)";
    $stmtUsuario = $conn->prepare($sqlUsuario);
    $stmtUsuario->bind_param("ssssi", $nome, $login, $senha_codificada, $email, $cliente_id);
    $stmtUsuario->execute();

    // 4. Confirmar a transação
    $conn->commit();

    // Fechar os prepared statements
    $stmtCliente->close();
    $stmtUsuario->close();
    echo json_encode(array("success" => true));
} catch (Exception $e) {
    // Em caso de erro, reverter a transação
    $conn->rollback();
    echo json_encode(array("success" => false, "message" =>  $e->getMessage()));
}
$conn->close();
*/
?>