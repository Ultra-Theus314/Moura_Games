<?php
session_start();
include('php/conexao.php'); // Inclua o arquivo de conexão

// Verificar se o usuário está logado e obter as informações do usuário
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin']) {
    $userId = $_SESSION['userid'];
    $sql = "SELECT username, profile_picture FROM users WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    
    if (!$stmt) {
        die("Erro na preparação da consulta: " . mysqli_error($conn));
    }
    
    mysqli_stmt_bind_param($stmt, 'i', $userId);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $username, $profile_picture);
    mysqli_stmt_fetch($stmt);
    
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
} else {
    $username = null;
    $profile_picture = 'default-avatar.png';
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro - MouraGames</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="./assets/css/estilo.css">
    <link rel="icon" type="image/x-icon" href="./assets/img/M_do_moura.ico">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">MouraGames</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="#home"><i class="fa-solid fa-house"></i> Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#novidades"><i class="fa-solid fa-star"></i> Novidades</a>
                    </li>
                    <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin']): ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="uploads/<?php echo htmlspecialchars($profile_picture); ?>" alt="Foto de Perfil" class="avatar" style="width: 24px; height: 24px; border-radius: 50%;"/>
                                <?php echo htmlspecialchars($username); ?>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="php/profile.php"><i class="fa-solid fa-address-book"></i> Perfil</a></li>
                                <li><a class="dropdown-item" href="php/logout.php"><i class="fa-solid fa-right-to-bracket"></i> Sair</a></li>
                            </ul>
                        </li>
                    <?php else: ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa-solid fa-user"></i> Login
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="login.php"><i class="fa-solid fa-circle-user"></i> Fazer login</a></li>
                                <li><a class="dropdown-item" href="register.php"><i class="fa-solid fa-address-card"></i> Registrar</a></li>
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
            <h1>Cadastrar Novo Usuário</h1>
            <form action="php/register_process.php" method="post" enctype="multipart/form-data" class="auth-form">
                <label for="username">Usuário:</label>
                <input type="text" id="username" name="username" required>

                <label for="email">E-mail:</label>
                <input type="email" id="email" name="email" required>

                <label for="password">Senha:</label>
                <input type="password" id="password" name="password" required>

                <label for="confirm_password">Confirmar Senha:</label>
                <input type="password" id="confirm_password" name="confirm_password" required>

                <label for="profile_picture">Foto de Perfil:</label>
                <input type="file" id="profile_picture" name="profile_picture" accept="image/*">

                <button type="submit" class="auth-btn">Cadastrar</button>

                <?php
                if (isset($_GET['error'])) {
                    echo '<p class="error-message">Erro ao cadastrar. Verifique os dados e tente novamente.</p>';
                } elseif (isset($_GET['success'])) {
                    echo '<p class="success-message">Cadastro realizado com sucesso!</p>';
                }
                ?>
            </form>
        </section>
    </main>

    <footer class="bg-dark text-white text-center py-3 mt-3">
        <div class="container">
            <p class="mb-0">© 2024 MouraGames - Todos os direitos reservados</p>
            <p class="mb-0">Encontre os melhores jogos e promoções exclusivas para você.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="./assets/js/scripts.js"></script>
</body>
</html>
