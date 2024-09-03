<?php
// Inclui o arquivo de conexão com o banco de dados
include("../../php/conexao.php");

// Verifica se a variável $conn está definida
if (!isset($conn)) {
    die("Falha na conexão com o banco de dados.");
}

// Comando SQL para listagem dos registros vindos do MySQL em ordem crescente
$consulta = "SELECT ID, PRODUTO, TIPO, PLATAFORMA, DESCRICAO, FOTO, CONCAT('R$ ', FORMAT(VALOR, 2, 'pt_BR')) AS VALOR_FORMATADO FROM moura_games.tb_produtos ORDER BY ID DESC";

// Executa a consulta
$result = $conn->query($consulta);

// Verifica se a consulta foi bem-sucedida
if ($result === false) {
    die("Erro na consulta: " . $conn->error);
}

// Caso o banco de dados retorne 1 linha ou mais
if ($result->num_rows > 0) {
    echo '<div class="row">';
    // Loop para listar os produtos
    while ($row = $result->fetch_assoc()) 
    {
        $foto = htmlspecialchars($row["FOTO"]);
        $produto = htmlspecialchars($row["PRODUTO"]);
        $plataforma = htmlspecialchars($row["PLATAFORMA"]);
        $descricao = htmlspecialchars($row["DESCRICAO"]);
        $valor = htmlspecialchars($row["VALOR_FORMATADO"]);
        $id = $row["ID"];
?>
        <div class="card">
            <!-- Exibe a imagem com o caminho completo -->
            <img class="card-img-top" src="<?php echo "../assets/img/cards/" . $row["FOTO"]; ?>" alt="<?php echo $produto; ?>">
            <div class="card-body">
                <h5 class="card-title"><?php echo $produto; ?> - <?php echo $plataforma; ?></h5>
                <p class="card-text"><?php echo $descricao; ?></p>
                <p class="card-price"><?php echo $valor; ?></p>
                <a class="btn btn-warning" href="alterar.php?id=<?php echo $id; ?>">Alterar</a>
                <a href="#" class="btn btn-success">Deletar</a>      
            </div>
        </div>

<?php
}
    echo '</div>'; // Fecha a div com a classe row
} 
else 
{
    // Em caso de tabela vazia, exibe mensagem
    echo '<div class="alert alert-warning" role="alert">Nenhuma informação retornada do Banco de Dados.</div>';
}

// Fechar conexão com o Banco de Dados
$conn->close();
?>

