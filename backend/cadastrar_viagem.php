<?php
session_start();

require_once('conexao.php');

// Verifica se o administrador está logado.
if (!isset($_SESSION['admin_logado'])) {
    header("Location: login.php");
    exit();
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 1) Captura dos campos do formulário
    $titulo     = trim($_POST['titulo'] ?? '');
    $valor      = trim($_POST['valor']  ?? '');
    $data_ida   = $_POST['data_ida']    ?? null;
    $data_volta = $_POST['data_volta']  ?? null;
    $descricao  = trim($_POST['descricao'] ?? '');

    // 2) Validação básica
    if ($titulo === '' || $valor === '' || !$data_ida || !$data_volta) {
        echo "<p style='color:red;'>Por favor, preencha todos os campos obrigatórios.</p>";
        exit;
    }

    // 3) Upload de imagem para ../assets/
    if (empty($_FILES['imagem']['name']) || $_FILES['imagem']['error'] !== UPLOAD_ERR_OK) {
        echo "<p style='color:red;'>Imagem é obrigatória.</p>";
        exit;
    }
    $tiposPermitidos = ['image/jpeg','image/png','image/gif'];
    if (!in_array($_FILES['imagem']['type'], $tiposPermitidos)) {
        echo "<p style='color:red;'>Tipo de arquivo não permitido. Use JPG, PNG ou GIF.</p>";
        exit;
    }
    $ext = pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION);
    $imagemNome = uniqid('viagem_') . '.' . $ext;
    // ajusta o caminho relativo para chegar em /projeto/assets/
    $destino    = __DIR__ . '/assets/' . $imagemNome;


    if (!move_uploaded_file($_FILES['imagem']['tmp_name'], $destino)) {
        echo "<p style='color:red;'>Erro a77777777777777o enviar a imagem.</p>";
        exit;
    }

    // 4) Inserção no banco
    try {
        $sql = "INSERT INTO viagens (titulo, valor, data_ida, data_volta, descricao, imagem) VALUES (:titulo, :valor, :data_ida, :data_volta, :descricao, :imagem)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':titulo', $titulo, PDO::PARAM_STR);
        $stmt->bindValue(':valor', floatval($valor), PDO::PARAM_STR);
        $stmt->bindValue(':data_ida', $data_ida, PDO::PARAM_STR);
        $stmt->bindValue(':data_volta', $data_volta, PDO::PARAM_STR);
        $stmt->bindValue(':descricao', $descricao, PDO::PARAM_STR);
        $stmt->bindValue(':imagem', $imagemNome, PDO::PARAM_STR);

        $stmt->execute();
        $id = $pdo->lastInsertId();

        echo "<p style='color:green;'>Viagem cadastrada com sucesso! ID: {$id}</p>";
    } catch (PDOException $e) {
        echo "<p style='color:red;'>Erro ao cadastrar viagem: " . $e->getMessage() . "</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Viagem</title>
</head>
<body>
    <h1>Cadastro de Viagem</h1>
    <form action="" method="post" enctype="multipart/form-data">
        <label>Imagem:</label><br>
        <input type="file" name="imagem" accept="image/*" required><br><br>

        <label>Título:</label><br>
        <input type="text" name="titulo" required><br><br>

        <label>Valor (R$):</label><br>
        <input type="number" name="valor" step="0.01" required><br><br>

        <label>Data de Ida:</label><br>
        <input type="date" name="data_ida" required><br><br>

        <label>Data de Volta:</label><br>
        <input type="date" name="data_volta" required><br><br>

        <label>Descrição:</label><br>
        <textarea name="descricao" rows="5"></textarea><br><br>

        <button type="submit">Publicar</button>
    </form>
</body>
</html>