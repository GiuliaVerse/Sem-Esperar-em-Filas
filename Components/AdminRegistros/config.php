<?php
$host = "localhost"; // Host onde o banco de dados está rodando (geralmente localhost)
$usuario = "root"; // Nome de usuário do banco de dados MySQL
$senha_banco = ""; // Senha do banco de dados MySQL (vazio se não houver senha)
$banco = "projeto"; // Nome do banco de dados MySQL

// Conexão com o banco de dados MySQL
$conn = new mysqli($host, $usuario, $senha_banco, $banco); 

?>