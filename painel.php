<?php

session_start();

if(!isset($_SESSION['usuario_id'])) {
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=H1, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Sobre meu pai</h1>
    <a href="teste_personalidade.php">teste personalidade</a>
    <a href="teste_inteligencia.php">teste de inteligencia</a>
    <a href="perfil.php">perfil</a>
</body>
</html>