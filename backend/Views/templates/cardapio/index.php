<!DOCTYPE html>
<html lang="pt-BR">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Cardápio - Tadalas Burguer</title>
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
		* { box-sizing: border-box; }
		body {
			margin: 0;
			font-family: "Inter", "Segoe UI", Arial, sans-serif;
			background: var(--bg);
			color: var(--text);
		}
		.container {
			max-width: 1200px;
			margin: 0 auto;
			padding: 28px 20px 60px;
		}
		header {
			display: flex;
			flex-direction: column;
			gap: 8px;
			margin-bottom: 24px;
		}
		header h1 {
			margin: 0;
			font-size: 32px;
			font-weight: 800;
		}
		header p {
			margin: 0;
			color: var(--muted);
		}
		.tabs {
			display: flex;
			flex-wrap: wrap;
			gap: 10px;
			margin-bottom: 24px;
		}
		.tab {
			border: 1px solid var(--border);
			background: var(--card);
			color: var(--text);
			padding: 10px 16px;
			border-radius: 999px;
			font-weight: 600;
			cursor: pointer;
			transition: all .2s ease;
		}
		.tab.active {
			background: var(--accent);
			color: #fff;
			border-color: var(--accent);
		}
		.tab:hover {
			border-color: var(--accent-strong);
		}
		.grid {
			display: grid;
			grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
			gap: 18px;
		}
		.card {
			background: var(--card);
			border: 1px solid var(--border);
			border-radius: 16px;
			overflow: hidden;
			display: flex;
			flex-direction: column;
			min-height: 320px;
			box-shadow: 0 10px 20px rgba(0,0,0,0.4);
		}
		.card img {
			width: 100%;
			height: 170px;
			object-fit: cover;
			background: #1c1c1c;
		}
		.card-body {
			padding: 16px;
			display: flex;
			flex-direction: column;
			gap: 10px;
			height: 100%;
		}
		.card-body h3 {
			margin: 0;
			font-size: 18px;
			font-weight: 700;
		}
		.card-body p {
			margin: 0;
			color: var(--muted);
			font-size: 14px;
			line-height: 1.4;
			flex: 1;
		}
		.card-footer {
			display: flex;
			align-items: center;
			justify-content: space-between;
			margin-top: auto;
		}
		.price {
			font-weight: 800;
			color: #ffd60a;
		}
		.btn {
			border: none;
			background: var(--accent);
			color: #fff;
			padding: 8px 14px;
			border-radius: 10px;
			font-weight: 600;
			cursor: pointer;
		}
		.state {
			padding: 14px 18px;
			border-radius: 10px;
			background: #1c1c1c;
			color: #ffffff;
			font-weight: 600;
			border: 1px dashed var(--border);
		}
		.state.error {
			background: #1c1c1c;
			color: #e63946;
			border-color: #e63946;
		}
	</style>
</head>
<body>
	<div class="container">
		<header>
			<div style="display:flex; align-items:center; justify-content:space-between; gap:16px; flex-wrap:wrap;">
				<div>
					<h1>Cardápio</h1>
					<p>Escolha sua categoria e encontre o seu favorito.</p>
				</div>
				<a href="carrinho.php" class="btn" style="text-decoration:none; display:inline-flex; align-items:center; gap:8px;">
					Carrinho
					<span id="cart-count" style="background:#1c1c1c; color:#ffd60a; padding:2px 8px; border-radius:999px; font-weight:700; border:1px solid #2a2a2a;">0</span>
				</a>
			</div>
		</header>

		<nav class="tabs" id="categoryTabs">
			<button class="tab" data-id="all">Todos</button>
			<!-- <button class="tab" data-id=""></button> -->
		</nav>

		<div id="status" class="state" style="display:none; margin-bottom: 15px;"></div>
		<div id="grid" class="grid"></div>
		<div class="cart" id="cart"></div>
	</div>
			
	<script>
		const tabs = document.getElementById('categoryTabs');
		const grid = document.getElementById('grid');
		const statusBox = document.getElementById('status');

        function createCategoryTab(categoria) {
            const tab = document.createElement('button')
            tab.className = 'tab'
            tab.innerHTML = categoria.nome // acessar a chave do nome
            tab.dataset.id = categoria.id_categoria // acessar a chave de id
            return tab
        }

        function renderCategories() {
            fetch('api/categorias')
                .then(response => {
                    if(!response.ok) {
                        throw new Error('Falha ao carregar dados da rede.')
                    }
                    return response.json()
                })
                .then(json => {
                    if (json.status !== 'success' || !json.data) {
                        throw new Error('API retornou um erro: ' + (json.message || 'Formato inválido'));
                    }

                    json.data.forEach(categoria => {
                        tabs.appendChild(createCategoryTab(categoria))
                    })
                })
        }

        renderCategories()








		function formatPrice(value) {
			const number = Number(value ?? 0);
			return number.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
		}

		function showStatus(message, type = '') {
			statusBox.textContent = message;
			statusBox.className = type ? `state ${type}` : 'state';
			statusBox.style.display = 'block';
		}

		function hideStatus() {
			statusBox.style.display = 'none';
		}

		function createProductCard(produto) {
			const card = document.createElement('div');
			card.className = 'card';
			const imgSrc = produto.caminho_imagem || '/backend/upload/img-1.avif';
			card.innerHTML = `
				<img src="${imgSrc}" alt="${produto.nome}">
				<div class="card-body">
					<h3>${produto.nome}</h3>
					<p>${produto.descricao ?? ''}</p>
					<div class="card-footer">
						<span class="price">${formatPrice(produto.preco)}</span>
						<button class="btn add-to-cart" type="button" data-id="${produto.produto_id}" data-nome="${produto.nome}" data-preco="${produto.preco}">Adicionar</button>
					</div>
				</div>
			`;
			return card;
		}

		function renderProducts(items = []) {
			grid.innerHTML = '';
			if (!items.length) {
				showStatus('Nenhum produto encontrado nesta categoria.');
				return;
			}
			hideStatus();
			items.forEach((produto) => grid.appendChild(createProductCard(produto)));
		}













		async function fetchAllProducts() {
			try {
				showStatus('Carregando produtos...');
				const response = await fetch('api/produtos');
				if (!response.ok) {
					throw new Error('Falha ao carregar os produtos');
				}
				const payload = await response.json();
				renderProducts(payload.data ?? []);
			} catch (error) {
				grid.innerHTML = '';
				showStatus('Não foi possível carregar os produtos. Verifique a API.', 'error');
			}
		}

		async function fetchByCategory(categoryId) {
			try {
				showStatus('Carregando produtos...');
				if (categoryId === 'all') {
					return await fetchAllProducts();
				}
				const response = await fetch(`/backend/api/produtos/categoria/${categoryId}`);
				if (!response.ok) {
					throw new Error('Falha ao carregar os produtos');
				}
				const payload = await response.json();
				renderProducts(payload.data ?? []);
			} catch (error) {
				grid.innerHTML = '';
				showStatus('Não foi possível carregar os produtos. Verifique a API.', 'error');
			}
		}        
        
		tabs.addEventListener('click', (event) => {
			const button = event.target.closest('.tab');
			if (!button) return;
			[...tabs.querySelectorAll('.tab')].forEach((tab) => tab.classList.remove('active'));
			button.classList.add('active');
			fetchByCategory(button.dataset.id);
		});

		const firstTab = tabs.querySelector('.tab');
		if (firstTab) {
			firstTab.classList.add('active');
			fetchByCategory(firstTab.dataset.id);
		}

		grid.addEventListener('click', (event) => {
			const button = event.target.closest('.add-to-cart');
			if (!button || typeof window.adicionarAoCarrinho !== 'function') return;
			window.adicionarAoCarrinho(button.dataset.id, button.dataset.nome, button.dataset.preco);
		});
	</script>
	<script src="./../../../../assets/js/carrinho.js"></script>
</body>
</html>