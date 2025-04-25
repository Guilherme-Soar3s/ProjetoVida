<?php
require_once 'config.php';

if(!empty($_POST)){


    session_start();

    $id = $_SESSION['usuario_id']; // ID do usuário
    $data_nascimento = $_POST['data_nascimento'];
    $sobre_mim = $_POST['sobre_mim'];

    // Atualiza a senha apenas se for enviada
    $senha = !empty($_POST['senha']) ? password_hash($_POST['senha'], PASSWORD_DEFAULT) : null;

    $nome = !empty($_POST['nome']) ? trim($_POST['nome']) : null;
    $email = !empty($_POST['email']) ? trim($_POST['nome']) : null;
    $data_nascimento = !empty($_POST['data_nascimento']) ? password_hash($_POST['senha'], PASSWORD_DEFAULT) : null;
    $sobre_mim = !empty($_POST['senha']) ? password_hash($_POST['senha'], PASSWORD_DEFAULT) : null;

    // Foto de perfil (upload)
    $foto_perfil = null;
    if (true) {
        $nome_arquivo = uniqid() . '_' . $_FILES['foto_perfil']['name'];
        move_uploaded_file($_FILES['foto_perfil']['tmp_name'], __DIR__.'/uploads/' . $nome_arquivo);
        $foto_perfil = 'uploads/' . $nome_arquivo;
    }

    // Monta SQL dinâmico
    $sql = "UPDATE users SET nome = :nome, email = :email, data_nascimento = :data_nascimento, sobre_mim = :sobre_mim";
    if ($senha) $sql .= ", senha = :senha";
    if ($foto_perfil) $sql .= ", foto_perfil = :foto_perfil";
    $sql .= " WHERE id = :id";

    $stmt = $pdo->prepare($sql);

    // Bind dos parâmetros
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':data_nascimento', $data_nascimento);
    $stmt->bindParam(':sobre_mim', $sobre_mim);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    if ($senha) $stmt->bindParam(':senha', $senha);
    if ($foto_perfil) $stmt->bindParam(':foto_perfil', $foto_perfil);

    if ($stmt->execute()) {
        echo "Perfil atualizado com sucesso!";
    } else {
        echo "Erro ao atualizar o perfil.";
    }

    header("Location: perfil.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil</title>
</head>
<body>
<form action="" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id" value="1"> <!-- ID do usuário logado -->
    Nome: <input type="text" name="nome"><br>
    Email: <input type="email" name="email"><br>
    Senha (deixe em branco para não mudar): <input type="password" name="senha"><br>
    Data de Nascimento: <input type="date" name="data_nascimento"><br>
    Sobre Mim: <textarea name="sobre_mim"></textarea><br>
    Foto de Perfil: <input type="file" name="foto_perfil"><br>
    <button type="submit">Atualizar Perfil</button>
</form>
</body>
</html>