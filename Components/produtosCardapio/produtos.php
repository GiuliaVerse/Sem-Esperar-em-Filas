<?php
    $tipoPagina = 'cliente';
	require('../../valida_sessao.php');
include $_SERVER['DOCUMENT_ROOT'].'/Sem-Esperar-em-Filas/db_connection.php';
include $_SERVER['DOCUMENT_ROOT'].'/Sem-Esperar-em-Filas/Components/nav/nav.php';

// Obtém o ID do cardápio da URL
$cardapio_id = isset($_GET['cardapio_id']) ? (int)$_GET['cardapio_id'] : 0;

// Verifica se um ID válido foi passado
if ($cardapio_id > 0) {
    // Consulta para buscar os produtos do cardápio
    $sql = "SELECT * FROM produtos WHERE cardapio_codigo_cardapio = $cardapio_id";
    $result = $conn->query($sql);

    // Verifica se encontrou algum resultado
    if ($result && $result->num_rows > 0) {
        $produtos = [];
        while ($row = $result->fetch_assoc()) {
            $produtos[] = [
                'nome_produto' => htmlspecialchars($row['nome_produto'], ENT_QUOTES, 'UTF-8'),
                'valor_produto' => number_format((float)$row['valor_produto'], 2, ',', '.'),
                'tempo_preparo' => htmlspecialchars($row['tempo_preparo'], ENT_QUOTES, 'UTF-8'),
                'promocao' => $row['promocao'] ? number_format((float)$row['promocao'], 2, ',', '.') : null,
                'ingredientes' => htmlspecialchars($row['ingredientes'], ENT_QUOTES, 'UTF-8')
            ];
        }
    } else {
        $erro = "Nenhum produto encontrado para este cardápio.";
    }
} else {
    $erro = "Cardápio não encontrado.";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="produtos.css">
    <title>Produtos | Cardápio</title>
</head>
<body>
    <section class="produtos" id="produtos">
        <div class="heading">
            <h3>Produtos do Cardápio</h3>
        </div>

        <div class="produtos-list">
            <?php if (isset($erro)): ?>
                <p class="erro-msg"><?php echo $erro; ?></p>
            <?php else: ?>
                <?php foreach ($produtos as $produto): ?>
                    <div class="produto-item">
                        <p class="produto-nome"><?php echo $produto['nome_produto']; ?></p>
                        <p class="produto-valor">Preço: R$ <?php echo $produto['valor_produto']; ?></p>
                        <p class="produto-tempo">Tempo de Preparo: <?php echo $produto['tempo_preparo']; ?> minutos</p>
                        <?php if ($produto['promocao']): ?>
                            <p class="produto-promocao">Promoção: R$ <?php echo $produto['promocao']; ?></p>
                        <?php endif; ?>
                        <p class="produto-ingredientes">Ingredientes: <?php echo $produto['ingredientes']; ?></p>
                        <div class="add-card-btn">
                            <button class="add-to-cart" 
                                    data-product="<?php echo $produto['nome_produto']; ?>" 
                                    data-price="<?php echo $produto['valor_produto']; ?>"
                                    data-tempo="<?php echo $produto['tempo_preparo']; ?>">
                                Adicionar ao carrinho
                            </button>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </section>

    <!-- Link para o arquivo JavaScript -->
    <script src="produtos.js"></script>
</body>
</html>

