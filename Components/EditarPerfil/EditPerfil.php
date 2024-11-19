<?php
session_start();

if (!isset($_SESSION['id'])) {
    print_r($_SESSION);
    echo "ID do usuário na sessão não está definido ou é inválido.";
    exit();
}

$codigo_usuario = $_SESSION['id'];
include '../../db_connection.php';

$sql = "SELECT * FROM usuario";
if ($_SESSION['tipo'] === "restaurante") {
    $sql .= " WHERE restaurante_codigo_restaurante = ?";
} else {
    $sql .= " WHERE cliente_codigo_cliente = ?";
}

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $codigo_usuario);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    echo "Usuário não encontrado.";
    exit();
}

$usuario = $result->fetch_assoc();

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="stylesheet" href="/Sem-Esperar-em-Filas/Components/EditarPerfil/edit.css">
    <title>Editar Perfil</title>
</head>
<body>
    <main>
        <h1>Editar Perfil</h1>
        <form id="updateForm">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($usuario['codigo_usuario']); ?>">
            <div>
                <label for="nome">Nome:</label>
                <input type="text" name="nome" id="nome" value="<?php echo htmlspecialchars($usuario['nome']); ?>" required>
            </div>
            <div>
                <label for="nome">Login:</label>
                <input type="text" name="login" id="login" value="<?php echo htmlspecialchars($usuario['login']); ?>" required>
            </div>
            <div>
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($usuario['email']); ?>" required>
            </div>
            <div>
                <label for="senha">Senha:</label>
                <input type="password" name="senha" id="senha" placeholder="Deixe em branco se não quiser alterar">
            </div>
            <button type="submit">Atualizar</button>
            <button type="button" onclick="voltarPagina()">Voltar</button>
        </form>
        <div id="responseMessage"></div>
    </main>
    <script src="/Sem-Esperar-em-Filas/Components/EditarPerfil/updateProfile.js"></script>
</body>
</html>
