<?php
$restaurantes = include 'fetch_restaurantes.php';
include $_SERVER['DOCUMENT_ROOT'].'/Sem-Esperar-em-Filas/Components/nav/nav.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightgallery-js/1.4.0/css/lightgallery.min.css">
    <link rel="icon" href="./Components/images/logoSef.png" type="image/png">
    <link rel="stylesheet" href="menu.css">
    <title>Restaurantes | SEF</title>
</head>
<body>

    <!-- Cardápio Section -->
    <section class="menu" id="menu">
        <div class="heading">
            <h3>Restaurantes</h3>
        </div>
        <div class="menu-slider">
            <?php if (!empty($restaurantes)): ?>
                <?php foreach ($restaurantes as $restaurante): ?>
                    <div class="menu-item">
                        <div class="image">
                            <img src="/restaurantes/Components/Images/restaurant-img.jpg" alt="">
                            <span><?php echo $restaurante['nome']; ?></span>
                        </div>
                        <div class="content">
                            <a href="#" class="title"><?php echo $restaurante['nome']; ?></a>
                            <a href="/Sem-Esperar-em-Filas/Components/ExibirCardapio/cardapio.php?id=<?php echo $restaurante['id']; ?>" class="menu-btn">Cardápio</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Nenhum restaurante encontrado.</p>
            <?php endif; ?>
        </div>
    </section>
    <!-- Cardápio Section End -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightgallery-js/1.4.0/js/lightgallery.min.js"></script>
    <script src="menu.js"></script>
</body>
</html>
