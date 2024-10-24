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

        <a href="/Sem-Esperar-em-Filas/index.php" target="_top" class="logo"> 
            <img src="/Sem-Esperar-em-Filas/Components/images/logoSef.png" alt="">Sem esperar em Filas
        </a>

        <nav class="navbar">
            <a href="/Sem-Esperar-em-Filas/index.php" target="_top">Home</a>
            <a href="/Sem-Esperar-em-Filas/Components/AboutUs/about.html" target="_top">Sobre Nós</a>

            <?php
            // Se o usuário não estiver logado, exibe a opção de login
            if (!isset($_SESSION['login']) || $_SESSION['login'] !== true) {
                echo '
                <a href="/Sem-Esperar-em-Filas/Components/RestaurantRegisterPage/RestauranteRegister.html" target="_top" class="navbar-link" data-nav-link>Cadastre Seu Restaurante</a>
                <a href="/Sem-Esperar-em-Filas/Components/LoginSelection/loginOption.html" target="_top" id="login-navbar">Login</a>';
            } else {
                // Se o usuário estiver logado como cliente
                if ($_SESSION['tipo'] == 'cliente') {
                    echo '
                    <a href="/Sem-Esperar-em-Filas/Components/RestaurantesBusca/restaurantsPage.php" target="_top">Restaurantes</a>
                    <a href="/Sem-Esperar-em-Filas/Components/CarrinhoDeCompras/cart.html" target="_top"><i class="fas fa-cart-shopping"></i> Carrinho</a>';
                }
                // Se o usuário estiver logado como restaurante
                else if ($_SESSION['tipo'] == 'restaurante') {
                    echo '
                    <a href="./Components/ProductPage/ProductList.html" target="_top"><i class="fas fa-list"></i> Cadastrar Cardápios</a>
                    <a href="/Sem-Esperar-em-Filas/Components/ProductPage/Products.html" target="_top"><i class="fas fa-burger"></i> Cadastrar Produtos</a> ';
                }

                // Opção de logout para todos os tipos de usuários logados
                echo '
                <a href="./Components/userLogin/logout.php"><i class="fas fa-arrow-right-from-bracket"></i> Logout</a>';
            }
            ?>

        <?php
          if (isset($_SESSION['tipo'])) { 
          ?> 
          <ol class="navbar-item">
             Logado como <?php echo $_SESSION['tipo']?>
          </ol>
          <?php } ?>
        </nav>

        <div id="menu-btn" class="fas fa-bars"></div>

    </section>
    <!-- header section ends -->


</body>
</html>