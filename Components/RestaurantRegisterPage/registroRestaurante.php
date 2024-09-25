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

// Monta a query para chamar a procedure armazenada no banco de dados que insere o restaurante e o usuário
$sql = "CALL inserir_restaurante_usuario('$razaoSocial', '$nomeFantasia', '$cnpj', '$email', '$telefone', '$instituicao', '$login', '$senha')";

// Executa a query e verifica se foi bem-sucedida
if ($conn->query($sql)) {
    // Se a inserção for bem-sucedida, retorna uma resposta de sucesso em formato JSON
    echo json_encode(array("success" => true));
} else {
    // Se houver erro, retorna uma mensagem de erro em formato JSON com o detalhe do erro (echo json_encode=echo é usada para imprimir essa string JSON no output, que será enviada como resposta HTTP ao cliente. )
    echo json_encode(array("success" => false, "message" => "Erro: " . $conn->error));
}

// Fecha a conexão com o banco de dados
$conn->close();
?>
