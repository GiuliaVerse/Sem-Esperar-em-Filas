<?php
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
$mysqli->begin_transaction();

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
    $hashedSenha = password_hash($senha, PASSWORD_DEFAULT); // Hash da senha
    $stmtUsuario->bind_param("ssssi", $nome, $username, $hashedSenha, $email, $cliente_id);
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
    echo json_encode(array("success" => false, "message" =>  $conn->error));
}

/*
//$sql = "CALL inserir_cliente_usuario('$nome', '$cpf', '$email', '$telefone', '$login', '$senha_codificada')";

// Executando a consulta SQL
//if ($conn->query($sql)) {
//    echo json_encode(array("success" => true));
//} else {
//    echo json_encode(array("success" => false, "message" =>  $conn->error));
//}
*/
// Fecha a conexão
$conn->close();
?>