<?php
include 'config.php';

function inserir_usuario($nome, $email, $senha, $tipo, $foto, $tipo_foto) {
    global $conn;

    $stmt = mysqli_prepare($conn, "INSERT INTO usuarios (nome, email, senha, tipo, foto, tipo_foto) VALUES (?, ?, ?, ?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "sssssb", $nome, $email, $senha, $tipo, $foto, $tipo_foto);

    $result = mysqli_stmt_execute($stmt);

    mysqli_stmt_close($stmt);

    return $result;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $tipo = $_POST['tipo'];

    $foto = file_get_contents($_FILES['foto']['tmp_name']);
    $tipo_foto = $_FILES['foto']['type'];

    if (inserir_usuario($nome, $email, $senha, $tipo, $foto, $tipo_foto)) {
        echo "<script>
        alert('Usuário inserido com sucesso!');
        setTimeout(function() {
            window.location.href = 'cadastro_users.html';
        }, 1);
      </script>";
        exit();
    } else {
        echo "<script>
        alert('Erro ao inserir usuário!');
        setTimeout(function() {
            window.location.href = 'cadastro_users.html';
        }, 1);
      </script>";
    }
}

mysqli_close($conn);
?>
