<?php
$servername = "localhost";
$username = "Admin";
$password = "12345";
$dbname = "Biblioteca";

// Cria a conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica a conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}
?>
