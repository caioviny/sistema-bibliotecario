
<?php
function obter_todos_usuarios() {
    $host = "localhost";
    $user = "Admin";
    $password = "12345";
    $dbname = "Biblioteca";

    $conn = mysqli_connect($host, $user, $password);
    mysqli_select_db($conn, $dbname);

    $sql = "SELECT id, nome, email, senha, tipo, foto FROM usuarios";
    $resultado = mysqli_query($conn, $sql);

    $usuarios = array();

    while ($linha = mysqli_fetch_assoc($resultado)) {
        $linha['foto'] = base64_encode($linha['foto']);
        $usuarios[] = $linha;
    }
    

    mysqli_close($conn);

    return $usuarios;
}

?>


<!DOCTYPE html>
<meta charset="UTF-8">

<html>

<head>
    <title>Collapsible Sidebar</title>
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
        margin-bottom: 20px;
    }

    .title_users,
    .title_livros,
    .title_admin {
        margin-left: 34px;
        color: white;
        cursor: pointer;
    }

    .title_users ul,
    .title_livros ul,
    .title_admin ul {
        display: none;
    }

    .title_users.active ul,
    .title_livros.active ul,
    .title_admin.active ul {
        display: block;
        position: absolute;
        top: 40px;
        left: 40px;
        width: 200px;
        background-color: #fff;
        box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.2);
        transition: all 0.3s ease-in-out;
    }

    .title_users li,
    .title_livros li,
    .title_admin li {
        padding: 10px;
    }

    .title_users li:hover,
    .title_livros li:hover,
    .title_admin li:hover {
        background-color: #f2f2f2;
    }


    .box_usuario {
        width: 100%;
        max-width: 500px;
        margin: 0 auto;
        padding: 20px;
        background-color: #fff;
        border-radius: 4px;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    }

    .form-group {
        margin-bottom: 1rem;
    }

    label {
        display: block;
        font-weight: bold;
        margin-bottom: 0.5rem;
    }

    input[type="text"],
    input[type="email"],
    input[type="password"],
    select {
        width: 100%;
        padding: 0.5rem;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
    }

    input[type="file"] {
        width: 100%;
        padding: 0.5rem;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
        margin-top: 1rem;
    }

    button[type="submit"] {
        width: 100%;
        padding: 0.5rem;
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    button[type="submit"]:hover {
        background-color: #0062cc;
    }

    table {
  width: 100%;
  border-collapse: collapse;
  margin-top: 20px;
}

th, td {
  padding: 12px;
  text-align: left;
  border: 1px solid #ddd;
  background-color: #f2f2f2; /* cor de fundo aplicada a todas as linhas */
}

th {
  color: #333;
}

tr:hover {
  background-color: #ddd;
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
<h1>Verificação de Usuário</h1>
<?php
$usuarios = obter_todos_usuarios();
if (count($usuarios) > 0) {
    echo "<table border='1'>";
    echo "<tr><th>ID</th><th>Nome</th><th>Email</th><th>Senha</th><th>Tipo</th><th>Foto</th></tr>";
    foreach ($usuarios as $usuario) {
        echo "<tr>";
        echo "<td>" . $usuario['id'] . "</td>";
        echo "<td>" . $usuario['nome'] . "</td>";
        echo "<td>" . $usuario['email'] . "</td>";
        echo "<td>" . $usuario['senha'] . "</td>";
        echo "<td>" . $usuario['tipo'] . "</td>";
        echo "<td><img src='data:image/" . ";base64," . $usuario['foto'] . "' width='100' height='100'></td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "Nenhum usuário encontrado.";
}

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
