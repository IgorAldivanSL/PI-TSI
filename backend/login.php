<?php
try {
    // Conexão com banco SQLite
    $pdo = new PDO('sqlite:rtrips_db.sqlite');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Verifica se os dados foram enviados
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $email = $_POST['email'] ?? '';
        $senha = $_POST['senha'] ?? '';

        // Consulta o usuário no banco
        $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($usuario && password_verify($senha, $usuario['senha'])) {
            echo "Login bem-sucedido. Bem-vindo, " . htmlspecialchars($usuario['email']) . "!";
        } else {
            echo "E-mail ou senha incorretos.";
        }
    }
} catch (PDOException $e) {
    echo "Erro na conexão: " . $e->getMessage();
}
?>
 
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
   
</head>
<body>
    <div class="login-container">
        <div class="logo"></div>
        <h2>Login</h2>
        <form action="login.php" method="POST">
            <div class="input-group">
                <span class="icon"></span>
                <input type="email" placeholder="E-mail" required>
            </div>
            <div class="input-group">
                <span class="icon"></span>
                <input type="password" placeholder="Senha" id="password" required>
                <button type="button" class="btn-toggle-password" onclick="togglePasswordVisibility()"></button>
            </div>
            <button type="submit">ENTRAR</button>
            <p class="forgot-password"><a href="#">Esqueceu sua senha?</a></p>
        </form>
    </div>
</body>
</html>