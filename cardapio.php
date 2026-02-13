<?php
	$allApi = '/backend/api/produtos';
	$categoryURL = '/backend/api/categorias';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Cardápio - Tadalas Burguer</title>
	<link rel="stylesheet" href="assets/css/cart-drawer.css" />
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
		</nav>

		<div id="status" class="state" style="display:none"></div>
		<div id="grid" class="grid"></div>
		<div class="cart" id="cart"></div>
	</div>
			
	<script>
		const apiAll = <?php echo json_encode($allApi, JSON_UNESCAPED_SLASHES); ?>;
		const categoryApi = <?php echo json_encode($categoryURL, JSON_UNESCAPED_SLASHES); ?>;
		const tabs = document.getElementById('categoryTabs');
		const grid = document.getElementById('grid');
		const statusBox = document.getElementById('status');

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

		function buildCategoryTabs(categorias) {
			tabs.innerHTML = '';
			const allBtn = document.createElement('button');
			allBtn.className = 'tab';
			allBtn.dataset.id = 'all';
			allBtn.textContent = 'Todos';
			tabs.appendChild(allBtn);

			categorias.forEach((cat) => {
				if (!cat || typeof cat.id_categoria === 'undefined') return;
				const button = document.createElement('button');
				button.className = 'tab';
				button.dataset.id = String(cat.id_categoria);
				button.textContent = cat.nome || `Categoria ${cat.id_categoria}`;
				tabs.appendChild(button);
			});
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
				const response = await fetch(apiAll);
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

		async function loadCategories() {
			try {
				showStatus('Carregando categorias...');
				const response = await fetch(categoryApi);
				if (!response.ok) {
					throw new Error('Falha ao carregar categorias');
				}
				const payload = await response.json();
				const categorias = Array.isArray(payload.data) ? payload.data : [];
				buildCategoryTabs(categorias);
				hideStatus();
				const firstTab = tabs.querySelector('.tab');
				if (firstTab) {
					firstTab.classList.add('active');
					fetchByCategory(firstTab.dataset.id);
				} else {
					showStatus('Nenhuma categoria cadastrada.', 'error');
				}
			} catch (error) {
				showStatus('Não foi possível carregar as categorias. Verifique a API.', 'error');
			}
		}

		tabs.addEventListener('click', (event) => {
			const button = event.target.closest('.tab');
			if (!button) return;
			[...tabs.querySelectorAll('.tab')].forEach((tab) => tab.classList.remove('active'));
			button.classList.add('active');
			fetchByCategory(button.dataset.id);
		});

		loadCategories();

		grid.addEventListener('click', (event) => {
			const button = event.target.closest('.add-to-cart');
			if (!button || typeof window.adicionarAoCarrinho !== 'function') return;
			window.adicionarAoCarrinho(button.dataset.id, button.dataset.nome, button.dataset.preco);
		});
	</script>

	<!-- BOTÃO FLUTUANTE DO CARRINHO -->
	<button id="cart-float-btn" class="cart-float-btn" aria-label="Abrir carrinho">
		<svg viewBox="0 0 24 24" fill="currentColor">
			<path d="M7 18c-1.1 0-1.99.9-1.99 2S5.9 22 7 22s2-.9 2-2-.9-2-2-2zm10 0c-1.1 0-1.99.9-1.99 2S15.9 22 17 22s2-.9 2-2-.9-2-2-2zM7.16 14h9.69c.75 0 1.41-.41 1.75-1.03l3.58-6.49A1 1 0 0 0 21.31 5H6.21L5.27 3.57A2 2 0 0 0 3.61 3H2a1 1 0 0 0 0 2h1.61l3.6 5.59-1.35 2.44A2 2 0 0 0 7.16 14zM7.42 7h12.61l-2.8 5H8.53L7.42 7z" />
		</svg>
		<span id="cart-float-badge" class="cart-badge" style="display: none;">0</span>
	</button>

	<!-- DRAWER LATERAL DO CARRINHO -->
	<div id="cart-drawer-overlay" class="cart-drawer-overlay">
		<div id="cart-drawer" class="cart-drawer">
			<!-- Header -->
			<div class="cart-drawer-header">
				<h2>Seu Carrinho</h2>
				<button id="close-drawer" class="close-drawer-btn" aria-label="Fechar carrinho">×</button>
			</div>

			<!-- Body (lista de produtos) -->
			<div class="cart-drawer-body">
				<ul id="drawer-cart-items"></ul>
			</div>

			<!-- Footer (resumo e ações) -->
			<div class="cart-drawer-footer">
				<div class="cart-summary">
					<div class="summary-line">
						<span>Subtotal:</span>
						<span id="drawer-subtotal">R$ 0,00</span>
					</div>
					<div class="summary-line">
						<span>Frete:</span>
						<span id="drawer-frete">A calcular</span>
					</div>
					<div class="summary-line total">
						<span>Total:</span>
						<span id="drawer-total">R$ 0,00</span>
					</div>
				</div>
				<div class="cart-actions">
					<a href="carrinho.php" class="btn btn-primary btn-checkout">Finalizar Compra</a>
					<button class="btn btn-outline" id="continue-shopping">Continuar Comprando</button>
				</div>
			</div>
		</div>
	</div>

	<!-- CONTAINER DE TOASTS -->
	<div id="toast-container" class="toast-container"></div>

	<script src="assets/js/carrinho.js"></script>
</body>
</html>
