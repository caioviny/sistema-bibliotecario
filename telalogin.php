<?php
require_once 'config.php';
session_start();

// Código de login
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT id, nome, tipo FROM usuarios WHERE email = ? AND senha = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $stmt->bind_result($id, $nome, $tipo);

    if ($stmt->fetch()) {
        session_start();
        $_SESSION["loggedin"] = true;
        $_SESSION["id"] = $id;
        $_SESSION["nome"] = $nome;
        
        if ($tipo === "usuario") {
            header("Location: painel_cliente.php");
        } else {
            header("Location: painel_controle.php");
        }
        exit; // Importante: encerra a execução do script após o redirecionamento
    } else {
        echo "<p>Usuário ou senha inválidos.</p>";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteca - Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<style>
    body {
    font-family: "Lato", sans-serif;
    background-color: #717E8B;
    margin: 0;
    padding: 0;
  }
  
  .login-container {
    width: 355px;
    padding: 35px;
    background-color: #212325;
    border-radius: 15px;
    box-shadow: 0 0 30px 15px rgba(168, 182, 202, 0.466);
    margin: 35px auto; /* center the login box */
    margin-bottom: 100px; /* add gap between login box and contact us section */
  }
  
  .login-container h2 {
    color: white;
    text-align: center;
    margin-bottom: 30px;
  }
  
  .login-container label {
    display: block;
    margin-bottom: 10px;
    color: white;
  }
  
  .login-container input[type="text"],
  .login-container input[type="password"] {
    margin-top: 15px;
    padding: 12px 20px;
    border: none;
    border-radius: 5px;
    box-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);
    outline: none;
    background-color: #333;
    color: white;
    width: 85%;
  }
  
  .login-container input[type="submit"] {
    margin-top: 30px;
    padding: 20px 20px;
    background-color: #3c3c3c;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 1.2em;
    width: 95%;
    display: flex;
    align-items: center;
    justify-content: center;
  }
  
  .login-container h2 {
    color: white;
    text-align: center;
    margin-bottom: 30px;
    font-family: 'NomeDaFonteManuscrita', cursive; /* replace 'NomeDaFonteManuscrita' with the name of your desired script font */
    font-size: 2.5em; /* adjust the font size as needed */
  }
  
  .login-container input[type="submit"]:hover {
    background-color: #555;
  }
  
  footer {
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    padding: 20px;
    background-color: #333;
    color: white;
    text-align: center;
    font-size: 1.2em;
    font-family: 'NomeDaFonteManuscrita', cursive;
  }

  .login-container input[type="submit"] {
    /* existing styles */
    display: flex;
    align-items: center;
    justify-content: center;
  }

  .social-media-contact {
    background-color: #333;
    padding: 20px;
    text-align: center;
    margin-top: 30px;
    border-radius: 0 0 5px 5px;
  }
  
  .social-media-contact h3 {
    color: white;
    font-size: 1.5em;
    margin-bottom: 20px;
  }
  
  .social-media-contact ul {
    list-style: none;
    padding: 0;
    display: flex;
    justify-content: center;
  }
  
  .social-media-contact ul li {
    margin: 0 10px;
  }
  
  .social-media-contact ul li a {
    color: white;
    font-size: 2em;
    text-decoration: none;
    display: block;
    width: 40px;
    height: 40px;
    line-height: 40px;
    border-radius: 50%;
    background-color: rgba(255, 255, 255, 0.1);
    transition: background-color 0.3s ease;
  }
  
  .social-media-contact ul li a:hover {
    background-color: rgba(255, 255, 255, 0.2);
  }
  
  .social-media-contact ul li i {
    transition: transform 0.3s ease;
  }
  
  .social-media-contact ul li a:hover i {
    transform: rotate(360deg);
  }

  ul {
    list-style: none;
    padding: 0;
}

li {
    display: inline-block;
    margin-right: 5px; /* Ajuste o espaçamento entre os itens conforme necessário */
}

li a img {
    width: 45px; /* Defina a largura da imagem conforme necessário */
    height: auto; /* Mantém a proporção da imagem */
    display: block;
}
  

</style>
<body>
    <header>
    </header>
    <main>
        <section class="login-container">
            <h2>Login</h2>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                <label for="username">Usuário:</label>
                <input type="text" id="username" name="username"><br><br>
                <label for="password">Senha:</label>
                <input type="password" id="password" name="password"><br><br>
                <input type="submit" value="Entrar">
            </form>
            
        </section>
    </main>
</body>
</html>

<?php
$conn->close();
?>
