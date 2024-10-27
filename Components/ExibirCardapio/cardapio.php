<?php
include $_SERVER['DOCUMENT_ROOT'].'/Sem-Esperar-em-Filas/db_connection.php';
include $_SERVER['DOCUMENT_ROOT'].'/Sem-Esperar-em-Filas/Components/nav/nav.php';
// Obtenha o ID do restaurante da URL
$restaurante_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Verifica se um ID válido foi passado
if ($restaurante_id > 0) {
    // Consulta para buscar o cardápio do restaurante com o ID especificado
    $sql = "SELECT * FROM cardapio WHERE restaurante_codigo_restaurante = $restaurante_id"; // Ajuste conforme a estrutura da tabela de cardápio
    $result = $conn->query($sql);

    // Verifique se encontrou algum resultado
    if ($result && $result->num_rows > 0) {
        $cardapio = [];
        while ($row = $result->fetch_assoc()) {
            $cardapio[] = [
                'nome_restaurante' => htmlspecialchars($row['nome_cardapio'], ENT_QUOTES, 'UTF-8'), // Certifique-se de que essa coluna existe
                'categoria' => htmlspecialchars($row['categoria'], ENT_QUOTES, 'UTF-8'),
                'descricao' => htmlspecialchars($row['descricao'], ENT_QUOTES, 'UTF-8'),
                'codigo' => htmlspecialchars($row['codigo_cardapio'], ENT_QUOTES, 'UTF-8'),
                // 'preco' => number_format((float)$row['preco'], 2, ',', '.')
            ];
        }
    } else {
        $erro = "Nenhum item de cardápio encontrado para este restaurante.";
    }
} else {
    $erro = "Restaurante não encontrado.";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $cardapio[0]['nome_restaurante']; ?> | Cardápio</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="stylesheet" href="cardapio.css">
</head>
<body>
    <!-- seção de cardápio -->
    <section class="menu" id="menu">

        <div class="heading">
            <h3>Cardápio do Restaurante</h3>
        </div>

        <div class="menu-card">

            <?php if (isset($erro)): ?>
                <p class="erro-msg"><?php echo $erro; ?></p>
            <?php else: ?>
                <?php foreach ($cardapio as $item): ?>
                    <div class="menu-item">
                        <div class="content">
                            <div class="restaurant-info">
                                <p class="restaurant-name"><?php echo $item['nome_restaurante']; ?></p>
                            </div>
                            <p class="item-category"><?php echo $item['categoria']; ?></p>
                            <p class="item-description"><?php echo $item['descricao']; ?></p>
                            <input type="hidden" class="item-code" value="<?php echo $item['codigo'] ?>">
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>

        </div>
        <script src="cardapio.js"></script>
    </section>
    <!-- fim da seção de cardápio -->
    <script src="cardapio.js" ></script>
</body>
</html>
