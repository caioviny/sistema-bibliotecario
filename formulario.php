<?php
// Faz um isset de sucesso para exibir um retorno para o usuário
if (isset($_GET['sucesso'])) {
    echo "<div class='mensagem-sucesso'><p>Livro cadastrado com sucesso!</p></div>";
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Livro Cadastrado</title>
    <style>
        body {
            background-color: #f2f2f2;
            font-family: Arial, sans-serif;
        }

        .mensagem-sucesso {
            background-color: #dff0d8;
            border: 1px solid #d6e9c6;
            color: #3c763d;
            padding: 20px;
            margin: 100px auto;
            width: 50%;
            text-align: center;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        .botao-voltar {
            background-color: #4CAF50;
            border: none;
            color: white;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 20px auto;
            width: 20%;
            cursor: pointer;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        .botao-voltar:hover {
            background-color: #3e8e41;
        }
    </style>
</head>
<body>
    <a href="painel_controle.php" class="botao-voltar">Voltar</a>
</body>
</html>
