<?php
session_start(); // Inicia uma sessão para armazenar os dados do usuário autenticado

// Obtém os dados do formulário (usuário e senha) enviados via POST
$username = $_POST['usuario'];
$password = $_POST['senha'];

// Configurações do banco de dados
$host = "localhost"; // Nome do servidor MySQL
$usuario = "root"; // Nome de usuário do MySQL
$senha_banco = ""; // Senha do MySQL (vazio neste caso)
$banco = "projeto"; // Nome do banco de dados a ser acessado

// Conexão com o banco de dados
$conn = new mysqli($host, $usuario, $senha_banco, $banco);

// Verifica a conexão com o banco de dados
if ($conn->connect_error) {
    // Se houver erro de conexão, exibe uma mensagem e interrompe o script
    die("Falha na conexão: " . $conn->connect_error);
}

// Prepara a consulta SQL para evitar SQL Injection (proteger contra dados maliciosos)
$stmt = $conn->prepare("SELECT * FROM usuario WHERE login = ?");
$stmt->bind_param("s", $username); // Substitui as interrogações (?) pelos valores do login e senha

// Executa a consulta SQL
$stmt->execute();
$resultado = $stmt->get_result(); // Obtém o resultado da consulta

// Verifica se foi encontrado algum resultado
if ($resultado->num_rows > 0) {
    // Obtém os dados da linha correspondente (primeiro resultado)
    $linha = $resultado->fetch_assoc();
    $hash_senha_armazenada = $linha['senha']; // Obtém o hash da senha armazenada no banco
    $id_cliente = $linha["cliente_codigo_cliente"]; // Obtém o código do cliente
    $id_restaurante = $linha['restaurante_codigo_restaurante']; // Obtém o código do restaurante

    // Verifica se a senha inserida corresponde ao hash armazenado
    if (password_verify($password, $hash_senha_armazenada)) {
        // Se a senha for válida, continua a verificar o tipo de usuário

        // Verifica se o usuário é um cliente (se a coluna cliente_codigo_cliente não for nula)
        if( $id_cliente != null ) {
            // Prepara uma nova consulta para obter os dados do cliente
            $sql = "SELECT * FROM cliente WHERE codigo_cliente = $id_cliente";
            if ($resultado = $conn->query($sql)) { // Executa a consulta
                $linha = $resultado->fetch_assoc(); // Obtém os dados do cliente
                $nome = $linha["nome"]; // Nome do cliente
                $email = $linha["email"]; // Email do cliente
                $telefone = $linha["telefone"]; // Telefone do cliente

                // Armazena os dados do cliente na sessão
                $_SESSION['tipo'] = 'cliente';
                $_SESSION['id'] = $id_cliente;
                $_SESSION['nome'] = $nome;
                $_SESSION['email'] = $email;
                $_SESSION['telefone'] = $telefone;
                $_SESSION['login'] = true; // Marca que o usuário está logado no site
            }
        } else {
            // Se o usuário não é um cliente, verifica se ele é um restaurante
            $sql = "SELECT * FROM restaurante WHERE codigo_restaurante = $id_restaurante";
            if ($resultado = $conn->query($sql)) { // Executa a consulta
                $linha = $resultado->fetch_assoc(); // Obtém os dados do restaurante
                $nome = $linha["nome_fantasia"]; // Nome fantasia do restaurante
                $email = $linha["email"]; // Email do restaurante
                $telefone = $linha["telefone"]; // Telefone do restaurante

                // Armazena os dados do restaurante na sessão
                $_SESSION['tipo'] = 'restaurante';
                $_SESSION['id'] = $id_restaurante;
                $_SESSION['nome'] = $nome;
                $_SESSION['email'] = $email;
                $_SESSION['telefone'] = $telefone;
                $_SESSION['login'] = true; // Marca que o usuário está logado no site 
            }
        }
    }
    // Retorna uma resposta JSON indicando sucesso na autenticação
    echo json_encode(array("autenticado" => true, "tipo" => $_SESSION['tipo'], "id" => $_SESSION['id']));
} else {
    // Se nenhum resultado foi encontrado (usuário não autenticado), retorna uma resposta JSON de falha
    echo json_encode(array("autenticado" => false));
}

// Fecha a declaração preparada e a conexão com o banco de dados
$stmt->close();
$conn->close();
?>
