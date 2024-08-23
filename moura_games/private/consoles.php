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
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <style>
    .navbar-nav {
      display: flex;
      justify-content: center;
      width: 100%;
    }
    .nav-link {
      color: white !important; /* Altera a cor das letras */
      font-size: 1.2rem; /* Altera o tamanho da fonte */
    }
    .nav-link:hover {
      color: #ddd !important; /* Altera a cor das letras ao passar o mouse */
    }
    .dropdown-menu {
      background-color: #343a40; /* Cor de fundo do dropdown */
    }
    .dropdown-item {
      color: white; /* Cor das letras do item do dropdown */
    }
    .dropdown-item:hover {
      background-color: #495057; /* Cor de fundo do item do dropdown ao passar o mouse */
    }
  </style>
</head>
<body>
<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
  <div class="container-fluid">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Playstation</a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">Playstation 5</a></li>
            <li><a class="dropdown-item" href="#">Playstation 4</a></li>
            <li><a class="dropdown-item" href="#">Playstation 3</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Xbox</a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">Xbox Series X</a></li>
            <li><a class="dropdown-item" href="#">Xbox Series S</a></li>
            <li><a class="dropdown-item" href="#">Xbox One</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Nintendo</a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">Nintendo Switch</a></li>
            <li><a class="dropdown-item" href="#">Nintendo Switch Lite</a></li>
            <li><a class="dropdown-item" href="#">Wii U</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">PC</a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">Gaming PC</a></li>
            <li><a class="dropdown-item" href="#">Components</a></li>
            <li><a class="dropdown-item" href="#">Accessories</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Colecionáveis</a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">Estatuetas</a></li>
            <li><a class="dropdown-item" href="#">Action Figures</a></li>
            <li><a class="dropdown-item" href="#">Pôsteres</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Novidades</a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">Lançamentos Recentes</a></li>
            <li><a class="dropdown-item" href="#">Ofertas Especiais</a></li>
            <li><a class="dropdown-item" href="#">Eventos</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>
<div class="container-fluid mt-3">
  
</div>
</body>
</html>
