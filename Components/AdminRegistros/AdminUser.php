<?php
    $tipoPagina = 'admin';
    require('../../valida_sessao.php');
    include_once('config.php');

    // Exibir erros para ajudar na depuração
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    // Consulta ao banco de dados
    $sql = "SELECT * FROM usuario ORDER BY codigo_usuario DESC";
    $result = $conn->query($sql);

    if (!$result) {
        die("Erro na consulta: " . $conn->error);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Gerenciamento Admin</title>
</head>
<body>
    <!-- Menu Dropdown para Conta do Usuário -->
    <div class="dropdown user-menu">
        <button class="btn btn-secondary dropdown-toggle" type="button" id="userMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="fas fa-gear"></i> opções
        </button>
        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userMenuButton">
            <li><a class="dropdown-item" href="/Sem-Esperar-em-Filas/index.php">Home</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="/Sem-Esperar-em-Filas/Components/AdminRegistros/sair.php">Logout</a></li>
        </ul>
    </div>

    <!-- Tabela de Usuários -->
    <table class="table">
        <thead class="thead-dark">
            <tr class="header">
                <th scope="col" class="text-center">ID</th>
                <th scope="col" class="text-center">Nome</th>
                <th scope="col" class="text-center">Login</th>
                <th scope="col" class="text-center">E-mail</th>
                <th scope="col" class="text-center">Código Perfil</th>
                <th scope="col" class="text-center">Código Cliente</th>
                <th scope="col" class="text-center">Código Restaurante</th>
                <th scope="col" class="text-center">Código Administrador</th>
                <th scope="col" class="text-center"></th>
            </tr>
        </thead>
        <tbody>
            <?php
             if ($result && $result->num_rows > 0) {

                while($user_data = $result->fetch_assoc()) {
                 echo"<tr class='content'>";
                 echo"<th scope='row' class='text-center'>".$user_data['codigo_usuario'] . "</th>";
                 echo"<td class='text-center align-middle'>". $user_data['nome'] . "</td>";
                 echo"<td class='text-center align-middle'>". $user_data['login'] . "</td>";
                 echo"<td class='text-center align-middle'>". $user_data['email'] . "</td>";
                 echo"<td class='text-center align-middle'>". $user_data['perfil_codigo_perfil'] . "</td>";
                 echo "<td class='text-center align-middle'>" . $user_data['cliente_codigo_cliente'] . "</td>";
                 echo "<td class='text-center align-middle'>" . $user_data['restaurante_codigo_restaurante'] . "</td>";
                 echo "<td class='text-center align-middle'>" . $user_data['administrador_codigo_administrador'] . "</td>";
                 echo "<td class='btns'>
                        <a class='editBtn' href='adminEdit.php?id=" . $user_data['codigo_usuario'] . "'>Editar</a>
                        <a class='deleteBtn' href='deleteUser.php?id=" . $user_data['codigo_usuario'] . "' onclick=\"return confirm('Tem certeza que deseja excluir este usuário?');\">Excluir</a>
                    </td>";
                 echo "</tr>";
                }

             } else {
                echo "<tr><td colspan='10'>Nenhum dado encontrado.</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <!-- Apenas o Bootstrap.bundle.min.js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>

