<!DOCTYPE html>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
<html>

<head>
    <title>Cadastro de Livros</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<style>
    body {
        font-family: "Lato", sans-serif;
        background-color: #717E8B;
        margin: 0;
        padding: 0;
    }

    .sidebar {
        height: 100%;
        width: 0;
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
        font-size: 25px;
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

    .sidebar .closebtn {
        position: absolute;
        top: 0;
        right: 25px;
        font-size: 36px;
        margin-left: 50px;
    }

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

    #main {
        transition: margin-left .5s;
        padding: 20px;
    }

    .content h1 {
        color: white;
        justify-content: center;
        align-items: center;
        text-align: center;
        margin-bottom: 1px;
    }

    .cadastro_livros {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    .box_cadastro {
        background-color: #fff;
        padding: 30px;
        border-radius: 5px;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        width: 50%;
    }

    .box_cadastro label {
        display: block;
        margin-bottom: 10px;
    }

    .box_cadastro input[type="text"],
    .box_cadastro input[type="date"],
    .box_cadastro input[type="file"],
    .box_cadastro input[type="number"] {
        width: 100%;
        padding: 8px;
        margin-bottom: 20px;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-sizing: border-box;
    }

    .box_cadastro button[type="submit"] {
        background-color: #4CAF50;
        color: #fff;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .box_cadastro button[type="submit"]:hover {
        background-color: #3e8e41;
    }

    .title_users,
    .title_livros,
    .title_admin {
        margin-left: 34px;
        color: white;
    }
</style>

<body>
    <div id="mySidebar" class="sidebar">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
        <li class="profile" alt="Foto de perfil do usuário"><a href="#"><img src="profile_usuario.png" alt="" width="30%"></a></li>
        <h3 class="title_admin">Admin</h3>
        <li><a href="painel_controle.php">Painel de Controle</a></li>
        <h3 class="title_users">Usuários</h3>
        <li><a href="cadastro_users.html">Cadastro Usuário</a></li>
        <li><a href="#">Verificar Usuários</a></li>
        <h3 class="title_livros">Livros</h3>
        <li><a href="cadastro_livros.php">Cadastro de livros</a></li>
        <li><a href="registrar_emprestimo.php">Empréstimo</a></li>
        <li><a href="verificar_emprestimo.php">Verificar empréstimo</a></li>
        <li><a href="#">Devolução</a></li>
    </div>

    <div id="main">
        <!-- Ação de abrir o Menu/Nav -->
        <button class="openbtn" onclick="openNav()">☰</button>
        <div class="content">
            <!-- Title -->
            <h1>Cadastro de Livros</h1>
            <!-- Parte com os Inputs -->
            <div class="cadastro_livros">
                <div class="box_cadastro">
                    <form action="inserir_livros.php?pasta=../pasta/das/imagens/" method="post" enctype="multipart/form-data">
                        <label for="titulo">Título:</label>
                        <input type="text" id="titulo" name="titulo" required><br>
                        <label for="autor">Autor:</label>
                        <input type="text" id="autor" name="autor" required><br>
                        <label for="editora">Editora:</label>
                        <input type="text" id="editora" name="editora"><br>
                        <label for="ano">Ano de Publicação:</label>
                        <input type="number" id="ano" name="ano"><br>
                        <label for="isbn">ISBN:</label>
                        <input type="text" id="isbn" name="isbn"><br>
                        <label for="quantidade">Quantidade:</label>
                        <input type="number" id="quantidade" name="quantidade" required><br>
                        <label for="capa">Capa:</label>
                        <input type="file" id="capa" name="capa" accept="image/*"><br>
                        <button type="submit">Cadastrar Livro</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        //Função para abrir e fechar siderBar/Menu
        function openNav() {
            // Ao apertar em abrir as div pelo id do html - muda o tamanho da proporção p/ o menu
            document.getElementById("mySidebar").style.width = "250px";
            document.getElementById("main").style.marginLeft = "250px";
        }

        function closeNav() {
            // Muda a mesma proporção p/ '0'
            document.getElementById("mySidebar").style.width = "0";
            document.getElementById("main").style.marginLeft = "0";
        }
    </script>
</body>

</html>