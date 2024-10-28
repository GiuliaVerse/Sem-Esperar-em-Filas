<?php
    $tipoPagina = 'admin';
	require('../../valida_sessao.php');
include_once('config.php');

// Exibir erros para ajudar na depuração
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Obtém o ID do usuário que será editado
$id = $_GET['id'] ?? null;

// Se o ID não foi passado, redireciona para a listagem de usuários
if (!$id) {
    header("Location: AdminUser.php");
    exit;
}

// Se o formulário foi enviado, processa a atualização
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $login = $_POST['login'];

    // Verifica se uma nova senha foi fornecida
    if (!empty($senha)) {
        // Codifica a nova senha
        $senha = password_hash($senha, PASSWORD_DEFAULT);
        // Query para atualizar o usuário com nova senha
        $updateSql = "UPDATE usuario SET nome=?, email=?, senha=?, login=? WHERE codigo_usuario=?";
        $stmtUpdate = $conn->prepare($updateSql);
        $stmtUpdate->bind_param("ssssi", $nome, $email, $senha, $login, $id);
    } else {
        // Query para atualizar o usuário sem mudar a senha
        $updateSql = "UPDATE usuario SET nome=?, email=?, login=? WHERE codigo_usuario=?";
        $stmtUpdate = $conn->prepare($updateSql);
        $stmtUpdate->bind_param("sssi", $nome, $email, $login, $id);
    }

    // Executa a query e verifica se foi bem-sucedida
    if ($stmtUpdate->execute()) {
        $_SESSION['message'] = "Usuário atualizado com sucesso."; // Armazena a mensagem na sessão
        header("Location: AdminUser.php");
        exit;
    } else {
        echo "Erro ao atualizar usuário: " . $stmtUpdate->error;
    }
}

// Busca os dados atuais do usuário no banco
$sql = "SELECT * FROM usuario WHERE codigo_usuario = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

// Verifica se encontrou o usuário
if ($result->num_rows > 0) {
    $user_data = $result->fetch_assoc();
} else {
    echo "Usuário não encontrado.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Editar Usuário</title>
    <style>
        body {
            background-color: #f8f9fa; /* Cor de fundo clara */
        }

        .container {
            background-color: white; /* Fundo branco para o formulário */
            border-radius: 10px; /* Bordas arredondadas */
            padding: 20px; /* Espaçamento interno */
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); /* Sombra suave */
        }

        h2 {
            margin-bottom: 20px; /* Margem abaixo do título */
        }

        .btn-primary {
            background-color: hsl(39, 96%, 48%); /* Cor do botão */
            border: none; /* Remover borda */
        }

        .btn-primary:hover {
            background-color: hsl(39, 96%, 40%); /* Cor do botão ao passar o mouse */
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Editar Usuário</h2>
        
        <!-- Exibir mensagem se existir -->
        <?php if (isset($_SESSION['message'])): ?>
            <div class="alert alert-success">
                <?php 
                echo $_SESSION['message']; 
                unset($_SESSION['message']); // Limpa a mensagem após exibi-la
                ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="">
            <div class="mb-3">
                <label for="nome" class="form-label">Nome:</label>
                <input type="text" class="form-control" id="nome" name="nome" value="<?php echo htmlspecialchars($user_data['nome']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($user_data['email']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="senha" class="form-label">Senha (deixe em branco se não quiser alterar):</label>
                <input type="password" class="form-control" id="senha" name="senha">
            </div>
            <div class="mb-3">
                <label for="login" class="form-label">Login:</label>
                <input type="text" class="form-control" id="login" name="login" value="<?php echo htmlspecialchars($user_data['login']); ?>" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Salvar Alterações</button> <!-- Botão de largura total -->
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
