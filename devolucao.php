<?php
require_once 'config.php';

session_start();

if (!isset($_SESSION["usuario"])) {
    header("Location: login.php"); // Redirecionar para a página de login se o usuário não estiver logado
    exit;
}

$usuario_id = $_SESSION["usuario"]["id"];

$sql = "SELECT e.id, e.data_emprestimo, l.titulo
        FROM emprestimo e
        JOIN livros l ON e.livro_id = l.id
        WHERE e.usuario_id = ? AND e.data_devolucao IS NULL";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $usuario_id);
$stmt->execute();
$resultado = $stmt->get_result();

$conn->close();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Devolução de Livros</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <h1>Devolução de Livros</h1>
    <?php if ($resultado->num_rows > 0): ?>
        <table>
            <thead>
                <tr>
                    <th>Título</th>
                    <th>Data de Empréstimo</th>
                    <th>Ação</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($linha = $resultado->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $linha["titulo"]; ?></td>
                        <td><?php echo $linha["data_emprestimo"]; ?></td>
                        <td>
                            <a href="devolver_livro.php?emprestimo_id=<?php echo $linha["id"]; ?>">
                                Devolver
                            </a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Não há livros para devolver no momento.</p>
    <?php endif; ?>
</body>
</html>
