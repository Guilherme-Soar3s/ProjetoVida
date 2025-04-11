<?php
require_once 'config.php';

session_start();
// Conexão com o banco

// ID do usuário que será exibido (ex: via GET ou sessão)
$id = isset($_SESSION['usuario_id']) ? (int) $_SESSION['usuario_id'] : 1; // por padrão, mostra o perfil do ID 1

// Buscar dados do usuário
$sql = "SELECT nome, email, data_nascimento, sobre_mim, foto_perfil FROM users WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
$stmt->execute();

$usuario = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$usuario) {
    echo "Usuário não encontrado.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Perfil de <?= htmlspecialchars($usuario['nome']) ?></title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; max-width: 600px; margin: auto; }
        .perfil { border: 1px solid #ccc; padding: 20px; border-radius: 10px; }
        .foto { width: 150px; height: 150px; object-fit: cover; border-radius: 50%; margin-bottom: 20px; }
        h2 { margin-bottom: 10px; }
        .label { font-weight: bold; }
    </style>
</head>
<body>

<div class="perfil">
    <img src="<?= htmlspecialchars($usuario['foto_perfil']) ?>" alt="Foto de Perfil" class="foto">
    <h2><?= htmlspecialchars($usuario['nome']) ?></h2>

    <p><span class="label">Email:</span> <?= htmlspecialchars($usuario['email']) ?></p>
    <p><span class="label">Data de Nascimento:</span> <?= date('d/m/Y', strtotime($usuario['data_nascimento'])) ?></p>
    <p><span class="label">Sobre Mim:</span><br><?= nl2br(htmlspecialchars($usuario['sobre_mim'])) ?></p>
</div>

</body>
</html>