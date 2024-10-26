<?php
    $tipoPagina = 'restaurante';
	require('../../valida_sessao.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Cardápios</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="cardapio.css">
</head>

<header>
    <iframe src="../../Components/nav/nav.php" width="100%" height="100"></iframe>
</header>

<body>
    <div class="container">
        <h2>Cadastro de Cardápios</h2>
        <form id="cardapioRegistrationForm">
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="nomeCardapio" name="nomeCardapio" placeholder="Nome do Cardápio" required>
                <label for="nomeCardapio">Nome do Cardápio</label>
            </div>
            <div class="form-floating mb-3">
                <select id="categoria" name="categoria" class="form-control">
                    <option value="categoria">Categoria:</option>
                    <option value="pratos">Pratos</option>
                    <option value="lanches">Lanches</option>
                    <option value="bebidas">Bebidas</option>
                    <option value="doces">Doces</option>
                    <option value="cafe">Café</option>
                </select>                
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="descricao" name="descricao" placeholder="Descrição do Cardápio" required>
                <label for="descricao">Descrição</label>
            </div>
            <div class="form-floating mb-3">
                <input type="file" name="image" id="file" accept="image/*">
                <br><br>
            </div>
        </form>

        <div class="btns d-flex justify-content-between mt-4">
            <button class="btn-cadastrar btn" type="button" onclick="validarCadastroCardapio()">Cadastrar</button>
        </div>
    </div>

    <script src="cardapio.js"></script>
    <iframe src="../Footer/footer.html" width="100%" height="100"></iframe>
</body> 

</html>