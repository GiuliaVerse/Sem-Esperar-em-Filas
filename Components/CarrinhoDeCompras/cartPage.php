<?php
$tipoPagina = 'cliente';
require('../../valida_sessao.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrinho de Compras</title>
    <link rel="stylesheet" href="cart.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

    <!-- Adicionando SweetAlert CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>

    <div class="carrinho">
        <div class="carrinho-header">
            <button>
                <span class="material-symbols-outlined" id="voltar">
                    chevron_left
                </span>
            </button>
            <h3>Meu Carrinho</h3>
        </div>

        <div class="cart-items">
            <div id="cartContainer"></div>
        </div>

        <div class="carrinho-total">
            <strong>Total: </strong>
            <span>R$0,00</span>
        </div>
        <div class="buttons">
            <button id="comprar" class="comprar-button">Comprar</button>
            <button class="continuar-comprando-button" id="continuar-comprando-button">Continuar Comprando</button>
        </div>
    </div>

    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Escolha a forma de pagamento</h2>
            <button id="pagamento-cartao" class="metodo-pagamento">Cartão</button>
            <button id="pagamento-pix" class="metodo-pagamento">Pix</button>
        </div>
    </div>


    <script src="cart.js"></script>
</body>

</html>