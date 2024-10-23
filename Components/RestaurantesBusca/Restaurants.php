<?php
$servername = "localhost"; // 
$username = "root"; // 
$password = ""; // 
$dbname = "projeto"; //

// Cria a conexão
$mysqli = new mysqli($servername, $username, $password, $dbname);
if($mysqli -> connect_error) {
    die("Fala na conexão com o banco de dqados");
}

