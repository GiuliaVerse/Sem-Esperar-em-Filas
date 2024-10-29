<?php
include $_SERVER['DOCUMENT_ROOT'].'/Sem-Esperar-em-Filas/db_connection.php';

$restaurantes = [];
$termoPesquisa = isset($_GET['busca']) ? $conn->real_escape_string($_GET['busca']) : '';

// Ajusta a consulta SQL para filtrar pelo termo de pesquisa, se fornecido
if ($termoPesquisa) {
    $sql = "SELECT codigo_restaurante, nome_fantasia FROM restaurante WHERE nome_fantasia LIKE '%$termoPesquisa%'";
} else {
    $sql = "SELECT codigo_restaurante, nome_fantasia FROM restaurante";
}

$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    // Armazena os resultados em um array associativo
    while ($row = $result->fetch_assoc()) {
        $restaurantes[] = [
            'id' => (int)$row['codigo_restaurante'],
            'nome' => htmlspecialchars($row['nome_fantasia'], ENT_QUOTES, 'UTF-8')
        ];
    }
}

// Fechar a conexão
$conn->close();

// Retorna os restaurantes
return $restaurantes;
?>
