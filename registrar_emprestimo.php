<?php include 'conexao.php' ?>

<!DOCTYPE html>
<html>

<head>
    <title>Registrar Empréstimo - Biblioteca</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
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

        /* ----------- CONTAINER ------------*/
        .container {
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 30px;
            margin-top: 50px;
        }

        /* ----------- FORM ------------*/
        .form-group {
            margin-bottom: 20px;
        }

        label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }

        select,
        input[type="date"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        button[type="submit"] {
            background-color: #212325;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button[type="submit"]:hover {
            background-color: #333;
        }

        /* Estilo do container */
        .container {
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            padding: 30px;
            max-width: 600px;
            margin: 0 auto;
        }

        /* Estilo do título */
        h2 {
            text-align: center;
            margin-bottom: 30px;
        }

        /* Estilo dos inputs e selects */
        .form-control {
            border-radius: 5px;
            border: 1px solid #ccc;
            padding: 10px;
            font-size: 16px;
            margin-bottom: 20px;
        }

        /* Estilo do botão */
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            border-radius: 5px;
            color: #fff;
            font-size: 16px;
            padding: 10px 20px;
            transition: background-color 0.3s;
        }

        .btn-primary:hover {
            background-color: #0069d9;
            border-color: #0062cc;
        }

        .centralizar_box {
            margin-top: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
        }
    </style>
</head>

<body>

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
        <div class="centralizar_box">
            <div class="content">
                <div class="container">
                    <h2>Registrar Empréstimo</h2>
                    <form action="processar_emprestimo.php" method="post">
                        <div class="form-group">
                            <label for="usuario_id">Usuário:</label>
                            <select class="form-control" id="usuario_id" name="usuario_id" required>
                                <?php
                                $sql = "SELECT id, nome FROM usuarios";
                                $resultado = $conn->query($sql);
                                while ($row = $resultado->fetch_assoc()) {
                                    echo "<option value='" . $row["id"] . "'>" . $row["nome"] . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="livro_id">Livro:</label>
                            <select class="form-control" id="livro_id" name="livro_id[]" multiple required>
                                <?php
                                $sql = "SELECT id, titulo FROM livros";
                                $resultado = $conn->query($sql);
                                while ($row = $resultado->fetch_assoc()) {
                                    echo "<option value='" . $row["id"] . "'>" . $row["titulo"] . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="data_emprestimo">Data de Empréstimo:</label>
                            <input type="date" class="form-control" id="data_emprestimo" name="data_emprestimo" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Registrar</button>
                    </form>
                </div>
            </div>
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