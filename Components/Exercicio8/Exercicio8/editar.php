<?php
$id = $_POST["id"];
$nome = $_POST['nome'];
$sobrenome = $_POST['sobrenome'];
$email = $_POST['email'];
$senha = $_POST['senha'];
$dataNascimento = new DateTime($_POST['dataNascimento']);
$dataStr = $dataNascimento->format('Y-m-d');
$mensagem = "";

if ($nome === "" || $sobrenome === "" || $email === "" || $senha === "" || $dataNascimento === "") {
    // verifica se algum dos campos do formulário está vazio
    echo json_encode(array("mensagem" => "Todos os campos devem ser preenchidos."));
    return;
}

// Calcula a idade
$hoje = new DateTime(); // a data e hora atuais do sistema. 
$idade = $hoje->format('Y') - $dataNascimento->format('Y');
$mes = $hoje->format('m') - $dataNascimento->format('m');
if ($mes < 0 || ($mes === 0 && $hoje->format('d') < $dataNascimento->format('d'))) {
    $idade--;
    // Verifica se o dia e mês de nascimento ainda não ocorreram este ano. 
    // Se o mês de nascimento for maior que o mês atual, ou se ambos forem iguais, 
    // Mas o dia de nascimento for maior que o dia atual, significa que o aniversário ainda não chegou.
}

// Verifica se tem menos que 18 anos
if ($idade < 18) {
    echo json_encode(array("mensagem" => "Usuário deve ter mais do que 18 anos."));
    return; 
}

$emailRegex = "/^[\w-]+(\.[\w-]+)*@pucpr\.(br|edu\.br)$/i"; // emailRegex é usado para validar endereços de e-mail.
if (!preg_match($emailRegex, $email)) {
    echo json_encode(array("mensagem" => "Somente é permitido cadastrar um e-mail institucional da PUCPR."));
    return;
}

$host = "localhost"; // Nome do servidor MySQL
$usuario = "root"; // Nome de usuário do MySQL
$senha_banco = ""; // Senha do MySQL (deixe vazio se não houver senha)
$banco = "ClienteServidor"; // Nome do banco de dados

// conexão com o banco
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

// Atualizar dados do Usuario
$sql = "UPDATE usuario 
    SET Nome='$nome', Senha='$senha', Sobrenome='$sobrenome', Email='$email', DataNasc='$dataStr'
    WHERE id = $id";

if ($conn->query($sql) === true) {
    echo json_encode(array("mensagem" => "ok"));
} else {
    echo json_encode(array("mensagem" => $conn->error));
}