<?php
session_start();
include 'config.php'; // Inclui a conexão com o banco de dados

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Verifica se os campos não estão vazios
    if (empty($email) || empty($senha)) {
        echo "Por favor, preencha todos os campos!";
    } else {
        // Prepara a consulta SQL para verificar se o usuário existe
        $sql = "SELECT * FROM users WHERE email = :email";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();


        // Verifica se o usuário existe
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
        $usuario['senha'] = password_hash($usuario['senha'], PASSWORD_BCRYPT);
        if ($usuario) {
            // Verifica se a senha informada corresponde à senha armazenada no banco de dados
            if (password_verify($senha, $usuario['senha']
            )) {
                // Login bem-sucedido
                $_SESSION['usuario_id'] = $usuario['id'];
                $_SESSION['usuario_email'] = $usuario['email'];
                header('Location: painel.php'); // Redireciona para a página do painel
                exit;
            } else {
                // Senha incorreta
                echo "Senha incorreta!";
            }
        } else {
            // Usuário não encontrado
            echo "Usuário não encontrado!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="estilo.css">
</head>

<body>


    <h2>Login vajifjn</h2>

    <form method="POST">

        <label for="email">E-mail:</label>
        <input type="email" name="email" id="email"><br><br>

        <label for="senha">Senha:</label>
        <input type="password" name="senha" id="senha"><br><br>

        <button type="submit">Entrar</button>
        <div><b><a href="cadastro.php">Não tem conta? Clique aqui para cadastrar</a></b>

    </form>


</body>

</html>