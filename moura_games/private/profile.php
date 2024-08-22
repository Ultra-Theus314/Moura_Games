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
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de Perfil</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/estilo.css"> 
    <link rel="icon" type="image/x-icon" href="../assets/img/M_do_moura.ico">
    <style>
        .avatar-container {
            position: relative;
            display: inline-block;
        }
        .avatar-container img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            border: 3px solid #fff;
        }
        .avatar-container .status-indicator {
            position: absolute;
            bottom: 0;
            right: 0;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            background-color: green;
            border: 2px solid #fff;
        }
        .profile-content {
            display: flex;
            align-items: center;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 10px;
            max-width: 600px;
            margin: auto;
        }
        .profile-info-container {
            margin-left: 20px;
        }
        .profile-info-container h1 {
            margin: 0;
            font-size: 24px;
        }
        .profile-info-container p {
            margin: 5px 0;
            font-size: 16px;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="profile-content">
        <div class="avatar-container">
            <img src="<?php echo htmlspecialchars($profile_picture); ?>">
            <div class="status-indicator"></div>
        </div>
        <div class="profile-info-container">
            <h1><?php echo htmlspecialchars($username); ?></h1>
            <p><strong>ID:</strong> <?php echo htmlspecialchars($userId); ?></p>
            <p><strong>Email:</strong> <?php echo htmlspecialchars($email); ?></p>
        </div>
    </div>
</body>
</html>


