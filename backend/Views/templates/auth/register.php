    <h2>Criar Nova Conta</h2>
    <p class="auth-subtle">Crie sua conta para acompanhar seus pedidos.</p>
    <form action="/backend/register" method="POST" class="w3-container" style="margin:0; padding:0;">
        <input type="hidden" name="redirect" value="<?php echo htmlspecialchars($redirect ?? '/carrinho.php', ENT_QUOTES, 'UTF-8'); ?>">
        <div class="w3-row w3-section">
            <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-envelope-o"></i></div>
            <div class="w3-rest">
                <input class="w3-input w3-border" name="email" type="email" placeholder="Email" required>
            </div>
        </div>
        <div class="w3-row w3-section">
            <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-lock"></i></div>
            <div class="w3-rest">
                <input class="w3-input w3-border" name="senha" type="password" placeholder="Senha" required>
            </div>
        </div>
        <button class="w3-button w3-block w3-section w3-blue w3-ripple w3-padding">Registrar</button>
    </form>
    <div style="margin-top:12px;">
        <p>Já tem uma conta? <a href="/backend/login?redirect=<?php echo urlencode($redirect ?? '/carrinho.php'); ?>">Faça o login aqui</a>.</p>
    </div>