<?php
    $tipoPagina = 'admin';
	require('../../valida_sessao.php');
include_once('config.php');

// Verifica se o id foi enviado via GET
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Comando para deletar o usuário no banco de dados
    $sql = "DELETE FROM usuario WHERE codigo_usuario = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "Usuário excluído com sucesso!";
        header("Location: adminUser.php"); // Redireciona para a lista de usuários
        exit();
    } else {
        echo "Erro ao excluir usuário: " . $conn->error;
    }

    $stmt->close();
}

$conn->close();
?>
