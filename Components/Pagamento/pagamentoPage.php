<?php
$tipoPagina = 'cliente';
require('../../valida_sessao.php');
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="pagamento.css">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=arrow_back_ios" />
    <title>Pagamento via Pix</title>
</head>

<body>
        <div class='checkout'>
        <div class='order'>
            <a href="../CarrinhoDeCompras/cartPage.php" class="back-button">
                <span class="material-symbols-outlined">arrow_back_ios</span>
            </a>
            <h2 style="display: inline;">Checkout</h2>

            <h5>Order #0101</h5>

            <div class="cart-items">
                <div id="cartContainer"></div>
            </div>

            <br><br />
            <div class="carrinho-total">
                <h5 class='total'>Total</h5>
                <span>R$0,00</span>
            </div>
            <!--
            <br><br />
            <h5 class='total'>Total</h5>
            <h1>R$: </h1>
            -->
        </div>
        <h2>Pagamento via Pix</h2>
        <div id='payment' class='payment'>
            <div class='card-content'> 
                <div class='pix-info'>
                    <h5>Código QR</h5>
                </div>
                <div class="qr-container">
                    <img src='../../Components/Images/QrCode-GitHub.jpeg' alt='Código QR para pagamento via Pix' />
                </div>
            <button class='button-cta' id="pagar" title='Confirm your purchase'><span>Pagar</span></button>

            </div>
        </div>

        <div id='paid' class='paid'>
            <svg id='icon-paid' xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                version="1.1" x="0px" y="0px" viewBox="0 0 310.277 310.277"
                style="enable-background:new 0 0 310.277 310.277;" xml:space="preserve" width="180px" height="180px">
                <g>
                    <path
                        d="M155.139,0C69.598,0,0,69.598,0,155.139c0,85.547,69.598,155.139,155.139,155.139   c85.547,0,155.139-69.592,155.139-155.139C310.277,69.598,240.686,0,155.139,0z M144.177,196.567L90.571,142.96l8.437-8.437   l45.169,45.169l81.34-81.34l8.437,8.437L144.177,196.567z"
                        fill="#3ac569" />
                </g>
            </svg>
            <h2>Seu pagamento foi completado.</h2>
            <h2>Obrigado!</h2>
        </div>
    </div>

    <script src="pagamento.js"></script>

</body>

</html>