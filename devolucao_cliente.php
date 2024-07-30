<?php
require_once 'config.php';

session_start();

if (!isset($_SESSION["usuario"])) {
    header("Location: login.php"); // Redirecionar para a página de login se o usuário não estiver logado
    exit;
}

if ($_SESSION["usuario"]["tipo"] === "bibliotecario") {
    header("Location: painel_controle.php");
} else {
    $id_usuario = $_SESSION["usuario"]["id"];

    $stmt = $conn->prepare("SELECT * FROM emprestimo INNER JOIN Livros ON emprestimo.livro_id = Livros.id WHERE emprestimo.usuario_id = ? AND emprestimo.data_devolucao IS NULL");
    $stmt->bind_param("i", $id_usuario);
    $stmt->execute();

    $resultado = $stmt->get_result();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Devolução de Livros</title>
</head>
<body>
<div id="main">
    <button class="openbtn" onclick="openNav()">☰</button>

    <div class="content">
        <nav class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Logout</a>
                </li>
            </ul>
        </nav>

        <div class="container">
            <h2>Livros Disponíveis para Devolução</h2>
            <?php if ($resultado->num_rows > 0): ?>
                <form action="devolucao_action_client.php" method="post">
                    <select name="livro_id">
                        <option value="">Selecione um livro</option>
                        <?php while ($livro = $resultado->fetch_assoc()): ?>
                            <option value="<?= $livro['id'] ?>"><?= $livro['titulo'] ?></option>
                        <?php endwhile; ?>
                    </select>
                    <br><br>
                    <button type="submit">Devolver</button>
                </form>
            <?php else: ?>
                <p>Não há livros disponíveis para devolução no momento.</p>
            <?php endif; ?>
        </div>
    </div>
</div>
</body>
</html>
