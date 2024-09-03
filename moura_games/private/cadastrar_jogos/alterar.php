<?php
// Chama arquivo externo de conexão com o banco de dados
include("../../php/conexao.php");

// Recebe os dados do formulário no método POST e guarda nas variáveis correspondentes
$id_produto = $_POST["produtoId"];
$produto = $_POST["produto"];
$tipo = $_POST["tipo"];
$plataforma = $_POST["plataforma"];
$descricao = $_POST["descricao"];
$foto = $_FILES["foto"];
$valor = $_POST["valor"];
$target_dir = "../../assets/img/cards/";
$target_file = $target_dir . basename($_FILES["foto"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

// Verifica se é uma imagem ou não
if (isset($_FILES["foto"]) && $_FILES["foto"]["tmp_name"]) {
    $check = getimagesize($_FILES["foto"]["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        echo "Arquivo não contém uma imagem válida.";
        $uploadOk = 0;
    }
}

// Verifica se o arquivo já existe
if (file_exists($target_file)) {
    echo "Arquivo de imagem já existente, por favor escolha outro.";
    $uploadOk = 0;
}

// Verifica o tamanho do arquivo
if ($_FILES["foto"]["size"] > 500000) {
    echo "O arquivo de imagem excede o tamanho máximo permitido.";
    $uploadOk = 0;
}

// Aceita apenas arquivos com extensões específicas
if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
    echo "Somente extensões .JPG, .JPEG, .PNG & .GIF são permitidos.";
    $uploadOk = 0;
}

// Verifica se houve algum problema no upload
if ($uploadOk == 0) {
    echo "Seu arquivo não será enviado, corrija o erro e tente novamente.";
} else {
    if (move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file)) {
        $foto = $_FILES["foto"]["name"];
        $sql = "UPDATE moura_games.tb_produtos SET produto='$produto', tipo='$tipo', plataforma='$plataforma', descricao='$descricao', foto='$foto', valor='$valor' WHERE id='$id_produto'";

        if ($conn->query($sql) === TRUE) {
            echo "Registro alterado com sucesso!";
        } else {
            echo "Erro ao alterar o registro no banco de dados.";
        }
    } else {
        echo "Houve um erro ao enviar seu arquivo.";
    }
}
?>
