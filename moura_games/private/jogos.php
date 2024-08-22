<?php
session_start();
include('../php/conexao.php'); // Verifique o caminho correto para o arquivo de conexão

// Verificar se o usuário está logado
if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin']) {
    header('Location: ../login.php');
    exit();
}

// Obter informações do usuário do banco de dados
$userId = $_SESSION['userid'];

$sql = "SELECT username, email, profile_picture FROM moura_games.tb_clientes WHERE id = ?";
$stmt = mysqli_prepare($conn, $sql);

if (!$stmt) {
    die("ERRO NA PREPARAÇÃO DA CONSULTA: " . mysqli_error($conn));
}

mysqli_stmt_bind_param($stmt, 'i', $userId);
mysqli_stmt_execute($stmt);
mysqli_stmt_bind_result($stmt, $username, $email, $profile_picture);
mysqli_stmt_fetch($stmt);

mysqli_stmt_close($stmt);
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<main>
        <section id="home" class="container mt-5">
            <h1>Bem-vindo à Página Principal</h1>
            <p>Conteúdo da página inicial.</p>
        </section>

        <section id="novidades" class="container mt-5">
            <h2>Novidades</h2>
            <p>Conteúdo das novidades.</p>
        </section>
    </main>
</body>
</html>