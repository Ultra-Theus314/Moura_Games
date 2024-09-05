<?php
// Inclui o arquivo de conexão com o banco de dados
include("../../php/conexao.php");

// Verifica se a variável $conn está definida
if (!isset($conn)) {
    die("Falha na conexão com o banco de dados.");
}

// Comando SQL para listagem dos registros vindos do MySQL em ordem crescente
$consulta = "SELECT ID, PRODUTO, TIPO, PLATAFORMA, DESCRICAO, FOTO, CONCAT('R$ ', FORMAT(VALOR, 2, 'pt_BR')) AS VALOR_FORMATADO FROM moura_games.tb_produtos ORDER BY PLATAFORMA, ID DESC";

// Executa a consulta
$result = $conn->query($consulta);

// Verifica se a consulta foi bem-sucedida
if ($result === false) {
    die("Erro na consulta: " . $conn->error);
}

// Caso o banco de dados retorne 1 linha ou mais
if ($result->num_rows > 0) {
    $currentPlatform = '';
    // Loop para listar os produtos
    while ($row = $result->fetch_assoc()) {
        $foto = htmlspecialchars($row["FOTO"]);
        $produto = htmlspecialchars($row["PRODUTO"]);
        $plataforma = htmlspecialchars($row["PLATAFORMA"]);
        $descricao = htmlspecialchars($row["DESCRICAO"]);
        $valor = htmlspecialchars($row["VALOR_FORMATADO"]);
        $id = $row["ID"];

        // Verifica se a plataforma mudou
        if ($plataforma !== $currentPlatform) {
            // Fecha a div anterior, se houver
            if ($currentPlatform !== '') {
                echo '</div>';
            }
            // Atualiza a plataforma atual
            $currentPlatform = $plataforma;
            // Exibe o título da plataforma
            echo '<h2>' . $currentPlatform . '</h2>';
            echo '<div class="row">';
        }
?>
        <div class="card">
            <!-- Exibe a imagem com o caminho completo -->
            <img class="card-img-top" src="<?php echo "../assets/img/cards/" . $row["FOTO"]; ?>" alt="<?php echo $produto; ?>">
            <div class="card-body">
                <h5 class="card-title"><?php echo $produto; ?> - <?php echo $plataforma; ?></h5>
                <p class="card-text"><?php echo $descricao; ?></p>
                <p class="card-price"><?php echo $valor; ?></p>
                <a class="btn btn-warning" href="alterar.php?id=<?php echo $id; ?>">Alterar</a>
                <a href="#" class="btn btn-success" onclick="loadPagePrivate('../cadastrar_jogos/deletar.php')">Deletar</a>      
            </div>
        </div>
<?php
    }
    // Fecha a última div
    echo '</div>';
} else {
    echo "Nenhum produto encontrado.";
}
?>
