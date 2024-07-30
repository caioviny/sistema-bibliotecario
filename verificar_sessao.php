<?php
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION["usuario_id"])) {
    header("Location: telaLogin.php"); //tem que redirecionar pra tela de login
    exit();
}

// Verifica se o usuário é um bibliotecário
$sql = "SELECT tipo FROM usuarios WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $_SESSION["usuario_id"]);
$stmt->execute();
$resultado = $stmt->get_result();
$row = $resultado->fetch_assoc();

if ($row["tipo"] !== "bibliotecario") {
    header("Location: telaLogin.php"); //tem que redirecionar pra tela de login
    exit();
}
?>
