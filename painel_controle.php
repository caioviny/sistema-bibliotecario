<!DOCTYPE html>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
<html>

<head>
    <title>Painel Controle</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<style>
    body {
        font-family: "Lato", sans-serif;
        background-color: #717E8B;
        margin: 0;
        padding: 0;
    }

    /* ----------- Siderbar/Menu ------------*/
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

    /* ----------- Fechar Siderbar/Menu ------------*/
    .sidebar .closebtn {
        position: absolute;
        top: 0;
        right: 25px;
        font-size: 36px;
        margin-left: 50px;
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
    }

    .content form {
        display: flex;
        margin-top: 20px;
    }

    /* ----------- Input da pesquisa ------------*/
    .content input[type="text"] {
        margin-top: 15px;
        flex-grow: 1;
        padding: 10px;
        border: none;
        border-radius: 5px 0 0 5px;
        box-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);
        margin-left: 40px;
        outline: none;
    }

    .content button[type="submit"] {
        margin-top: 15px;
        padding: 20px 20px;
        background-color: #333;
        color: white;
        border: none;
        border-radius: 0 5px 5px 0;
        cursor: pointer;
    }

    .content button[type="submit"]:hover {
        background-color: #555;
    }

    /* ----------- Título H1 ------------*/
    .content h1 {
        color: white;
        margin-top: 23px;
    }

    .livros_tabela {
        background-color: #fff;
        border-radius: 15px;
        padding: 20px;
        margin-top: 20px;
        width: 100%;
        box-shadow: 0px 0px 40px 16px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease-out;
    }

    .livros_tabela table {
        width: 100%;
        border-collapse: collapse;
    }

    .livros_tabela th,
    .livros_tabela td {
        padding: 15px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    .livros_tabela th {
        background-color: #f2f2f2;
        font-size: 18px;
    }

    .livros_tabela tr:hover {
        background-color: #f5f5f5;
    }

    .content h1,
    .content .box_livros {
        margin-left: 40px;
    }

    .title_users,
    .title_livros,
    .title_admin {
        margin-left: 34px;
        color: white;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    th,
    td {
        padding: 15px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    th {
        background-color: #f2f2f2;
        font-size: 18px;
    }

    tr:hover {
        background-color: #f5f5f5;
    }
</style>

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
        <div class="content">
            <form>
                <input type="text" placeholder="Pesquisar por Livros/Autores...">
                <button type="submit">Pesquisar</button>
            </form>

            <h1>LIVROS</h1>

            <div class="box_livros">
                <?php include 'lista_livros.php'; ?>
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