<?php

include $_SERVER['DOCUMENT_ROOT'].'/Sem-Esperar-em-Filas/db_connection.php';

// Consulta para buscar os IDs e nomes dos restaurantes
$sql = "SELECT codigo_restaurante, nome_fantasia FROM restaurante"; // Altere aqui para selecionar o ID
$result = $conn->query($sql);

$restaurantes = [];
if ($result->num_rows > 0) {
    // Armazena os resultados em um array associativo
    while ($row = $result->fetch_assoc()) {
        $restaurantes[] = [
            'id' => (int)$row['codigo_restaurante'], // Adiciona o ID
            'nome' => htmlspecialchars($row['nome_fantasia'], ENT_QUOTES, 'UTF-8')
        ];
    }
}

// Fechar a conexão
$conn->close();

// Retorna os restaurantes
return $restaurantes;
