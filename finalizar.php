<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Finalizar Pedido - Tadallas</title>
    <link rel="stylesheet" href="assets/css/style.css" />
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
        .checkout-page { max-width: 900px; margin: 0 auto; padding: 28px 20px 60px; }
        .checkout-header { display:flex; align-items:center; justify-content:space-between; gap:16px; flex-wrap:wrap; }
        .checkout-header h1 { margin: 0; }
        .checkout-box { background: var(--card); border: 1px solid var(--border); border-radius: 16px; padding: 18px; }
        .checkout-actions { margin-top: 18px; display:flex; gap:12px; flex-wrap:wrap; }
        .btn-link { text-decoration:none; }
        .btn { background: var(--accent); color: #fff; }
        .btn.btn-outline { background: transparent; color: var(--text); border-color: var(--border); }
        .count-badge { background: #1c1c1c; color: #ffd60a; padding:2px 8px; border-radius:999px; font-weight:700; border: 1px solid var(--border); }
    </style>
</head>
<body>
    <main class="checkout-page">
        <div class="checkout-header">
            <h1>Finalizar pedido</h1>
            <a href="carrinho.php" class="btn btn-outline btn-link">Voltar ao carrinho</a>
        </div>

        <div class="checkout-box" style="margin-top:16px;">
            <div id="auth-status" style="margin-bottom:12px; font-weight:600;"></div>

            <div style="display:flex; align-items:center; gap:10px; margin-bottom:12px;">
                <strong>Itens no carrinho:</strong>
                <span id="cart-count" class="count-badge">0</span>
            </div>
            <ul id="carrinho-itens" style="padding-left:0; margin:0;"></ul>
            <div style="margin-top:12px; font-weight:700;">Total: R$ <span id="total">0,00</span></div>

            <form id="checkout-form" style="margin:0;">
                <input type="hidden" id="id-usuario" name="id-usuario" value="">
                <div class="checkout-actions">
                    <a href="cardapio.php" class="btn btn-outline btn-link">Adicionar mais itens</a>
                    <button class="btn" id="finalizar-pedido" type="button" disabled>Finalizar pedido</button>
                </div>
            </form>
        </div>
    </main>

    <script>
        async function carregarUsuario() {
            const authStatus = document.getElementById('auth-status');
            const idInput = document.getElementById('id-usuario');
            const finalizarBtn = document.getElementById('finalizar-pedido');
            try {
                const resp = await fetch('/backend/me');
                const data = await resp.json();
                if (data && data.logged_in) {
                    authStatus.textContent = `Logado como ${data.nome || 'Usuário'} (${data.email || ''})`;
                    idInput.value = data.usuario_id;
                    finalizarBtn.disabled = false;
                } else {
                    window.location.href = '/backend/login?redirect=/finalizar.php';
                }
            } catch (e) {
                window.location.href = '/backend/login?redirect=/finalizar.php';
            }
        }

        document.addEventListener('DOMContentLoaded', carregarUsuario);
    </script>
    <script src="assets/js/carrinho.js"></script>
    <script src="assets/js/pedidos.js"></script>
</body>
</html>
