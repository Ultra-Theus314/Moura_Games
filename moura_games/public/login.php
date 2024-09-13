<main>
        <section class="container_jogos">
            <h1>Iniciar Sessão</h1>
            
            <?php if (!isset($_SESSION['loggedin']) || $_SESSION['role'] !== 'admin'): ?>
                <div class="access-message">
                    <p class="admin">Este conteúdo é restrito apenas para administradores.</p>
                </div>
            <?php endif; ?>

            <form action="php/login_process.php" method="post" class="auth-form">
                <label for="username">Usuário:</label>
                <input type="text" id="username" name="username" required>

                <label for="password">Senha:</label>
                <input type="password" id="password" name="password" required>

                <button type="submit" class="auth-btn">Entrar</button>
                
                <?php
                // Exibir mensagens de erro, se houver
                if (isset($_GET['error'])) {
                    echo '<p class="error-message">Usuário ou senha incorretos.</p>';
                }
                ?>
            </form>
        </section>
</main>

