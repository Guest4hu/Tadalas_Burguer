<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teste de Pedido - Tadallas</title>
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
        .page { max-width: 720px; margin: 0 auto; padding: 28px 20px 60px; }
        .card { background: var(--card); border: 1px solid var(--border); border-radius: 16px; padding: 18px; }
        .field { margin-bottom: 12px; }
        label { display:block; margin-bottom:6px; font-weight:600; }
        input { width:100%; padding:10px 12px; border-radius:8px; border:1px solid var(--border); background:#0f0f0f; color:var(--text); }
        .actions { margin-top: 16px; display:flex; gap:12px; flex-wrap:wrap; }
        .btn { background: var(--accent); color: #fff; padding:10px 16px; border:none; border-radius:8px; cursor:pointer; }
        .btn-outline { background: transparent; color: var(--text); border:1px solid var(--border); text-decoration:none; padding:10px 16px; border-radius:8px; }
        pre { background:#0f0f0f; padding:12px; border-radius:8px; border:1px solid var(--border); overflow:auto; }
        .muted { color: var(--muted); font-size: 13px; }
    </style>
</head>
<body>
    <main class="page">
        <h1>Teste rápido de pedido</h1>
        <p class="muted">Envia um pedido com 1 item para <code>/backend/pedidos/teste</code>.</p>

        <div class="card">
            <div class="field">
                <label for="usuario_id">ID do usuário</label>
                <input type="number" id="usuario_id" value="1" min="1" />
            </div>
            <div class="field">
                <label for="produto_id">ID do produto</label>
                <input type="number" id="produto_id" value="1" min="1" />
            </div>
            <div class="field">
                <label for="quantidade">Quantidade</label>
                <input type="number" id="quantidade" value="1" min="1" />
            </div>
            <div class="field">
                <label for="valor">Valor unitário</label>
                <input type="number" id="valor" value="10.00" step="0.01" min="0" />
            </div>

            <div class="actions">
                <button class="btn" id="enviar">Enviar pedido de teste</button>
                <a class="btn-outline" href="cardapio.php">Voltar ao cardápio</a>
            </div>
        </div>

        <h3 style="margin-top:18px;">Resposta</h3>
        <pre id="resultado">Aguardando envio...</pre>
    </main>

    <script>
        const btn = document.getElementById('enviar');
        const resultado = document.getElementById('resultado');

        btn.addEventListener('click', async () => {
            const payload = {
                usuario_id: parseInt(document.getElementById('usuario_id').value, 10),
                produto_id: parseInt(document.getElementById('produto_id').value, 10),
                quantidade: parseInt(document.getElementById('quantidade').value, 10),
                valor: parseFloat(document.getElementById('valor').value)
            };

            resultado.textContent = 'Enviando...';
            try {
                const resp = await fetch('/backend/pedidos/teste', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify(payload)
                });
                const data = await resp.json().catch(() => ({ sucesso: false, mensagem: 'Resposta inválida' }));
                resultado.textContent = JSON.stringify({ status: resp.status, ...data }, null, 2);
            } catch (e) {
                resultado.textContent = 'Erro de rede ao enviar.';
            }
        });
    </script>
</body>
</html>
