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

            <!-- Produtos adicionados ao carrinho irão aparecer aqui -->
            <!-- div class="cart-product">
                <button class="photo-button">
                    <img src="../../Components/Images/icone-adicionar-foto.jpg" alt="Adicionar Foto">
                </button>
                <div class="product-details">
                    <p class="cart-product-title">Nome do Produto</p>
                    <p class="cart-product-price">R$50,00</p>
                </div>
                <input type="number" class="product-qtd-input" value="1">
                <button id="remover" class="remove-product-button">Remover</button>
            </div -->
        </div>

        <div class="carrinho-total">
            <strong>Total: </strong>
            <span>R$0,00</span>
        </div>
        <button id="comprar" class="comprar-button">Comprar</button>
        <button class="continuar-comprando-button" id="continuar-comprando-button">Continuar Comprando</button>
    </div>
    <script src="cart.js"></script>
</body>

</html>