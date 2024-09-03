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
  <title>Carousel Example</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css">
  <style>
    .carousel {
    width: 50%;
    height: 200px;
    margin: 50px auto; /* Centraliza horizontalmente com uma margem superior de 50px */
    border-radius: 15px;
    overflow: hidden;
    }

    .carousel-indicators button {
    width: 12px;
    height: 12px;
    border-radius: 50%;
    background-color: #000; /* Cor da bolinha */
    border: none;
  }
    .carousel-control-prev-icon,
    .carousel-control-next-icon {
      background-color: rgba(0, 0, 0, 0.5);
      border-radius: 50%;
      width: 40px;
      height: 40px;
    }
  </style>
</head>
<body>
<div id="demo" class="carousel slide" data-bs-ride="carousel">
<div class="carousel-indicators">
    <button type="button" data-bs-target="#demo" data-bs-slide-to="0" class="active"></button>
    <button type="button" data-bs-target="#demo" data-bs-slide-to="1"></button>
    <button type="button" data-bs-target="#demo" data-bs-slide-to="2"></button>
</div>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="../assets/img/carrosel.jpg" alt="Los Angeles" class="d-block" style="width:100%; height: 100%;">
      <div class="carousel-caption">
      </div>
    </div>
    <div class="carousel-item">
      <img src="../assets/img/psn.jpg" alt="Chicago" class="d-block" style="width:100%; height: 100%;">
      <div class="carousel-caption">
      </div> 
    </div>
    <div class="carousel-item">
      <img src="../assets/img/nintendo.jpg" alt="New York" class="d-block" style="width:100%; height: 100%;">
      <div class="carousel-caption">
      </div>  
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#demo" data-bs-slide="prev">
    <span class="carousel-control-prev-icon"></span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#demo" data-bs-slide="next">
    <span class="carousel-control-next-icon"></span>
  </button>
</div>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>

</body>
</html>
