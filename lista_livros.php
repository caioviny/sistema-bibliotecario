<?php
// Arquivo de configuração do banco de dados
include_once 'config.php';

// Cria o diretório de imagens caso ele não exista
if (!file_exists('imagens')) {
    mkdir('imagens', 0777, true);
}

// Consulta para selecionar todos os livros
$sql = "SELECT id, titulo, autor, editora, ano, isbn, quantidade, capa FROM Livros";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();

// Verifica se a consulta retornou algum resultado
if ($result->num_rows > 0) {
    // Exibe os resultados em uma tabela HTML
    echo "<table>";
    echo "<tr>";
    echo "<th>ID</th>";
    echo "<th>Título</th>";
    echo "<th>Autor</th>";
    echo "<th>Editora</th>";
    echo "<th>Ano</th>";
    echo "<th>ISBN</th>";
    echo "<th>Quantidade</th>";
    echo "<th>Capa</th>";
    echo "</tr>";

    // Exibe os dados dos livros
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["id"] . "</td>";
        echo "<td>" . $row["titulo"] . "</td>";
        echo "<td>" . $row["autor"] . "</td>";
        echo "<td>" . $row["editora"] . "</td>";
        echo "<td>" . $row["ano"] . "</td>";
        echo "<td>" . $row["isbn"] . "</td>";
        echo "<td>" . $row["quantidade"] . "</td>";
        if (!empty($row['capa'])) {
            echo '<td><img src="imagens/' . $row['capa'] . '" alt="Capa do livro"></td>';
        } else {
            echo '<td>Sem capa</td>';
        }
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "Nenhum livro cadastrado.";
}

// Fecha a conexão
$conn->close();
?>
