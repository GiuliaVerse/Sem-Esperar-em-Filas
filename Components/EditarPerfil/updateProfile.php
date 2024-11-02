<?php
session_start();
include '../../db_connection.php';

$id = $_POST['id'];
$nome = $_POST['nome'];
$login = $_POST['login'];
$email = $_POST['email'];
$senha = $_POST['senha'];

// Prepara o SQL com o update condicional
$sql = "UPDATE usuario SET nome=?, login=?, email=?";
$params = [$nome, $login, $email];

if (!empty($senha)) {
    $sql .= ", senha=?";
    $params[] = password_hash($senha, PASSWORD_DEFAULT); // Sugiro salvar a senha com hash
}

$sql .= " WHERE codigo_usuario=?";
$params[] = $id;

$stmt = $conn->prepare($sql);
$stmt->bind_param(str_repeat("s", count($params)), ...$params);

$response = ["success" => false, "message" => "Erro ao atualizar perfil"];

if ($stmt->execute()) {
    $response["success"] = true;
    $response["message"] = "Perfil atualizado com sucesso!";
} else {
    $response["message"] = "Erro ao atualizar perfil: " . $stmt->error;
}

$stmt->close();
$conn->close();

echo json_encode($response);
?>