<?php

//nesse arquivo, através de um formulário html, coletamos os dados de login do administrador que está querendo acessar o sistema.
//Uma vez feito isso, enviamos via método post desse formulário, os dados para o arquivo processa_login.php
//No final do arquivo html, capturamos e escrevemos um possível erro que possa ter havido no login do usuário que foi processado (e enviado) no arquivo processa_login.php


session_start();

// Se a variável de sessão com a mensagem de erro estiver definida
if(isset($_SESSION['mensagem_erro'])) {
    echo '<p>' . $_SESSION['mensagem_erro'] . '</p>'; // Exibe a mensagem de erro
    unset($_SESSION['mensagem_erro']); // Descarta a variável de sessão
}
?>

<!-- login.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Login do Administrador</title>
</head>
<body>

    <h2>Login do Administrador</h2>
    <form action="processa_login.php" method="post">
        <label for="nome">Email:</label>
        <input type="text" id="email" name="email" required>
        <p>

        <label for="senha">Senha:</label>
        <input type="password" id="senha" name="senha" required>
        <p>

        <input type="submit" value="Entrar">

        
        <?php 
        ////Capturamos e escrevemos um possível erro que possa ter havido no login do usuário que foi processado (e enviado) no arquivo processa_login.php
            if (isset($_GET['erro'])) {
                echo '<p style="color: red;">Email de usuário ou senha incorretos!</p>';
            }
        ?>

    </form>

</body>
</html>
























