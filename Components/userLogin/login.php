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
$conn = new mysqli(
    $host,
    $usuario,
    $senha_banco,
    $banco
);

// Verifica a conexão
if ($conn->connect_error) {
    die("Falha na conexão: " .
        $conn->connect_error);
}

// Insere o usuário no banco de dados
$sql = "SELECT * FROM usuario  
        WHERE Nome = '$username' AND Senha = '$password'";

$resultado = $conn->query($sql);
if ($resultado->num_rows > 0) {
    $linha = $resultado->fetch_assoc();
    $id = $linha["id"];
    $Nome = $linha["Nome"];
    $Sobrenome = $linha["Sobrenome"];
    $Email = $linha["Email"];
    $DataNasc  = $linha["DataNasc"];

    $_SESSION['id'] = $id;
    $_SESSION['Nome'] = $Nome;
    $_SESSION['Sobrenome'] = $Sobrenome;
    $_SESSION['Email'] = $Email;
    $_SESSION['DataNasc'] = $DataNasc;  
    $_SESSION['Senha'] = $linha["Senha"];
    
    echo json_encode(array("autenticado" => true, "id" => $id));
} else {
    echo json_encode(array("autenticado" => false));
}
?>