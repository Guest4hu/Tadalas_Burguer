    <h1>Login</h1>
    <p class="auth-subtle">Acesse para finalizar seu pedido com segurança.</p>
     <form action="/backend/login" method="POST" class="w3-panel w3-center" style="margin:0; padding:0;">
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
        <button type="submit" class="w3-button w3-blue" style="width:100%;">Entrar</button>
    </form>
    <div style="margin-top:12px;">
        <a href="/backend/register?redirect=<?php echo urlencode($redirect ?? '/carrinho.php'); ?>">Não tenho conta</a><br>
        <a href="/backend/esqueci-senha">Esqueci a senha</a>
    </div>
