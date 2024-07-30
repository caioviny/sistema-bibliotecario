<?php
// Chama/Inclui a conexão
include_once 'config.php';

// Pega os inputs que estão no HTML e armazena em var's no bd
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titulo = $_POST["titulo"];
    $autor = $_POST["autor"];
    $editora = $_POST["editora"];
    $ano = $_POST["ano"];
    $isbn = $_POST["isbn"];
    $quantidade = $_POST["quantidade"];

    // Verifica se uma imagem foi enviada
    if ($_FILES["photo"]["error"] === UPLOAD_ERR_OK) {
        $capa = file_get_contents($_FILES["photo"]["tmp_name"]);
    } else {
        $capa = null;
    }

    $estoque = true;

    // Faz um Insert no bd com os valores colocados
    $sql = "INSERT INTO Livros (titulo, autor, editora, ano, isbn, quantidade, capa, Estoque) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssissbi", $titulo, $autor, $editora, $ano, $isbn, $quantidade, $capa, $estoque);

    if ($stmt->execute()) {
        header("Location: formulario.php?sucesso=1");
        exit();
    } else {
        echo "Erro ao cadastrar livro: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
