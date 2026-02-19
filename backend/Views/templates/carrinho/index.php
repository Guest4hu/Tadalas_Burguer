<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrinho - Tadallas</title>
    <link rel="stylesheet" href="./../../../../assets/css/style.css" />
    <style>
        :root {
              --bg: #121212;
              --card: #1c1c1c;
              --text: #f5f5f5;
              --muted: #cfcfcf;
              --accent: #e63946;
              --accent-strong: #d62839;
              --border: #2a2a2a;
        }
        body { background: var(--bg); color: var(--text); }
        .cart-page { max-width: 900px; margin: 0 auto; padding: 28px 20px 60px; }
        .cart-header { display:flex; align-items:center; justify-content:space-between; gap:16px; flex-wrap:wrap; }
        .cart-header h1 { margin: 0; }
        .cart-box { background: var(--card); border: 1px solid var(--border); border-radius: 16px; padding: 18px; }
        .cart-total { margin-top: 16px; font-weight: 700; }
        .cart-actions { margin-top: 18px; display:flex; gap:12px; flex-wrap:wrap; }
        .btn-link { text-decoration:none; }
        .count-badge { background: #1c1c1c; color: #ffd60a; padding:2px 8px; border-radius:999px; font-weight:700; border: 1px solid var(--border); }
        .btn { background: var(--accent); color: #fff; }
        .btn.btn-outline { background: transparent; color: var(--text); border-color: var(--border); }
    </style>
</head>
<body>
    <main class="cart-page">
        <div class="cart-header">
            <h1>Seu carrinho</h1>
            <a href="cardapio" class="btn btn-outline btn-link">Voltar ao cardápio</a>
        </div>

        <div class="cart-box" style="margin-top:16px;">
            <div id="auth-status" style="margin-bottom:12px; font-weight:600;"></div>
            <div id="auth-actions" style="display:flex; gap:8px; flex-wrap:wrap; margin-bottom:12px;">
                <a href="logout" class="btn btn-outline btn-link" id="logout-link" style="display:none;">Sair</a>
                <a href="login" class="btn btn-link" id="login-link" style="display:none;">Entrar</a>
            </div>

            <div style="display:flex; align-items:center; gap:10px; margin-bottom:12px;">
                <strong>Itens no carrinho:</strong>
                <span id="cart-count" class="count-badge">0</span>
            </div>
            <ul id="carrinho-itens" style="padding-left:0; margin:0;"></ul>
            <div class="cart-total">Total: R$ <span id="total">0,00</span></div>

            <form id="checkout-form" style="margin:0;">
                <input type="hidden" id="id-usuario" name="id-usuario" value="">
                <div class="cart-actions">
                    <a href="cardapio" class="btn btn-primary btn-link">Adicionar mais itens</a>
                    <button type="button" class="btn btn-link" id="finalizar-carrinho" disabled>Finalizar pedido</button>
                </div>
            </form>
        </div>
    </main>

    <script>
        async function carregarUsuario() {
            const authStatus = document.getElementById('auth-status');
            const logoutLink = document.getElementById('logout-link');
            const loginLink = document.getElementById('login-link');
            const idInput = document.getElementById('id-usuario');
            const finalizarBtn = document.getElementById('finalizar-carrinho');
            try {
                const resp = await fetch('/backend/api/usuarios/sessao');
                const data = await resp.json();
                if (data && data.logged_in) {
                    authStatus.textContent = `Logado como ${data.nome || 'Usuário'} (${data.email || ''})`;
                    logoutLink.style.display = 'inline-flex';
                    loginLink.style.display = 'none';
                    idInput.value = data.usuario_id;
                    finalizarBtn.classList.remove('btn-outline');
                    finalizarBtn.classList.add('btn');
                    finalizarBtn.disabled = false;
                } else {
                    authStatus.textContent = 'Faça login para finalizar o pedido.';
                    loginLink.style.display = 'inline-flex';
                    logoutLink.style.display = 'none';
                    finalizarBtn.classList.add('btn-outline');
                    finalizarBtn.disabled = true;
                }
            } catch (e) {
                authStatus.textContent = 'Não foi possível verificar o login.';
                loginLink.style.display = 'inline-flex';
                logoutLink.style.display = 'none';
                finalizarBtn.classList.add('btn-outline');
                finalizarBtn.disabled = true;
            }
        }

        document.addEventListener('DOMContentLoaded', carregarUsuario);
    </script>
    <script src="./../../../../assets/js/carrinho.js"></script>
    <script src="./../../../../assets/js/pedidos.js"></script>
</body>
</html>