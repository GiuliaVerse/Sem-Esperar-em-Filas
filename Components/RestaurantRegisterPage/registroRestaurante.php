<?php
// Obtém os dados enviados do formulário via método POST
$razaoSocial = $_POST['restaurantName']; // Razão Social do restaurante
$nomeFantasia = $_POST['ownerName']; // Nome do proprietário
$email = $_POST['email']; // Email do restaurante ou proprietário
$cnpj = $_POST['cnpj']; // CNPJ do restaurante
$telefone = $_POST['phone']; // Telefone do restaurante
$instituicao = $_POST['institution']; // Nome da instituição
$login = $_POST['username']; // Nome de usuário para login
$senha = $_POST['password']; // Senha de login

// Verifica se todos os campos obrigatórios estão preenchidos
if (empty($razaoSocial) || empty($nomeFantasia) || empty($email) || empty($cnpj) || empty($telefone) || empty($instituicao) || empty($login) || empty($senha)) {
    // Se algum campo estiver vazio, retorna uma mensagem de erro em formato JSON
    echo json_encode(array("success" => false, "message" => "Todos os campos são obrigatórios."));
    exit; // Termina a execução do script
}

// Codifica a senha usando password_hash
$senha_codificada = password_hash($senha, PASSWORD_DEFAULT);

// Configurações de conexão com o banco de dados
$host = "localhost"; // Endereço do servidor de banco de dados
$usuario = "root"; // Nome de usuário do banco de dados
$senha_banco = ""; // Senha do banco de dados
$banco = "projeto"; // Nome do banco de dados

// Cria uma nova conexão com o banco de dados MySQL
$conn = new mysqli($host, $usuario, $senha_banco, $banco);

// Verifica se houve erro na conexão
if ($conn->connect_error) {
    // Se houver falha na conexão, encerra o script e exibe o erro
    die("Falha na conexão: " . $conn->connect_error);
}

// Iniciar transação
$conn->begin_transaction();

try {

    // Insere o cliente no banco de dados
    // 1. Inserir o cliente
    $sqlCliente = "INSERT INTO restaurante (razao_social, nome_fantasia, cnpj, email, telefone, instituicao_codigo_instituicao)
                    VALUES (?, ?, ?, ?, ?, ?)";
    $stmtCliente = $conn->prepare($sqlCliente);
    $stmtCliente->bind_param("sssssi", $razaoSocial, $nomeFantasia, $cnpj, $email, $telefone, $instituicao);
    $stmtCliente->execute();

    // 2. Obter o ID do cliente recém-inserido
    $restaurante_id = $conn->insert_id;

    // 3. Inserir o usuário correspondente ao cliente
    $sqlUsuario = "INSERT INTO usuario (nome, login, senha, email, perfil_codigo_perfil, restaurante_codigo_restaurante)
                    VALUES (?, ?, ?, ?, 1, ?)";
    $stmtUsuario = $conn->prepare($sqlUsuario);
    $stmtUsuario->bind_param("ssssi", $nomeFantasia, $login, $senha_codificada, $email, $restaurante_id);
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
?>