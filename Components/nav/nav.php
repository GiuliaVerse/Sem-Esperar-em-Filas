<?php session_start()?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="stylesheet" href="nav.css">
    <title>Document</title>
</head>
<body>
    <!-- header section starts -->
    <section class="header">

        <a href="index.php" class="logo"> 
            <img src="/Sem-Esperar-em-Filas/Components/images/logoSef.png" alt="">Sem esperar em Filas
        </a>

        <nav class="navbar">
            <a href="./index.php">Home</a>
            <a href="./Components/AboutUs/about.html">Sobre</a>

            <?php
            // Se o usuário não estiver logado, exibe a opção de login
            if (!isset($_SESSION['login']) || $_SESSION['login'] !== true) {
                echo '
                <a href="./Components/Menu/menu.html">Restaurantes</a>
                <a href="/Sem-Esperar-em-Filas/Components/LoginSelection/loginOption.html" id="login-navbar">Login</a>';
            } else {
                // Se o usuário estiver logado como cliente
                if ($_SESSION['tipo'] == 'cliente') {
                    echo '
                    <a href="./Components/RestaurantesBusca/restaurantsPage.php">Restaurantes</a>
                    <a href="./Components/CarrinhoDeCompras/cart.html"><i class="fas fa-cart-shopping"></i> Carrinho</a>';
                }
                // Se o usuário estiver logado como restaurante
                else if ($_SESSION['tipo'] == 'restaurante') {
                    echo '
                    <a href="./Components/ProductPage/Products.html"><i class="fas fa-burger"></i> Cadastrar Produtos</a>
                    <a href="./Components/ProductPage/ProductList.html"><i class="fas fa-list"></i> Lista de Produtos</a>';
                }

                // Opção de logout para todos os tipos de usuários logados
                echo '
                <a href="./Components/userLogin/logout.php"><i class="fas fa-arrow-right-from-bracket"></i> Logout</a>';
            }
            ?>
        </nav>

        <div id="menu-btn" class="fas fa-bars"></div>

    </section>
    <!-- header section ends -->


</body>
</html>