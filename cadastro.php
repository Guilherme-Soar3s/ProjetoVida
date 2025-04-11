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
    $controller->criarUsuario($_POST['nome'], $_POST['email'], $_POST['senha'], $_POST['data_nascimento'], $_POST['sobre_mim']);

    echo "Cadastrado com Sucesso";
}


$userId = $_SESSION['usuario_id']; // Supondo que o ID do usuário esteja armazenado na sessão

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtém os dados do formulário
    $nome = $_POST['nome'];
    $email = $_POST['email'];

    // Processa o upload da foto
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
        $extensao = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
        $novo_nome = uniqid() . '.' . $extensao;
        $caminho = 'uploads/' . $novo_nome;

        // Move a foto para o diretório 'uploads'
        move_uploaded_file($_FILES['foto']['tmp_name'], $caminho);
    } else {
        // Se não houve upload de foto, mantemos a foto atual
        $caminho = null; // Ou você pode manter o caminho atual se não desejar trocar
    }
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

<body>


    <main>
        <section>

        <div>
            <div class="login">
                <h1>CADASTRAR</h1>
            </div>

            <div class="corpologin">
                <form method="POST" action="<?php echo $_SERVER['PHP_SELF'] ?>">
                    <label for="nome">Nome</label>
                    <div><input type="text" name="nome" required></div>
                    <br>

                    <label for="data_nascimento">Data de nascimento</label>
                    <div><input type="date" name="data_nascimento" required></div>
                    <br>

                    <label for="sobre_mim">Sobre mim</label>
                    <div><input type="text" name="sobre_mim" required></div>

                    <br>

                    <label for="foto">Foto:</label>
                    <div><input type="file" name="foto" id="foto"></div><br>

                    <label for="email">Email</label>
                    <div><input type="email" name="email" required></div>
                    <br>

                    <label for="senha">Senha</label>
                    <div><input type="password" name="senha" required></div>
                    <br>
                    <button type="submit">CADASTRAR</button>
                    <br>
                    <div><b><a href="index.php">Já tem uma conta? Clique aqui para entrar</a></b>
                    </div>
                </form>
            </div>
        </div>
            
        </section>
    </main>
</body>

</html>