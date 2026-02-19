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

		/* Botão Voltar */
		.btn-back {
			display: inline-flex;
			align-items: center;
			justify-content: center;
			width: 42px; height: 42px;
			border-radius: 12px;
			background: var(--card);
			border: 1px solid var(--border);
			color: var(--text);
			text-decoration: none;
			transition: all .2s;
			flex-shrink: 0;
		}
		.btn-back:hover { background: var(--accent); border-color: var(--accent); }
		.btn-back svg { width: 22px; height: 22px; fill: currentColor; }

		/* Botão abrir carrinho */
		.btn-cart-open {
			display: inline-flex;
			align-items: center;
			gap: 8px;
			background: var(--accent);
			color: #fff;
			border: none;
			padding: 10px 18px;
			border-radius: 12px;
			font-weight: 600;
			cursor: pointer;
			font-size: 14px;
			font-family: inherit;
			transition: all .2s;
		}
		.btn-cart-open:hover { background: var(--accent-strong); transform: translateY(-1px); }
		.btn-cart-open svg { width: 18px; height: 18px; fill: #fff; }

		/* Toast Notification */
		.toast-container {
			position: fixed;
			top: 20px; right: 20px;
			z-index: 10000;
			display: flex; flex-direction: column;
			gap: 8px;
			pointer-events: none;
		}
		.toast {
			pointer-events: auto;
			display: flex; align-items: center; gap: 10px;
			background: #1a1a1a;
			border: 1px solid rgba(255,214,10,.3);
			border-radius: 14px;
			padding: 10px 18px;
			color: #fff;
			font-size: 14px; font-weight: 500;
			box-shadow: 0 8px 32px rgba(0,0,0,.5);
			animation: toastIn .3s ease forwards;
			max-width: 340px;
		}
		.toast.out { animation: toastOut .3s ease forwards; }
		.toast-img {
			width: 36px; height: 36px;
			border-radius: 8px;
			object-fit: cover;
			flex-shrink: 0;
		}
		.toast-check { width: 20px; height: 20px; fill: #4ade80; flex-shrink: 0; }
		@keyframes toastIn { from { opacity:0; transform:translateX(40px); } to { opacity:1; transform:translateX(0); } }
		@keyframes toastOut { from { opacity:1; transform:translateX(0); } to { opacity:0; transform:translateX(40px); } }

		/* Modal Overlay */
		.modal-overlay {
			position: fixed; inset: 0;
			background: rgba(0,0,0,.6);
			backdrop-filter: blur(4px);
			z-index: 9000;
			opacity: 0; visibility: hidden;
			transition: opacity .3s, visibility .3s;
		}
		.modal-overlay.open { opacity: 1; visibility: visible; }

		/* Modal Cart (slide-in) */
		.modal-cart {
			position: fixed;
			top: 0; right: 0;
			width: 420px; max-width: 100%;
			height: 100%;
			background: #141414;
			border-left: 1px solid var(--border);
			z-index: 9001;
			display: flex; flex-direction: column;
			transform: translateX(100%);
			transition: transform .35s cubic-bezier(.4,0,.2,1);
			box-shadow: -8px 0 32px rgba(0,0,0,.5);
		}
		.modal-overlay.open .modal-cart { transform: translateX(0); }

		.modal-header {
			display: flex; align-items: center;
			justify-content: space-between;
			padding: 20px 24px;
			border-bottom: 1px solid var(--border);
			flex-shrink: 0;
		}
		.modal-header h2 { margin: 0; font-size: 20px; font-weight: 800; }
		.modal-close {
			background: none; border: none;
			color: var(--muted); font-size: 28px;
			cursor: pointer;
			width: 36px; height: 36px;
			display: flex; align-items: center; justify-content: center;
			border-radius: 8px;
			transition: all .2s;
		}
		.modal-close:hover { background: rgba(255,255,255,.08); color: #fff; }

		.modal-body {
			flex: 1; overflow-y: auto;
			padding: 16px 24px;
		}
		.modal-body::-webkit-scrollbar { width: 4px; }
		.modal-body::-webkit-scrollbar-thumb { background: #333; border-radius: 4px; }
		.modal-empty {
			text-align: center; color: var(--muted);
			padding: 48px 0; font-style: italic;
		}

		.modal-item {
			display: flex; align-items: center;
			gap: 12px; padding: 14px 0;
			border-bottom: 1px solid rgba(255,255,255,.06);
		}
		.modal-item-img {
			width: 56px; height: 56px;
			border-radius: 10px;
			object-fit: cover;
			background: #1c1c1c;
			flex-shrink: 0;
		}
		.modal-item-info { flex: 1; min-width: 0; }
		.modal-item-name {
			font-weight: 700; font-size: 14px;
			white-space: nowrap; overflow: hidden;
			text-overflow: ellipsis;
		}
		.modal-item-price {
			font-size: 13px; color: #ffd60a;
			font-weight: 600; margin-top: 2px;
		}
		.modal-item-actions {
			display: flex; align-items: center;
			gap: 6px; flex-shrink: 0;
		}
		.modal-qty-btn {
			width: 28px; height: 28px;
			border-radius: 8px;
			border: 1px solid var(--border);
			background: var(--card);
			color: #fff;
			font-size: 16px; font-weight: 700;
			cursor: pointer;
			display: flex; align-items: center; justify-content: center;
			transition: all .15s;
			font-family: inherit;
		}
		.modal-qty-btn:hover { border-color: var(--accent); background: rgba(230,57,70,.12); }
		.modal-qty-btn.remove:hover { border-color: #ef4444; background: rgba(239,68,68,.12); }
		.modal-qty { font-weight: 700; font-size: 14px; min-width: 20px; text-align: center; }

		.modal-footer {
			padding: 16px 24px 24px;
			border-top: 1px solid var(--border);
			flex-shrink: 0;
			background: #141414;
		}
		.modal-total {
			display: flex; justify-content: space-between;
			font-weight: 700; font-size: 16px;
			margin-bottom: 14px;
		}
		.modal-total-value { color: #ffd60a; font-size: 20px; font-weight: 800; }
		.btn-checkout {
			display: block; width: 100%;
			text-align: center;
			background: var(--accent); color: #fff;
			border: none; padding: 14px;
			border-radius: 12px;
			font-weight: 700; font-size: 15px;
			cursor: pointer;
			text-decoration: none;
			transition: all .2s;
		}
		.btn-checkout:hover { background: var(--accent-strong); transform: translateY(-1px); }

		@media (max-width: 480px) {
			.modal-cart { width: 100%; }
			.btn-back { width: 36px; height: 36px; border-radius: 10px; }
			.btn-cart-open { padding: 8px 12px; font-size: 13px; }
		}
	</style>
</head>
<body>
	<div class="container">
		<header>
			<div style="display:flex; align-items:center; justify-content:space-between; gap:16px; flex-wrap:wrap;">
				<div style="display:flex; align-items:center; gap:12px;">
					<a href="index.php" class="btn-back" aria-label="Voltar ao início">
						<svg viewBox="0 0 24 24"><path d="M15.41 7.41L14 6l-6 6 6 6 1.41-1.41L10.83 12z"/></svg>
					</a>
					<div>
						<h1>Cardápio</h1>
						<p>Escolha sua categoria e encontre o seu favorito.</p>
					</div>
				</div>
				<button type="button" class="btn-cart-open" id="btn-open-cart" aria-label="Abrir carrinho">
					<svg viewBox="0 0 24 24"><path d="M7 18c-1.1 0-1.99.9-1.99 2S5.9 22 7 22s2-.9 2-2-.9-2-2-2zm10 0c-1.1 0-1.99.9-1.99 2S15.9 22 17 22s2-.9 2-2-.9-2-2-2zM7.17 14.75l.03-.12.9-1.63h7.45c.75 0 1.41-.41 1.75-1.03l3.58-6.49A1 1 0 0 0 20 4H5.21l-.94-2H1v2h2l3.6 7.59-1.35 2.44C4.52 15.37 5.48 17 7 17h12v-2H7.42c-.14 0-.25-.11-.25-.25z"/></svg>
					Carrinho
					<span id="cart-count" style="background:#1c1c1c; color:#ffd60a; padding:2px 10px; border-radius:999px; font-weight:700; border:1px solid #2a2a2a; font-size:13px;">0</span>
				</button>
			</div>
		</header>

		<nav class="tabs" id="categoryTabs">
			<button class="tab" data-id="all">Todos</button>
		</nav>

		<div id="status" class="state" style="display:none"></div>
		<div id="grid" class="grid"></div>
		<div class="cart" id="cart"></div>
	</div>

	<!-- Toast -->
	<div class="toast-container" id="toast-container"></div>

	<!-- Cart Modal -->
	<div class="modal-overlay" id="cart-overlay">
		<div class="modal-cart" id="cart-modal">
			<div class="modal-header">
				<h2>Seu Carrinho</h2>
				<button type="button" class="modal-close" id="btn-close-cart" aria-label="Fechar">&times;</button>
			</div>
			<div class="modal-body" id="modal-cart-items">
				<p class="modal-empty">Seu carrinho está vazio.</p>
			</div>
			<div class="modal-footer">
				<div class="modal-total">
					<span>Total</span>
					<span class="modal-total-value" id="modal-total">R$ 0,00</span>
				</div>
				<a href="carrinho" class="btn-checkout">Finalizar pedido</a>
			</div>
		</div>
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
						<button class="btn add-to-cart" type="button" data-id="${produto.produto_id}" data-nome="${produto.nome}" data-preco="${produto.preco}" data-img="${imgSrc}">Adicionar</button>
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
			window.adicionarAoCarrinho(button.dataset.id, button.dataset.nome, button.dataset.preco, button.dataset.img);
		});

		// ========= Modal Carrinho =========
		const cartOverlay = document.getElementById('cart-overlay');
		const btnOpenCart = document.getElementById('btn-open-cart');
		const btnCloseCart = document.getElementById('btn-close-cart');
		const modalCartItems = document.getElementById('modal-cart-items');
		const modalTotalEl = document.getElementById('modal-total');
		const toastContainer = document.getElementById('toast-container');

		function abrirModal() {
			cartOverlay.classList.add('open');
			document.body.style.overflow = 'hidden';
		}
		function fecharModal() {
			cartOverlay.classList.remove('open');
			document.body.style.overflow = '';
		}

		btnOpenCart.addEventListener('click', abrirModal);
		btnCloseCart.addEventListener('click', fecharModal);
		cartOverlay.addEventListener('click', (e) => { if (e.target === cartOverlay) fecharModal(); });
		document.addEventListener('keydown', (e) => { if (e.key === 'Escape') fecharModal(); });

		function renderizarModal(items) {
			if (!items || !items.length) {
				modalCartItems.innerHTML = '<p class="modal-empty">Seu carrinho está vazio.</p>';
				modalTotalEl.textContent = 'R$ 0,00';
				return;
			}
			let total = 0;
			modalCartItems.innerHTML = items.map(item => {
				const subtotal = item.preco * item.quantidade;
				total += subtotal;
				const imgHtml = item.imagem
					? `<img class="modal-item-img" src="${item.imagem}" alt="${item.nome}">`
					: `<div class="modal-item-img" style="display:flex;align-items:center;justify-content:center;font-size:22px;">🍔</div>`;
				return `
					<div class="modal-item">
						${imgHtml}
						<div class="modal-item-info">
							<div class="modal-item-name">${item.nome}</div>
							<div class="modal-item-price">R$ ${item.preco.toFixed(2).replace('.', ',')} × ${item.quantidade} = R$ ${subtotal.toFixed(2).replace('.', ',')}</div>
						</div>
						<div class="modal-item-actions">
							<button class="modal-qty-btn remove" data-id="${item.id}" data-action="remove" title="Remover">−</button>
							<span class="modal-qty">${item.quantidade}</span>
							<button class="modal-qty-btn" data-id="${item.id}" data-action="add" data-nome="${item.nome}" data-preco="${item.preco}" data-img="${item.imagem || ''}" title="Adicionar mais">+</button>
						</div>
					</div>`;
			}).join('');
			modalTotalEl.textContent = 'R$ ' + total.toFixed(2).replace('.', ',');
		}

		// +/- dentro do modal
		let suppressToast = false;
		modalCartItems.addEventListener('click', (e) => {
			const btn = e.target.closest('.modal-qty-btn');
			if (!btn) return;
			suppressToast = true;
			if (btn.dataset.action === 'remove') {
				window.removerDoCarrinho(btn.dataset.id);
			} else {
				window.adicionarAoCarrinho(btn.dataset.id, btn.dataset.nome, btn.dataset.preco, btn.dataset.img);
			}
			suppressToast = false;
		});

		// Toast feedback
		function mostrarToast(nome, imagem) {
			const toast = document.createElement('div');
			toast.className = 'toast';
			const imgHtml = imagem ? `<img class="toast-img" src="${imagem}" alt="">` : '';
			toast.innerHTML = `
				<svg class="toast-check" viewBox="0 0 24 24"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg>
				${imgHtml}
				<span>${nome} adicionado!</span>`;
			toastContainer.appendChild(toast);
			setTimeout(() => {
				toast.classList.add('out');
				toast.addEventListener('animationend', () => toast.remove());
			}, 2200);
		}

		// Callbacks do carrinho.js
		window.onCarrinhoRenderizado = function(items) {
			renderizarModal(items);
		};
		window.onItemAdicionado = function(nome, imagem) {
			if (!suppressToast) mostrarToast(nome, imagem);
		};
	</script>
	<script src="./../../../../assets/js/carrinho.js"></script>
</body>
</html>