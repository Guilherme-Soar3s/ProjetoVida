<?php
require_once 'config.php';

session_start();
// Conexão com o banco

// ID do usuário que será exibido (ex: via GET ou sessão)
$id = isset($_SESSION['usuario_id']) ? (int) $_SESSION['usuario_id'] : 1; // por padrão, mostra o perfil do ID 1

// Consulta SQL
$sql = "SELECT nome, email, data_nascimento, sobre_mim, foto_perfil FROM users";
$stmt = $pdo->query($sql);
$row = $stmt->fetch();

// Exibição dos dados

if ($stmt->rowCount() > 0) {
    echo "<table border='1'>";
    echo "<tr><th>Nome</th><th>Email</th><th>Data de Nascimento</th><th>Sobre Mim</th><th>Foto de Perfil</th></tr>";

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>";
        echo "<td>" . $row["nome"] . "</td>";
        echo "<td>" . $row["email"] . "</td>";
        echo "<td>" . $row["data_nascimento"] . "</td>";
        echo "<td>" . $row["sobre_mim"] . "</td>";
        echo "<td><img src='" . $row["foto_perfil"] . "' alt='Foto de Perfil' width='400'></td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "Nenhum registro encontrado.";
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



</body>
</html>