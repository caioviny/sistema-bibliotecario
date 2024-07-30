<?php
require_once 'config.php';
session_start();

// Verifica se o usuário é um bibliotecário; se for, redireciona para o dashboard
if (isset($_SESSION["usuario"]) && $_SESSION["usuario"]["tipo"] === "bibliotecario") {
    header("Location: dashboard.php");
    exit();
}

// Consulta para buscar livros disponíveis (não emprestados)
$sql = "SELECT l.id, l.titulo, l.autor, l.editora, l.ano, l.isbn
        FROM Livros l
        LEFT JOIN Emprestimo e ON l.id = e.livro_id AND e.data_devolucao IS NULL
        WHERE e.livro_id IS NULL AND l.Estoque = true";

$resultado = $conn->query($sql);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Painel do Cliente - Biblioteca</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }

        /* ----------- Siderbar/Menu ------------*/
        .sidebar {
            height: 100%;
            width: 250px;
            position: fixed;
            z-index: 1;
            top: 0;
            left: 0;
            background-color: #212325;
            overflow-x: hidden;
            transition: 0.5s;
            padding-top: 60px;
        }

        .sidebar a {
            padding: 8px 8px 8px 32px;
            text-decoration: none;
            font-size: 20px;
            color: #818181;
            display: block;
            transition: 0.3s;
        }

        .sidebar li {
            list-style: none;
            color: white;
            margin-bottom: 5px;
        }

        .sidebar a:hover {
            background-color: #2c2c2c;
            color: #f1f1f1;
        }

        /* ----------- Fechar Siderbar/Menu ------------*/
        .sidebar .closebtn {
            position: absolute;
            top: 0;
            right: 25px;
            font-size: 36px;
            margin-left: 50px;
            color: white;
        }

        /* ----------- Abrir Siderbar/Menu ------------*/
        .openbtn {
            font-size: 20px;
            cursor: pointer;
            background-color: #111;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 10px;
            margin-left: 40px;
        }

        .openbtn:hover {
            background-color: #444;
        }

        /* ----------- MAIN DO SITE ------------*/
        #main {
            transition: margin-left .5s;
            padding: 20px;
            margin-left: 250px;
        }

        .navbar-brand {
            font-weight: bold;
        }

        .container {
            padding-top: 2rem;
        }

        h2 {
            color: #333;
        }

        table.table {
            background-color: #fff;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
            margin-top: 1rem;
        }

        table.table th {
            background-color: #007bff;
            color: #fff;
            font-weight: bold;
        }

        table.table td,
        table.table th {
            vertical-align: middle;
        }

        table.table td a.btn-primary {
            background-color: #28a745;
            color: #fff;
            border: none;
        }

        table.table td a.btn-primary:hover {
            background-color: #218838;
        }

        .title_user{
            margin-left: 34px;
            color: white;
        }
    </style>

    <head>
        <title>Painel do Cliente - Biblioteca</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    </head>

<body>
    <div id="mySidebar" class="sidebar">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
        <li class="profile"><a href="#"><img src="profile_usuario.png" alt="" width="30%"></a></li>
        <h3 class="title_user">Cliente</h3>
        <li><a href="painel_cliente.php">Painel de Cliente</a></li>
        <li><a href="devolucao_cliente.php">Devolução</a></li>

    </div>

    <div id="main">

        <button class="openbtn" onclick="openNav()">☰</button>
        <div class="content">
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
            </nav>
            <div class="container">
                <h2>Livros Disponíveis para Empréstimo</h2>
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Título</th>
                            <th>Autor</th>
                            <th>Editora</th>
                            <th>Ano de Publicação</th>
                            <th>ISBN</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($livro = $resultado->fetch_assoc()) { ?>
                            <tr>
                                <td><?php echo $livro['id']; ?></td>
                                <td><?php echo $livro['titulo']; ?></td>
                                <td><?php echo $livro['autor']; ?></td>
                                <td><?php echo $livro['editora']; ?></td>
                                <td><?php echo $livro['ano']; ?></td>
                                <td><?php echo $livro['isbn']; ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
        function openNav() {
            document.getElementById("mySidebar").style.width = "250px";
            document.getElementById("main").style.marginLeft = "250px";
        }

        function closeNav() {
            document.getElementById("mySidebar").style.width = "0";
            document.getElementById("main").style.marginLeft = "0";
        }
    </script>
</body>
</html>