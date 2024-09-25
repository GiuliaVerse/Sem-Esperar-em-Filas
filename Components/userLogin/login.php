<?php
session_start();

// Obtém os dados do formulário
$username = $_POST['usuario'];
$password = $_POST['senha'];

// Configurações do banco de dados
$host = "localhost"; // Nome do servidor MySQL
$usuario = "root"; // Nome de usuário do MySQL
$senha_banco = ""; // Senha do MySQL (deixe vazio se não houver senha)
$banco = "projeto"; // Nome do banco de dados

// Conexão com o banco de dados
$conn = new mysqli($host, $usuario, $senha_banco, $banco);

// Verifica a conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

// Prepara a consulta SQL para evitar SQL Injection
$stmt = $conn->prepare("SELECT * FROM usuario WHERE login = ?");
$stmt->bind_param("s", $username);

// Executa a consulta
$stmt->execute();
$resultado = $stmt->get_result();

// Verifica se encontrou algum resultado
if ($resultado->num_rows > 0) {
    // Obtém os dados do usuário
    $linha = $resultado->fetch_assoc();
    $senhaCodificada = $linha["senha"]; // Supondo que você armazenou a senha codificada aqui

    // Verifica a senha
    if (password_verify($password, $senhaCodificada)) {
        // Senha correta, continua com a autenticação
        $id_cliente = $linha["cliente_codigo_cliente"];
        $id_restaurante = $linha['restaurante_codigo_restaurante'];

        if ($id_cliente != null) {
            // Login como cliente
            $sql = "SELECT * FROM cliente WHERE codigo_cliente = ?";
            $stmtCliente = $conn->prepare($sql);
            $stmtCliente->bind_param("i", $id_cliente);
            $stmtCliente->execute();
            $resultadoCliente = $stmtCliente->get_result();

            if ($resultadoCliente->num_rows > 0) {
                $linhaCliente = $resultadoCliente->fetch_assoc();
                $_SESSION['tipo'] = 'cliente';
                $_SESSION['id'] = $id_cliente;
                $_SESSION['nome'] = $linhaCliente["nome"];
                $_SESSION['email'] = $linhaCliente["email"];
                $_SESSION['telefone'] = $linhaCliente["telefone"];
                $_SESSION['login'] = true;

                // Retorna uma resposta JSON de sucesso
                echo json_encode(array("autenticado" => true, "tipo" => 'cliente', "id" => $id_cliente));
            }
        } else {
            // Login como restaurante
            $sql = "SELECT * FROM restaurante WHERE codigo_restaurante = ?";
            $stmtRestaurante = $conn->prepare($sql);
            $stmtRestaurante->bind_param("i", $id_restaurante);
            $stmtRestaurante->execute();
            $resultadoRestaurante = $stmtRestaurante->get_result();

            if ($resultadoRestaurante->num_rows > 0) {
                $linhaRestaurante = $resultadoRestaurante->fetch_assoc();
                $_SESSION['tipo'] = 'restaurante';
                $_SESSION['id'] = $id_restaurante;
                $_SESSION['nome'] = $linhaRestaurante["nome_fantasia"];
                $_SESSION['email'] = $linhaRestaurante["email"];
                $_SESSION['telefone'] = $linhaRestaurante["telefone"];
                $_SESSION['login'] = true;

                // Retorna uma resposta JSON de sucesso
                echo json_encode(array("autenticado" => true, "tipo" => 'restaurante', "id" => $id_restaurante));
            }
        }
    } else {
        // Retorna uma resposta JSON de falha na senha
        echo json_encode(array("autenticado" => false, "message" => "Senha incorreta."));
    }
} else {
    // Retorna uma resposta JSON de falha
    echo json_encode(array("autenticado" => false, "message" => "Usuário não encontrado."));
}

// Fecha a declaração e a conexão
$stmt->close();
$conn->close();
?>