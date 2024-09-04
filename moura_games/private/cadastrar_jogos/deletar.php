<?php
// Chama arquivo externo de conexão com o Banco de Dados.
include("../../php/conexao.php");

// Verifica se o parâmetro 'ID' está definido na URL
if (isset($_GET['ID'])) {
    $id_produto = intval($_GET['ID']); // Converte o ID para inteiro para evitar SQL Injection

    // Consulta para selecionar o produto usando prepared statements
    $stmt = $conn->prepare("SELECT * FROM moura_games.tb_produtos WHERE id = $id_produto");
    $stmt->bind_param("i", $id); // "i" indica que o parâmetro é um inteiro
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            // Exibe os dados do produto (você pode personalizar esta parte)
            echo "<h2>Produto: " . htmlspecialchars($row['nome']) . "</h2>";
            echo "<p>Descrição: " . htmlspecialchars($row['descricao']) . "</p>";
            echo "<p>Preço: " . htmlspecialchars($row['preco']) . "</p>";
        }

        // Exibe o formulário de confirmação
        echo '
        <form method="post">
            <input type="hidden" name="ID" value="' . htmlspecialchars($id) . '">
            <input type="submit" name="confirmar" value="Confirmar Exclusão">
        </form>';
    } else {
        echo "Produto não encontrado.";
    }

    // Verifica se o formulário de confirmação foi enviado
    if (isset($_POST['confirmar']) && isset($_POST['ID'])) {
        // SQL para deletar o registro usando prepared statements
        $id = intval($_POST['ID']); // Garante que o ID seja um número inteiro
        $stmt = $conn->prepare("DELETE FROM moura_games.tb_produtos WHERE id = ?");
        $stmt->bind_param("i", $id); // "i" indica que o parâmetro é um inteiro

        if ($stmt->execute()) {
            echo "<script>alert('Registro $id apagado com sucesso!');</script>";
            // Redireciona para a página de listagem de produtos
            echo "<script>window.location.href = './listar_prod.php';</script>";
        } else {
            echo "Erro ao apagar o registro: " . $conn->error;
        }
        $stmt->close();
    }

    $conn->close();
} 
?>
<!-- Formulário de confirmação -->
<body>
<div class="container_jogos">
        <h2>Confirmação</h2>
        <p>Tem certeza que deseja deletar o produto?</p>
        <form method="post">
            <div class="button-container">
                <button type="submit" name="confirmar" class="submit-button">Sim</button>
                <button type="button" class="cancel-button" onclick="loadPagePrivate('../cadastrar_jogos/listar.php')">Não</button>
            </div>
        </form>
    </div>
</body>
</html>

