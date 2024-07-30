<?php
require_once 'conexao.php';

session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION["usuario"])) {
    header("Location: telaLogin.php");
    exit();
}

$usuario_id = $_SESSION["usuario"]["id"];

// Verifica se o parâmetro livro_id foi enviado e se é um número inteiro
if (!isset($_POST["livro_id"]) || !is_numeric($_POST["livro_id"])) {
    header("Location: devolucao.php");
    exit();
}

$livro_id = $_POST["livro_id"];

// Atualiza a data de devolução do empréstimo
$sql = "UPDATE emprestimo SET data_devolucao = NOW() WHERE usuario_id = ? AND livro_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $usuario_id, $livro_id);
$stmt->execute();

// Atualiza o status do livro como disponível
$sql = "UPDATE livros SET emprestado = false WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $livro_id);
$stmt->execute();

$conn->close();

header("Location: devolucao.php");
exit();
?>
