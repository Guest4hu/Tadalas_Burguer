<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrinho - Tadallas</title>
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
            <a href="cardapio.php" class="btn btn-outline btn-link">Voltar ao cardápio</a>
        </div>

        <div class="cart-box" style="margin-top:16px;">
            <div style="display:flex; align-items:center; gap:10px; margin-bottom:12px;">
                <strong>Itens no carrinho:</strong>
                <span id="cart-count" class="count-badge">0</span>
            </div>
            <ul id="carrinho-itens" style="padding-left:0; margin:0;"></ul>
            <div class="cart-total">Total: R$ <span id="total">0,00</span></div>
            <div class="cart-actions">
                <a href="cardapio.php" class="btn btn-primary btn-link">Adicionar mais itens</a>
                <button class="btn" type="button">Finalizar pedido</button>
            </div>
        </div>
    </main>

    <script src="assets/js/carrinho.js"></script>
</body>
</html>
