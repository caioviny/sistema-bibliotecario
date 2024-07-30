<?php
require_once 'config.php';
session_start();

// Marcar empréstimo como devolvido
if (isset($_POST['devolver']) && isset($_POST['emprestimo_id'])) {
    $emprestimo_id = $_POST['emprestimo_id'];
    $data_devolucao = date('Y-m-d');

    $sql = "UPDATE emprestimo SET data_devolucao = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $data_devolucao, $emprestimo_id);
    $stmt->execute();
}

// Consulta para buscar todos os empréstimos
$sql = "SELECT e.id, u.nome AS usuario, l.titulo AS livro, e.data_emprestimo FROM emprestimo e JOIN usuarios u ON e.usuario_id = u.id JOIN livros l ON e.livro_id = l.id WHERE e.data_devolucao IS NULL";
$resultado = $conn->query($sql);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Verificar Empréstimos - Biblioteca</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <style>

        .container h2{
            margin-top: 30px;
        }
        body {
            font-family: "Lato", sans-serif;
            background-color: #f3f3f3;
            margin: 0;
            padding: 0;
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

        .content form {
            display: flex;
            margin-top: 20px;
        }

        .title_users,
        .title_livros,
        .title_admin {
            margin-left: 34px;
            color: white;
        }
    </style>

    <div id="mySidebar" class="sidebar">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
        <li class="profile"><a href="#"><img src="profile_usuario.png" alt="" width="30%"></a></li>
        <h3 class="title_admin">Admin</h3>
        <li><a href="painel_controle.php">Painel de Controle</a></li>
        <h3 class="title_users">Usuários</h3>
        <li><a href="cadastro_users.html">Cadastro Usuário</a></li>
        <li><a href="verUsuario.php">Verificar Usuários</a></li>
        <h3 class="title_livros">Livros</h3>
        <li><a href="cadastro_livros.php">Cadastro de livros</a></li>
        <li><a href="registrar_emprestimo.php">Empréstimo</a></li>
        <li><a href="verificar_emprestimo.php">Verificar empréstimo</a></li>
        <li><a href="devolucao_livro.php">Devolução</a></li>
    </div>

    <div id="main">

        <button class="openbtn" onclick="openNav()">☰</button>
        <div class="content"></div>
        <div class="container">
            <h2>Empréstimos Ativos</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Usuário</th>
                        <th>Livro</th>
                        <th>Data de Empréstimo</th>
                        <th>Ação</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($emprestimo = $resultado->fetch_assoc()) { ?>
                        <tr>
                            <td><?php echo $emprestimo['id']; ?></td>
                            <td><?php echo $emprestimo['usuario']; ?></td>
                            <td><?php echo $emprestimo['livro']; ?></td>
                            <td><?php echo $emprestimo['data_emprestimo']; ?></td>
                            <td>
                                <form method="post">
                                    <input type="hidden" name="emprestimo_id" value="<?php echo $emprestimo['id']; ?>">
                                    <button type="submit" name="devolver" class="btn btn-warning">Marcar como Devolvido</button>
                                </form>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    <script>
        //Função para abrir e fechar siderBar/Menu
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