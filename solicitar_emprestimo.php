<?php
require_once 'config.php';
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION["usuario"])) {
    header("Location: painel_cliente.php");
    exit();
}

// Verifica se o ID do livro foi passado
if (!isset($_GET["livro_id"])) {
    echo "Erro: ID do livro não fornecido.";
    exit();
}

$livro_id = $_GET["livro_id"];
$usuario_id = $_SESSION["usuario"]["id"]; // Supõe-se que o ID do usuário esteja armazenado na sessão
$data_emprestimo = date("Y-m-d"); // Data atual

// Insere o empréstimo no banco de dados
$sql = "INSERT INTO emprestimo (usuario_id, livro_id, data_emprestimo) VALUES (?, ?, ?)";
$stmt = $conexao->prepare($sql);
$stmt->bind_param("iis", $usuario_id, $livro_id, $data_emprestimo);

if ($stmt->execute()) {
    echo "Empréstimo registrado com sucesso.";
} else {
    echo "Erro ao registrar o empréstimo: " . $stmt->error;
}

$stmt->close();
$conexao->close();
?>