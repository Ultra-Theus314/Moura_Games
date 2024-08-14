<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../../assets/css/estilo.css">
  <title>Document</title>
</head>
<body>
    <?php
        //chama arquivo externo do conexão com o Banco de Dados.
        include("../db/conexao.php");

        $id=$_SERVER['QUERY_STRING'];
        
        // sql to delete a record
        $sql = "DELETE FROM gamelandia.tb_clientes WHERE $id";

        if ($conn->query($sql) === TRUE) 
        {
            echo "<script>alert("."'Registro ".$id." apagado com sucesso !'".")</script>";
        } 
        else 
        {
            echo "Erro ao apagar o Registro: " . $conn->error;
        }
        $conn->close();

        include("./listar_pes.php");
    ?>
</body>
</html>