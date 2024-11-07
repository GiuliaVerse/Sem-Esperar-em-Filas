<?php
session_start();

$username = $_POST['usuario'];
$password = $_POST['senha'];

if ($username === 'admin' && $password === '1234') {
    // Se as credenciais estiverem corretas, define as variáveis de sessão
    $_SESSION['login'] = true;
    $_SESSION['tipo'] = 'admin';

    // Retorna uma resposta JSON indicando sucesso na autenticação
    echo json_encode(array("autenticado" => true, "tipo" => $_SESSION['tipo']));
} else {

    $host = "localhost";
    $usuario = "root";
    $senha_banco = "";
    $banco = "projeto";

    // Conexão com o banco de dados MySQL
    $conn = new mysqli($host, $usuario, $senha_banco, $banco);

    if ($conn->connect_error) {
        die("Falha na conexão: " . $conn->connect_error);
    }

    // Prepara uma consulta SQL para evitar SQL Injection
    $stmt = $conn->prepare("SELECT * FROM usuario WHERE login = ?");
    $stmt->bind_param("s", $username); // Substitui os placeholders "?" pelos valores de login e senha fornecidos

    // Executa a consulta
    $stmt->execute();
    $resultado = $stmt->get_result();

    // Verifica se algum usuário foi encontrado
    if ($resultado->num_rows > 0) {
        $linha = $resultado->fetch_assoc();
        $hash_senha_armazenada = $linha['senha'];
        $id_cliente = $linha["cliente_codigo_cliente"];
        $id_restaurante = $linha['restaurante_codigo_restaurante'];

        // Verifica se a senha inserida corresponde ao hash armazenado
        if (password_verify($password, $hash_senha_armazenada) && $id_restaurante != null) {
            if ($id_cliente != null) {
                // Se o usuário for um cliente, busca seus dados na tabela 'cliente'
                $sql = "SELECT * FROM cliente WHERE codigo_cliente = $id_cliente";
                if ($resultado = $conn->query($sql)) { // Executa a consulta para buscar os dados do cliente
                    $linha = $resultado->fetch_assoc();
                    $nome = $linha["nome"];
                    $email = $linha["email"];
                    $telefone = $linha["telefone"];

                    // Armazena os dados do cliente na sessão
                    $_SESSION['tipo'] = 'cliente';
                    $_SESSION['id'] = $id_cliente;
                    $_SESSION['nome'] = $nome;
                    $_SESSION['email'] = $email;
                    $_SESSION['telefone'] = $telefone;
                    $_SESSION['login'] = true;
                }
            } else {
                // Caso contrário, o usuário é um restaurante, então busca os dados na tabela 'restaurante'
                $sql = "SELECT * FROM restaurante WHERE codigo_restaurante = $id_restaurante";
                if ($resultado = $conn->query($sql)) { // Executa a consulta para buscar os dados do restaurante
                    $linha = $resultado->fetch_assoc();
                    $nome = $linha["nome_fantasia"];
                    $email = $linha["email"];
                    $telefone = $linha["telefone"];

                    // Armazena os dados do restaurante na sessão
                    $_SESSION['tipo'] = 'restaurante';
                    $_SESSION['id'] = $id_restaurante;
                    $_SESSION['nome'] = $nome;
                    $_SESSION['email'] = $email;
                    $_SESSION['telefone'] = $telefone;
                    $_SESSION['login'] = true; // Define que o usuário está autenticado
                }
            }
            // Retorna uma resposta JSON indicando sucesso na autenticação
            echo json_encode(array("autenticado" => true, "tipo" => $_SESSION['tipo'], "id" => $_SESSION['id']));
        } else {
            echo json_encode(array("autenticado" => false, "usuario" => true));
        }
    } else {
        echo json_encode(array("autenticado" => false, "usuario" => false));
    }

    $stmt->close(); // Fecha a instrução preparada
    $conn->close(); // Fecha a conexão com o banco de dados
}
?>