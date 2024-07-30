<?php
require_once 'config.php';

session_start();

if (!isset($_SESSION["Usuários"])) {
    header("Location: login.php"); // Redirecionar para a página de login se o usuário não estiver logado
    exit;
}

if (!isset($_GET['livro_id']) || !is_numeric($_GET['livro_id'])) {
    header("Location: devolucao_livro.php");
    exit;
}

$livro_id = $_GET['livro_id'];
$usuario_id = $_SESSION["usuarios"]["id"];

$data_devolucao = date("Y-m-d H:i:s");

// Atualiza a tabela Emprestimo com a data de devolução
$sql = "UPDATE emprestimo SET data_devolucao = ? WHERE livro_id = ? AND usuario_id = ? AND data_devolucao IS NULL";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sii", $data_devolucao, $livro_id, $usuario_id);

if ($stmt->execute()) {
    echo "<p>Livro devolvido com sucesso!</p>";
} else {
    echo "<p>Erro ao devolver o livro. Por favor, tente novamente mais tarde.</p>";
}

$stmt->close();
$conn->close();

// Redireciona de volta para a página de devolução após alguns segundos
header("Refresh: 3; URL=devolucao_livro.php");
exit;
?>
