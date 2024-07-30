<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Empréstimo realizado com Sucesso!</title>
</head>

<body>
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

        .mensagem-sucesso {
            margin-top: 20px;
            display: flex;
            justify-content: center;
            text-align: center;
            background-color: #d4edda;
            border-color: #c3e6cb;
            color: #155724;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        .mensagem-erro {
            margin-top: 20px;
            display: flex;
            justify-content: center;
            text-align: center;
            background-color: #f8d7da;
            border-color: #f5c6cb;
            color: #721c24;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
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
        <div class="content">
            <?php
            require_once 'conexao.php';

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // Verifica se o parâmetro usuario_id foi enviado e se é um número inteiro
                if (!isset($_POST["usuario_id"]) || !is_numeric($_POST["usuario_id"])) {
                    echo "Erro: Parâmetro usuário inválido.";
                    exit();
                }

                $usuario_id = $_POST["usuario_id"];

                // Verifica se o parâmetro livro_id foi enviado e se é um array
                if (!isset($_POST["livro_id"]) || !is_array($_POST["livro_id"])) {
                    echo "Erro: Parâmetro livro inválido.";
                    exit();
                }

                $livros_ids = $_POST["livro_id"];

                // Verifica se todos os IDs dos livros são números inteiros
                if (!array_filter($livros_ids, 'is_numeric')) {
                    echo "Erro: Parâmetro livro inválido.";
                    exit();
                }

                $data_emprestimo = $_POST["data_emprestimo"];

                // Verifica se o número de livros selecionados não excede o limite de 3
                if (count($livros_ids) > 3) {
                    echo "Erro: Não é permitido emprestar mais de 3 livros por usuário por empréstimo.";
                    exit();
                }

                // Inicia uma transação para garantir que todos os empréstimos sejam registrados atomicamente
                $conn->begin_transaction();

                try {
                    foreach ($livros_ids as $livro_id) {
                        $sql = "INSERT INTO emprestimo (usuario_id, livro_id, data_emprestimo) VALUES (?, ?, ?)";
                        $stmt = $conn->prepare($sql);
                        $stmt->bind_param("iis", $usuario_id, $livro_id, $data_emprestimo);
                        $stmt->execute();
                    }

                    // Se tudo estiver correto, commita a transação
                    $conn->commit();
                    echo '<div class="mensagem-sucesso">Empréstimo registrado com sucesso.</div>';
                } catch (Exception $e) {
                    // Se ocorrer algum erro, faz rollback
                    $conn->rollback();
                    echo '<div class="mensagem-erro">Erro ao registrar o empréstimo: ' . $e->getMessage() . '</div>';
                }
            } else {
                echo "Método de requisição inválido.";
            }

            $conn->close();
            ?>
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