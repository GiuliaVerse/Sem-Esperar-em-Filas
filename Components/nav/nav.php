<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="stylesheet" href="/Sem-Esperar-em-Filas/Components/nav/nav.css">
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
                <a href="/Sem-Esperar-em-Filas/Components/LoginSelection/loginOption.html" target="_top" id="login-navbar">Login</a>';
            } else {
                // Se o usuário estiver logado como cliente
                if ($_SESSION['tipo'] == 'cliente') {
                    $cliente = $_SESSION['nome'];
                    echo'
                    <a href="/Sem-Esperar-em-Filas/Components/Menu/menu.php" target="_top">Restaurantes</a>
                    <a href="/Sem-Esperar-em-Filas/Components/CarrinhoDeCompras/cart.html" target="_top"><i class="fas fa-cart-shopping"></i> Carrinho</a>';
                    echo '<a href="#" class="user-icon" data-tooltip="Olá, ' . htmlspecialchars($cliente) . '"><i class="fas fa-user"></i> cliente</a>';
                }
                // Se o usuário estiver logado como restaurante
                else if ($_SESSION['tipo'] == 'restaurante') {
                    $restaurante = $_SESSION['nome'];
                    echo '
                    <a href="/Sem-Esperar-em-Filas/Components/Cardapio/cardapioPage.php" target="_top"><i class="fas fa-list"></i> Cadastrar Cardápios</a>
                    <a href="/Sem-Esperar-em-Filas/Components/ProductPage/ProductsPage.php" target="_top"><i class="fas fa-burger"></i> Cadastrar Produtos</a>
                    <a href="#" class="user-icon" data-tooltip="Olá, ' . htmlspecialchars($restaurante) . '"><i class="fas fa-utensils"></i> restaurante </a>';
                }
                
                // Opção de logout para todos os tipos de usuários logados
                echo '
                <a href="/Sem-Esperar-em-Filas/Components/userLogin/logout.php" target="_top"><i class="fas fa-arrow-right-from-bracket"></i> Logout</a>';
            }
            ?>
        </nav>

        <div id="menu-btn" class="fas fa-bars"></div>

    </section>
    <!-- header section ends -->

</body>
</html>