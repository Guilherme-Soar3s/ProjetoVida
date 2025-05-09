<?php
require_once 'Controller/UsuarioController.php';
require_once 'config.php';
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header("Location: index.php");
}
$controller = new UsuarioController($pdo);
$foto_perfil = $controller->getFotoPerfil($_SESSION['usuario_id']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilo.css">
    <title>Document</title>
</head>
<body>
<header>



<h1>Análise e Desenvolvimento de Sistemas</h1>



<div class="menu">

    <a href="painel.php"><div>Inicio</div></a>

    <div class="image">

        <a href="perfil.php">
            <div><img src="<?= $foto_perfil ?>" alt=""></div>
        </a>
    </div>

    <a href="index.php"> <div>Sair</div></a>
</div>

</header>


    <main>
        <section class="section">
            <div>
            
            </div>
        </section>
    </main>
</body>
</html>