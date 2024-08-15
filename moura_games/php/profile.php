<?php
session_start();
include('conexao.php'); // Verifique o caminho correto para o arquivo de conexão

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

// Se não encontrar o usuário, redirecionar para a página de login
if (!$username) {
    header('Location: ../login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil - MouraGames</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/estilo.css"> 
    <link rel="icon" type="image/x-icon" href="./assets/img/M_do_moura.ico">
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
        }
        .profile-info-container {
            margin-left: 20px;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="../index.php">MouraGames</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="../index.php"><i class="fa-solid fa-house"></i> Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../index.php#novidades"><i class="fa-solid fa-star"></i> Novidades</a>
                    </li>
                    <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin']): ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="../uploads/<?php echo htmlspecialchars($profile_picture ?: 'default-avatar.png'); ?>" alt="Foto de Perfil" class="avatar" style="width: 24px; height: 24px; border-radius: 50%;"/>
                                <?php echo htmlspecialchars($username); ?>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="profile.php"><i class="fa-solid fa-address-book"></i> Perfil</a></li>
                                <li><a class="dropdown-item" href="logout.php"><i class="fa-solid fa-right-to-bracket"></i> Sair</a></li>
                            </ul>
                        </li>
                    <?php else: ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa-solid fa-user"></i> Login
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="../login.php"><i class="fa-solid fa-circle-user"></i> Fazer login</a></li>
                                <li><a class="dropdown-item" href="../register.php"><i class="fa-solid fa-address-card"></i> Registrar</a></li>
                            </ul>
                        </li>
                    <?php endif; ?>
                    <li class="nav-item">
                        <form class="d-flex ms-2" role="search">
                            <input class="form-control me-2" type="search" placeholder="Buscar jogos" aria-label="Search">
                            <button class="btn btn-outline-light" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main>
        <section class="container mt-5">
            <h1>Perfil de <?php echo htmlspecialchars($username); ?></h1>
            <div class="profile-content">
                <div class="avatar-container">
                    <img src="../uploads/<?php echo htmlspecialchars($profile_picture ?: 'default-avatar.png'); ?>" alt="Foto de Perfil">
                    <div class="status-indicator"></div>
                </div>
                <div class="profile-info-container">
                    <p><strong>Nome de Usuário:</strong> <?php echo htmlspecialchars($username); ?></p>
                    <p><strong>Email:</strong> <?php echo htmlspecialchars($email); ?></p>
                </div>
            </div>
        </section>
    </main>

    <footer class="bg-dark text-white text-center py-3 mt-3">
        <div class="container">
            <p class="mb-0">© 2024 MouraGames - Todos os direitos reservados</p>
            <p class="mb-0">Encontre os melhores jogos e promoções exclusivas para você.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="./assets/js/scripts.js"></script> <!-- Atualize o caminho se necessário -->
</body>
</html>
