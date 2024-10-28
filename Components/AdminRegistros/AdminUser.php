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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">
    <title>Tela ADM</title>
    <style>
        body {
            background: white;
            color: black;
            text-align: center;
        }

        .table-bg{
            background: rgba(0,0,0,0.5);
            border-radius: 15px 15px 0 0;
        }
    </style>
</head>
<body>
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha384-k6RqeWeci5ZR/Lv4MR0sA0FfDOMj4z4xExS5H/sa7WoH5OXa6k1L8tT2zW1z6cB" crossorigin="anonymous">
    <style>
        .logout-button {
            text-decoration: none;
            color: white;
            background-color: #007bff; /* Cor de fundo do botão */
            padding: 10px 15px; /* Espaçamento interno */
            border-radius: 5px; /* Cantos arredondados */
            transition: background-color 0.3s ease; /* Efeito de transição */
        }

        .logout-button:hover {
            background-color: #0056b3; /* Cor de fundo ao passar o mouse */
        }

        .logout-button i {
            margin-right: 5px; /* Espaçamento entre o ícone e o texto */
        }
    </style>
    <?php
    echo '
    <a href="/Sem-Esperar-em-Filas/Components/AdminRegistros/sair.php" class="logout-button"><i class="fas fa-arrow-right-from-bracket"></i>Logout</a>';
    ?>
</head>

    <div class= "m-5">
        <table class="table table-white table-striped table-bg">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Login</th>
                    <th scope="col">Senha</th>
                    <th scope="col">Email</th>
                    <th scope="col">Codigo Perfil</th>
                    <th scope="col">Codigo Cliente</th>
                    <th scope="col">Codigo Restaurante</th>
                    <th scope="col">Codigo Administrador</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result && $result->num_rows > 0) {
                    while($user_data = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $user_data['codigo_usuario'] . "</td>";
                        echo "<td>" . $user_data['nome'] . "</td>";
                        echo "<td>" . $user_data['login'] . "</td>";
                        echo "<td>" . $user_data['senha'] . "</td>";
                        echo "<td>" . $user_data['email'] . "</td>";
                        echo "<td>" . $user_data['perfil_codigo_perfil'] . "</td>";
                        echo "<td>" . $user_data['cliente_codigo_cliente'] . "</td>";
                        echo "<td>" . $user_data['restaurante_codigo_restaurante'] . "</td>";
                        echo "<td>" . $user_data['administrador_codigo_administrador'] . "</td>";
                        echo "<td>
                            <a class='btn btn-primary' href='adminEdit.php?id=" . $user_data['codigo_usuario'] . "'>
                                Editar
                            </a>
                            <a class='btn btn-danger' href='deleteUser.php?id=" . $user_data['codigo_usuario'] . "' onclick=\"return confirm('Tem certeza que deseja excluir este usuário?');\">
                                Excluir
                            </a>
                        </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='10'>Nenhum dado encontrado.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>