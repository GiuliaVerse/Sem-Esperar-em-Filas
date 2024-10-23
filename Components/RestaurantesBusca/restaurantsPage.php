<?php
    include('Restaurants.php');

	require('../../valida_sessao.php');
    if ($_SESSION["tipo"] != "cliente") {
        $url = "Location: /" . $url . "/index.php";             // Monta URL para redirecionamento
        header($url);                                           // Vai para a página de login / inicial
        exit();    
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Delivery - Busca de Restaurantes</title>
    <link rel="stylesheet" href="restaurantsPage.css">
</head>

<body>
    <header>
        <iframe src="../Header/NavBar/navBar.php" width="100%" height="100"></iframe>
    </header>
        <h2>Restaurantes Disponíveis</h2>
    <form>
        <input name="busca" value="<?php if(isset($_GET['busca'])) echo $_GET['busca']; ?>" placeholder="Digite o restaurante procurado" type="text" >
        <button type="submit"> Pesquisar Restaurante</button>
    </form>
    <br>
    <table width="600px" border="1">
        <tr>
            <th>Restaurante</th>
        </tr>
        
        <?php
        if (!isset($_GET['busca'])) {
            ?>
        <tr>
            <td colspan="1">Digite o restaurante para pesquisar</td>
        </tr>
        <?php
        } else {
            //Evita SQL injection com o real escape string no get busca
            $pesquisa = $mysqli ->real_escape_string($_GET['busca']);
            $sql_code = " SELECT * FROM restaurante WHERE nome_fantasia LIKE '%$pesquisa%' ";
            $sql_query = $mysqli ->query($sql_code) or die("Erro ao consultar! " . $mysqli ->error);

            if($sql_query -> num_rows == 0) {
        ?>
        <tr>
            <td colspan="1">Nenhum restaurante encontrado ...</td>
        </tr>
        <?php 
        } else {
            while($dados = $sql_query -> fetch_assoc()) {
                ?>
                <tr>
                    <td><?php echo $dados['nome_fantasia']; ?> </td>
                </tr>
                <?php

            }
        }
        ?>

        <?php
        } ?>
        
    </table>

    <script src="Restaurants.js"></script>

    <footer>
        <iframe src="../Footer/footer.html" width="100%" height="100"></iframe>
    </footer>
</body>

</html>