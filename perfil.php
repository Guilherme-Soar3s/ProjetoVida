<?php
require_once 'config.php';


session_start();

// Conexão com o banco

// ID do usuário que será exibido (ex: via GET ou sessão)
$id = $_SESSION['usuario_id']; // por padrão, mostra o perfil do ID 1

// Consulta SQL
$sql = "SELECT nome, email, data_nascimento, sobre_mim, foto_perfil FROM users WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->bindParam('id', $id);
$stmt->execute();
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

if (!empty($_POST)) {

    $id = $_SESSION['usuario_id']; // ID do usuário

    // Dados enviados via POST
    $nome = $_POST['nome'] ?? null;
    $email = $_POST['email'] ?? null;
    $data_nascimento = $_POST['data_nascimento'] ?? null;
    $sobre_mim = $_POST['sobre_mim'] ?? null;
    $senha = !empty($_POST['senha']) ? password_hash($_POST['senha'], PASSWORD_DEFAULT) : null;

    // Verifica se foi feito upload de imagem
    $foto_perfil = null;
    if (isset($_FILES['foto_perfil']) && $_FILES['foto_perfil']['error'] === UPLOAD_ERR_OK) {
        $nome_arquivo = uniqid() . '_' . basename($_FILES['foto_perfil']['name']);
        $caminho = __DIR__ . '/uploads/' . $nome_arquivo;

        if (move_uploaded_file($_FILES['foto_perfil']['tmp_name'], $caminho)) {
            $foto_perfil = 'uploads/' . $nome_arquivo;
        }
    }

    // Monta a SQL dinamicamente
    $campos = [];
    if ($nome) $campos[] = "nome = :nome";
    if ($email) $campos[] = "email = :email";
    if ($data_nascimento) $campos[] = "data_nascimento = :data_nascimento";
    if ($sobre_mim) $campos[] = "sobre_mim = :sobre_mim";
    if ($senha) $campos[] = "senha = :senha";
    if ($foto_perfil) $campos[] = "foto_perfil = :foto_perfil";

    if (empty($campos)) {
        echo "Nenhum dado para atualizar.";
        exit;
    }

    $sql = "UPDATE users SET " . implode(", ", $campos) . " WHERE id = :id";
    $stmt = $pdo->prepare($sql);

    // Bind dos parâmetros
    $stmt->bindParam(':id', $id);
    if ($nome) $stmt->bindParam(':nome', $nome);
    if ($email) $stmt->bindParam(':email', $email);
    if ($data_nascimento) $stmt->bindParam(':data_nascimento', $data_nascimento);
    if ($sobre_mim) $stmt->bindParam(':sobre_mim', $sobre_mim);
    if ($senha) $stmt->bindParam(':senha', $senha);
    if ($foto_perfil) $stmt->bindParam(':foto_perfil', $foto_perfil);

    // Executa a atualização
    if ($stmt->execute()) {
        echo "Perfil atualizado com sucesso!";
    } else {
        echo "Erro ao atualizar o perfil.";
    }
}   



?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Perfil de <?= htmlspecialchars($usuario['nome']) ?></title>


    <form action="" method="post" enctype="multipart/form-data">


        Nome: <input type="text" name="nome"><br>
        Email: <input type="email" name="email"><br>
        Senha: <input type="password" name="senha"><br>
        Data de Nascimento: <input type="date" name="data_nascimento"><br>
        Sobre Mim: <textarea name="sobre_mim"></textarea><br>
        Foto de Perfil: <input type="file" name="foto_perfil"><br>
        <button type="submit">Atualizar Perfil</button>
    </form>

</head>

<body>



</body>

</html>