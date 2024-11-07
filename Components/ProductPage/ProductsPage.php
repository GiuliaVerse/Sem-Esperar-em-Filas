<?php
    $tipoPagina = 'restaurante';
	require('../../valida_sessao.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Produtos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="Products.css">
</head>

<header>
    <iframe src="../../Components/nav/nav.php"  width="100%" height="100"></iframe>
</header>

<body>
    <div class="container">
        <h2>Cadastro de Produtos</h2>
        <form id="productsRegistrationForm">
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="NomeProduto" name="NomeProduto" placeholder="Nome do Produto" required>
                <label for="NomeProduto">Nome do Produto</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="ValorProduto" name="ValorProduto" placeholder="Valor do Produto" required>
                <label for="ValorProduto">Valor do Produto</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="Ingredientes" name="Ingredientes" placeholder="Ingredientes do Produto" required>
                <label for="Ingredientes">Ingredientes do Produto</label>
            </div>
            <div class="form-floating mb-3">
                <!--label for="Cardapio" name="Cardapio" >Número do Cardápio</label-->
                <select id="Cardapio" name="Cardapio" class="form-control"  >
                    <option>Selecione um Cardápio</option>
                </select>
            </div>
        </form>

        <div class="btns d-flex justify-content-between mt-4">
            <button class="btn-cadastrar btn" type="button" onclick="validarCadastroProduto()">Cadastrar</button>
        </div>
    </div>

    <script src="Products.js"></script>
    <iframe src="../Footer/footer.html" width="100%" height="100"></iframe>
</body> 

</html>