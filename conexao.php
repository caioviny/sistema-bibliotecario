<?php
//Conexão com o banco de dados - Passando as referencias via var's
$servername = "localhost";
$username = "Admin";
$password = "12345";
$dbname = "Biblioteca";
// Conecta por meio das var's ao server mysqli
$conn = new mysqli($servername, $username, $password, $dbname);
// Condicional se a conexão falhar [tratamento de erro]
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
