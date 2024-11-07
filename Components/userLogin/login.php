<?php
session_start();

$username = $_POST['usuario'];
$password = $_POST['senha'];

if ($username === 'admin' && $password === '1234') {
    $_SESSION['login'] = true;
    $_SESSION['tipo'] = 'admin';

    echo json_encode(array("autenticado" => true, "tipo" => $_SESSION['tipo']));
} else {

    $host = "localhost";
    $usuario = "root";
    $senha_banco = "";
    $banco = "projeto";

    // Conexão com o banco de dados
    $conn = new mysqli($host, $usuario, $senha_banco, $banco);

    // Verifica a conexão com o banco de dados
    if ($conn->connect_error) {
        die("Falha na conexão: " . $conn->connect_error);
    }

    // Prepara a consulta SQL para evitar SQL Injection (proteger contra dados maliciosos)
    $stmt = $conn->prepare("SELECT * FROM usuario WHERE login = ?");
    $stmt->bind_param("s", $username);

    // Executa a consulta SQL
    $stmt->execute();
    $resultado = $stmt->get_result();

    // Verifica se foi encontrado algum resultado
    if ($resultado->num_rows > 0) {
        $linha = $resultado->fetch_assoc();
        $hash_senha_armazenada = $linha['senha'];
        $id_cliente = $linha["cliente_codigo_cliente"];
        $id_restaurante = $linha['restaurante_codigo_restaurante'];

        // Verifica se a senha inserida corresponde ao hash armazenado
        if (password_verify($password, $hash_senha_armazenada)) {

            // Verifica se o usuário é um cliente (se a coluna cliente_codigo_cliente não for nula)
            if ($id_cliente != null) {
                // Prepara uma nova consulta para obter os dados do cliente
                $sql = "SELECT * FROM cliente WHERE codigo_cliente = $id_cliente";
                if ($resultado = $conn->query($sql)) {
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
                // Se o usuário não é um cliente, verifica se ele é um restaurante
                $sql = "SELECT * FROM restaurante WHERE codigo_restaurante = $id_restaurante";
                if ($resultado = $conn->query($sql)) { // Executa a consulta
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
                    $_SESSION['login'] = true;
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

    $stmt->close();
    $conn->close();
}
?>