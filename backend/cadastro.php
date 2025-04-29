<?php
try {
    $pdo = new PDO('sqlite:rtrips_db.sqlite');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


    // Recebe os dados do formulário
    $nome = $_POST['nome'] ?? '';
    $telefone = $_POST['telefone'] ?? '';
    $email = $_POST['email'] ?? '';
    $cpf = $_POST['cpf'] ?? '';
    $senha = password_hash($_POST['senha'] ?? '', PASSWORD_DEFAULT);

    echo "Cadastro realizado com sucesso!";
} catch (PDOException $e) {
    echo "Erro: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Cadastro</title>
</head>
<body>
  <div class="container">
    
    <div class="form-box">
    <img src="" alt="Logo" class="logo" />
    <h2>Cadastro</h2>
    <form class="form-box" action="cadastro.php" method="POST">
        <div class="input-group">
            <div class="input-nome">
            <span class="icon"></span>
            <input type="text" placeholder="Nome" />
            </div>
            <div class="input-telefone">
            <span class="icon"></span>
            <input type="text" placeholder="Telefone" />
            </div>
        </div>
    
        <div class="input-email">
            <span class="icon"></span>
            <input type="email" placeholder="E-mail" />
        </div>
    
        <div class="input-cpf">
            <span class="icon"></span>
            <input type="text" placeholder="CPF" />
        </div>
    
        <div class="input-group">
            <div class="input-senha">
            <span class="icon"></span>
            <input type="password" placeholder="Senha" />
            </div>
            <div class="input-confirmar">
            <span class="icon"></span>
            <input type="password" placeholder="Confirmar" />
            </div>
        </div>
        <button class="btn">CADASTRAR</button>
    </form>
  </div>
</body>
</html>