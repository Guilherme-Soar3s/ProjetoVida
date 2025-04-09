<?php

session_start();

if (isset($_SESSION["logado"])) {
    header("Location: index.php");
}

require_once("Controller/UsuarioController.php");





if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    ?> 
    <?php
    $controller = new UsuarioController($pdo);
    $controller->criarUsuario($_POST['nome'], $_POST['email'], $_POST['senha'],$_POST['data_nascimento'], $_POST['sobre_mim']);

    echo "Cadastrado com Sucesso";
}

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilo.css">
    <title>Cadastro - Projeto de Vida</title>
</head>

<body class="index">

    <div class="overlay"></div>
    <div class="cabecalho">
        <h1 class="titulo">Projeto de Vida</h1>
        <h2 class="subtitulo">Preencha o formulário</h2>
        
    </div>
    <br><br>
    <div class="cadastro">
        <h1>CADASTRAR</h1>
        <div class="form-container">
            <form method="POST" action="<?php echo $_SERVER['PHP_SELF'] ?>">
                <label for="nome">Nome</label>
                <input type="text" name="nome" required>
                <br>

                <label for="data_nascimento">Data de nascimento</label>
                <input type="date" name="data_nascimento"  required>
                <br>

                <label for="sobre_mim">Sobre mim</label>
                <input type="text" name="sobre_mim"  required>
                <br>

                <label for="email">Email</label>
                <input type="email" name="email" required>
                <br>

                <label for="senha">Senha</label>
                <input type="password" name="senha"  required>
                <br>
                <button type="submit">CADASTRAR</button>
                <br>
                <div><b><a href="index.php">Já tem uma conta? Clique aqui para entrar</a></b>
                </div>
            </form>
        </div>
    </div>
    </div>
</body>

</html>