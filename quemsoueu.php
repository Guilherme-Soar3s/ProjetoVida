


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quem sou eu</title>
</head>
<body>

<h1>QUEM SOU EU?</h1>

<div>
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
    echo "<tr><th>Nome</th><th>Data de Nascimento</th><th>Sobre Mim</th> </tr>";

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>";
        echo "<td>" . $row["nome"] . "</td>";
        echo "<td>" . $row["data_nascimento"] . "</td>";
        echo "<td>" . $row["sobre_mim"] . "</td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "Nenhum registro encontrado.";
}

?>
</div>
    
</body>
</html>