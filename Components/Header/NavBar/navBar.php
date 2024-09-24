<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SEF - Sem Esperar Em Filas</title>
  <meta name="title" content="SEF - Sem Esperar Em Filas">
  <meta name="description" content="PUCPR PROJETO PARA CANTINAS">
  <link rel="stylesheet" href="../../../style.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
  <script src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script> <!-- Certifica-se de que o Ionicons é carregado -->
</head>

<body>
  <!-- Header NAVBAR-->
  <header class="header" data-header>
    <div class="container">
      <a href="../../../index.php" target="_top" class="logo">
        <img src="../../Images/Captura de tela 2024-06-06 164451.png" width="50" height="38" alt="SEF home">
      </a>
      <nav class="navbar" data-navbar>
        <button class="nav-close-btn" aria-label="close menu" data-nav-toggler>
          <ion-icon name="close-outline" aria-hidden="true"></ion-icon>
        </button>
        <a href="#" class="logo">
          <img src="../../Images/hamburguer.png" width="50" height="38" alt="SEF home">
        </a>
        <ul class="navbar-list">
          <?php
          if (!isset($_SESSION['login']) || $_SESSION['login'] !== true) { 
          ?> 
          <li class="navbar-item">
            <a href="../../../Components/userLogin/login.html" target="_top" class="navbar-link" data-nav-link>Login</a>
          </li>
          <?php
          } else {
          ?> 
          <li class="navbar-item">
            <a href="../../../Components/userLogin/logout.php" target="_top" class="navbar-link" data-nav-link>Logout</a>
          </li>
          <?php
          }
          ?> 

          <li class="navbar-item">
            <a href="../../../Components/AboutUs/about.html" target="_top"  class="navbar-link" data-nav-link>Sobre nós</a>
          </li>
          <li class="navbar-item">
            <a href="../../../Components/RestaurantesBusca/restaurantsPage.php" target="_top" class="navbar-link" data-nav-link>Restaurantes</a>
          </li>
          <li class="navbar-item"> 
            <a href="../../../Components/RestaurantLogin/RestaurantLogin.html" target="_top" class="navbar-link" data-nav-link>Login Restaurante</a>
          </li>
          <li class="navbar-item"> 
            <a href="../../../Components/CarrinhoDeCompras/cart.html" target="_top" class="navbar-link" data-nav-link>Carrinho</a>
          </li>
          <?php
          if (isset($_SESSION['tipo'])) { 
          ?> 
          <li class="navbar-item">
             Logado como <?php echo $_SESSION['tipo']?>
          </li>
          <?php } ?>
        </ul>
      </nav>
      <div class="header-action">
      </div>
      <div class="overlay" data-overlay data-nav-toggler></div>
    </div>
  </header>

  <script>
    document.addEventListener("DOMContentLoaded", function() {
      document.getElementById("cart-icon").addEventListener("click", function(event) {
        event.preventDefault();
        window.location.href = "/Components/CarrinhoDeCompras/cart.html";
      });
    });
  </script>
</body>

</html>
