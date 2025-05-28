<?php
session_start(); // Iniciar a sessão

if (!isset($_SESSION['admin_logado'])) {
    header('Location: login.php');
    exit();
}
?>
<p>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Painel do Administrador</title>
</head>
<body>
    <img class="logo" src="/assets/logo.png" alt="Logo">
    <div class="menu-container">
        <h2>Bem-vindo, Administrador!</h2>
        <a href="cadastrar_administrador.php">
            <button>Cadastrar Administrador</button>
        </a>
        <p>
        <a href="listar_administrador.php">
            <button>Listar Administradores</button>
        </a>
        <p>
        <a href="cadastrar_viagem.php">
            <button>Cadastrar Viagem</button>
        </a>
        <p>
        <a href="listar_produtos.php">
            <button>Listar Produtos</button>
        </a>
    </div>

</body>
</html>









































