<?php
$servername = "localhost"; // 
$username = "root"; // 
$password = ""; // 
$dbname = "projeto"; // nome do banco

// Cria a conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica a conexão
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['query'])) {
    $query = $_GET['query'];
    $sql = "SELECT name FROM restaurants WHERE name LIKE '%$query%'";
    $result = $conn->query($sql);

    $restaurants = array();
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $restaurants[] = $row;
        }
    }
    echo json_encode($restaurants);
}

$conn->close();
?>