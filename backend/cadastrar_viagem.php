
<?php
// Inclua aqui sua conexão PDO (por exemplo, em um arquivo separado)
require 'conexao.php'; 
// $pdo = new PDO(...);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Campos do formulário
    $titulo     = $_POST['titulo']     ?? null;
    $valor      = $_POST['valor']      ?? null;
    $data_ida   = $_POST['data_ida']   ?? null;
    $data_volta = $_POST['data_volta'] ?? null;
    $descricao  = $_POST['descricao']  ?? null;

    // Upload de imagem
    $imagemNome = null;
    if (!empty($_FILES['imagem']['name']) && $_FILES['imagem']['error'] === UPLOAD_ERR_OK) {
        // Gera nome único
        $ext = pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION);
        $imagemNome = uniqid('viagem_') . '.' . $ext;
        $destino = __DIR__ . '/uploads/' . $imagemNome;

        // Certifique‑se de que a pasta uploads/ existe e está gravável
        if (!move_uploaded_file($_FILES['imagem']['tmp_name'], $destino)) {
            echo "<p style='color:red;'>Erro ao enviar a imagem.</p>";
            exit;
        }
    }

    try {
        $sql = "INSERT INTO viagens 
                (titulo, valor, data_ida, data_volta, descricao, imagem) 
                VALUES 
                (:titulo, :valor, :data_ida, :data_volta, :descricao, :imagem)";
        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(':titulo', $titulo, PDO::PARAM_STR);
        $stmt->bindParam(':valor', $valor);
        $stmt->bindParam(':data_ida', $data_ida, PDO::PARAM_STR);
        $stmt->bindParam(':data_volta', $data_volta, PDO::PARAM_STR);
        $stmt->bindParam(':descricao', $descricao,  PDO::PARAM_STR);
        $stmt->bindParam(':imagem', $imagemNome, PDO::PARAM_STR);

        $stmt->execute();

        $viagemId = $pdo->lastInsertId();
        echo "<p style='color:green;'>Viagem cadastrada com sucesso! ID: {$viagemId}</p>";

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
        <input type="file" name="imagem" accept="image/*"><br><br>
        
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