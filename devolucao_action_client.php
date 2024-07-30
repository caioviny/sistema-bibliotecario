<?php
require_once 'config.php';

if (isset($_POST['livro_id']) && is_numeric($_POST['livro_id']) && isset($id_usuario) && is_numeric($id_usuario)) {
    $livro_id = $_POST['livro_id'];
    $id_usuario = $id_usuario;

    $stmt = $conn->prepare("UPDATE emprestimo SET data_devolucao = NOW() WHERE livro_id = ? AND usuario_id = ? AND data_devolucao IS NULL");
    $stmt->bind_param("ii", $livro_id, $id_usuario);

    $stmt->execute();

    header("Location: devolucao_cliente.php");
    exit;
} else {
    echo "Erro: Parâmetros inválidos.";
}
?>
