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
    <link rel="stylesheet" href="cartao.css">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=arrow_back_ios" />
    <title>Cartão de Crédito</title>
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
        </div>

        <h2>Cartão de Crédito</h2>
        <div id='payment' class='payment'>
            <div class='card'>
                <div class='card-content'>
                    <svg id='logo-visa' enable-background="new 0 0 50 70" height="70px" version="1.1"
                        viewBox="0 0 50 50" width="70px" xml:space="preserve" xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink">
                        <g>
                        </g>
                    </svg>
                    <h5>Card Number</h5>
                    <h6 id='label-cardnumber'>0000 0000 0000 0000</h6>
                    <h5>Expiration<span>CVC</span></h5>
                    <h6 id='label-cardexpiration'>00 / 0000<span>000</span></h6>
                </div>
                <div class='wave'></div>
            </div>
            <div class='card-form'>
                <p class='field'>
                    <input type='text' id='cardnumber' name='cardnumber' placeholder='1234 5678 9123 4567' pattern='\d*'
                        title='Card Number' />
                </p>
                <p class='field space'>
                    <input type='text' id='cardexpiration' name='cardexpiration' placeholder="MM / YYYY" pattern="\d*"
                        title='Card Expiration Date' />
                </p>
                <p class='field'>
                    <input type='text' id='cardcvc' name='cardcvc' placeholder="123" pattern="\d*" title='CVC Code' />
                </p>
                <button class='button-cta' title='Confirm your purchase'><span>Pagar</span></button>
            </div>
        </div>

        <div id='paid' class='paid'>
            <svg id='icon-paid' xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                version="1.1" x="0px" y="0px" viewBox="0 0 310.277 310.277"
                style="enable-background:new 0 0 310.277 310.277;" xml:space="preserve" width="180px" height="180px">
            </svg>
            <h2>Your payment was completed.</h2>
            <h2>Thank you!</h2>
        </div>
    </div>
    <script src="pagamento.js"></script>
</body>

</html>