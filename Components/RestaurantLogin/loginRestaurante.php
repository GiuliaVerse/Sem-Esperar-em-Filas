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
    $senha_hash = $linha["senha"]; // Obtenha o hash da senha armazenada

    // Verifica se a senha fornecida corresponde ao hash armazenado
    if (password_verify($password, $senha_hash)) {
        $id_cliente = $linha["cliente_codigo_cliente"];
        $id_restaurante = $linha['restaurante_codigo_restaurante'];

        if ($id_cliente != null) {
            $sql = "SELECT * FROM cliente WHERE codigo_cliente = $id_cliente";
            if ($resultado = $conn->query($sql)) {
                $linha = $resultado->fetch_assoc();
                $nome = $linha["nome"];
                $email = $linha["email"];
                $telefone = $linha["telefone"];

                // Armazena os dados na sessão
                $_SESSION['tipo'] = 'cliente';
                $_SESSION['id'] = $id_cliente;
                $_SESSION['nome'] = $nome;
                $_SESSION['email'] = $email;
                $_SESSION['telefone'] = $telefone;
                $_SESSION['login'] = true;
            }
        } else {
            $sql = "SELECT * FROM restaurante WHERE codigo_restaurante = $id_restaurante";
            if ($resultado = $conn->query($sql)) {
                $linha = $resultado->fetch_assoc();
                $nome = $linha["nome_fantasia"];
                $email = $linha["email"];
                $telefone = $linha["telefone"];

                // Armazena os dados na sessão
                $_SESSION['tipo'] = 'restaurante';
                $_SESSION['id'] = $id_restaurante;
                $_SESSION['nome'] = $nome;
                $_SESSION['email'] = $email;
                $_SESSION['telefone'] = $telefone;
                $_SESSION['login'] = true;
            }
        }

        // Retorna uma resposta JSON de sucesso
        echo json_encode(array("autenticado" => true, "tipo" => $_SESSION['tipo'], "id" => $_SESSION['id']));
    } else {
        // Retorna uma resposta JSON de falha (senha incorreta)
        echo json_encode(array("autenticado" => false, "mensagem" => "Senha incorreta"));
    }
} else {
    // Retorna uma resposta JSON de falha (usuário não encontrado)
    echo json_encode(array("autenticado" => false, "mensagem" => "Usuário não encontrado"));
}

// Fecha a declaração e a conexão
$stmt->close();
$conn->close();
?>
