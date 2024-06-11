<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DADOS DO USUARIO</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <?php
     session_start();
    ?>

    <div class="container">
        <h2>Dados do Usuário</h2>
        <form id="dadosUsuarioForm">
            <input type="hidden" id = "id" name = "id" value=<?php echo $_SESSION["id"]?> >

            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" value=<?php echo $_SESSION["Nome"]?> required>

            <label for="nome">Sobrenome:</label>
            <input type="text" id="sobrenome" name="sobrenome" value=<?php echo $_SESSION["Sobrenome"]?>  required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value=<?php echo $_SESSION["Email"]?> required>

            <label for="senha">Senha:</label>
            <input type="password" id="senha" name="senha" value=<?php echo $_SESSION["Senha"]?> required>

            <label for="dataNascimento">Data de Nascimento:</label>
            <input type="date" id="dataNascimento" name="dataNascimento" placeholder="Data de Nascimento" value=<?php echo $_SESSION["DataNasc"]?> >

            <button type="button" onclick="login()">Login</button>
            <button type="button" onclick="atualizar()">Atualizar</button>
            <button type="button" onclick="excluir()">Excluir</button>
            

        </form>
        <p id="mensagem"></p>
    </div>

    <script src="dadosUsuario.js"></script>

</body>

</html>