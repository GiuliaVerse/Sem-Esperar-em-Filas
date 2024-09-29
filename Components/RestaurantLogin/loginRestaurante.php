<?php
session_start(); // Inicia uma sessão para armazenar os dados do usuário autenticado

// Obtém os dados enviados pelo formulário via método POST
$username = $_POST['usuario']; // Coleta o nome de usuário enviado pelo formulário
$password = $_POST['senha']; // Coleta a senha enviada pelo formulário

// Configurações do banco de dados
$host = "localhost"; // Host onde o banco de dados está rodando (geralmente localhost)
$usuario = "root"; // Nome de usuário do banco de dados MySQL
$senha_banco = ""; // Senha do banco de dados MySQL (vazio se não houver senha)
$banco = "projeto"; // Nome do banco de dados MySQL

// Conexão com o banco de dados MySQL
$conn = new mysqli($host, $usuario, $senha_banco, $banco); 

// Verifica se a conexão foi bem-sucedida
if ($conn->connect_error) {
    // Em caso de falha, encerra o script e exibe uma mensagem de erro
    die("Falha na conexão: " . $conn->connect_error);
}

// Prepara uma consulta SQL para evitar SQL Injection
// Utiliza a consulta preparada para buscar o usuário com o login e senha fornecidos
$stmt = $conn->prepare("SELECT * FROM usuario WHERE login = ?");
$stmt->bind_param("s", $username); // Substitui os placeholders "?" pelos valores de login e senha fornecidos

// Executa a consulta
$stmt->execute();
$resultado = $stmt->get_result(); // Armazena o resultado da consulta

// Verifica se algum usuário foi encontrado
if ($resultado->num_rows > 0) {
    // Se o usuário foi encontrado, extrai seus dados
    $linha = $resultado->fetch_assoc(); // Busca a linha correspondente do banco de dados
    $hash_senha_armazenada = $linha['senha']; // Obtém o hash da senha armazenada no banco
    $id_cliente = $linha["cliente_codigo_cliente"]; // Obtém o código do cliente, se houver
    $id_restaurante = $linha['restaurante_codigo_restaurante']; // Obtém o código do restaurante, se houver

    // Verifica se a senha inserida corresponde ao hash armazenado
    if (password_verify($password, $hash_senha_armazenada)) {
        // Se a senha for válida, continua a verificar o tipo de usuário

        // Verifica se o usuário é um cliente
        if ($id_cliente != null) {
            // Se o usuário for um cliente, busca seus dados na tabela 'cliente'
            $sql = "SELECT * FROM cliente WHERE codigo_cliente = $id_cliente";
            if ($resultado = $conn->query($sql)) { // Executa a consulta para buscar os dados do cliente
                $linha = $resultado->fetch_assoc(); // Obtém os dados da linha correspondente
                $nome = $linha["nome"]; // Nome do cliente
                $email = $linha["email"]; // Email do cliente
                $telefone = $linha["telefone"]; // Telefone do cliente

                // Armazena os dados do cliente na sessão
                $_SESSION['tipo'] = 'cliente';
                $_SESSION['id'] = $id_cliente;
                $_SESSION['nome'] = $nome;
                $_SESSION['email'] = $email;
                $_SESSION['telefone'] = $telefone;
                $_SESSION['login'] = true; // Define que o usuário está autenticado
            }
        } else {
            // Caso contrário, o usuário é um restaurante, então busca os dados na tabela 'restaurante'
            $sql = "SELECT * FROM restaurante WHERE codigo_restaurante = $id_restaurante";
            if ($resultado = $conn->query($sql)) { // Executa a consulta para buscar os dados do restaurante
                $linha = $resultado->fetch_assoc(); // Obtém os dados da linha correspondente
                $nome = $linha["nome_fantasia"]; // Nome fantasia do restaurante
                $email = $linha["email"]; // Email do restaurante
                $telefone = $linha["telefone"]; // Telefone do restaurante

                // Armazena os dados do restaurante na sessão
                $_SESSION['tipo'] = 'restaurante';
                $_SESSION['id'] = $id_restaurante;
                $_SESSION['nome'] = $nome;
                $_SESSION['email'] = $email;
                $_SESSION['telefone'] = $telefone;
                $_SESSION['login'] = true; // Define que o usuário está autenticado
            }
        }
    }
    // Retorna uma resposta JSON indicando sucesso na autenticação
    echo json_encode(array("autenticado" => true, "tipo" => $_SESSION['tipo'], "id" => $_SESSION['id']));
} else {
    // Se nenhum usuário for encontrado, retorna uma resposta JSON de falha
    echo json_encode(array("autenticado" => false));
}

// Fecha a consulta preparada e a conexão com o banco de dados
$stmt->close(); // Fecha a instrução preparada
$conn->close(); // Fecha a conexão com o banco de dados
?>
