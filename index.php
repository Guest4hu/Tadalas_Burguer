<?php
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Tadallas Hamburgueria — Artesanal, intenso e inesquecível</title>
  <meta name="description" content="Tadallas Hamburgueria: hambúrguer artesanal com ingredientes frescos, grelhado no fogo e muito sabor. Peça online ou retire no balcão." />

  <!-- Fonte -->
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap" rel="stylesheet">

  <!-- CSS -->
  <link rel="stylesheet" href="assets/css/style.css" />
  <link rel="stylesheet" href="assets/css/cart-drawer.css" />

  <!-- Favicon (opcional) -->
  <link rel="icon" href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 64 64'%3E%3Ctext y='52' x='6' font-size='52'%3E%F0%9F%8D%94%3C/text%3E%3C/svg%3E">
</head>

<body>
  <!-- Link para pular direto ao conteúdo com teclado -->
  <a class="skip-link" href="#conteudo">Pular para o conteúdo</a>

  <!-- Cabeçalho fixo -->
  <header class="site-header" role="banner">
    <div class="container">
      <nav class="navbar" aria-label="Navegação principal">
        <a class="brand" href="#" aria-label="Página inicial Tadallas">
          <span class="brand-mark" aria-hidden="true">🍔</span>
          <span class="brand-name">Tadallas</span>
        </a>

        <button class="menu-toggle" aria-expanded="false" aria-controls="menu" aria-label="Abrir menu">
          <span class="menu-bars" aria-hidden="true"></span>
        </button>

        <ul id="menu" class="nav-links" role="menubar">
          <li role="none"><a role="menuitem" href="cardapio">Cardápio</a></li>
          <li role="none"><a role="menuitem" href="#categorias">Categorias</a></li>
          <li role="none"><a role="menuitem" href="#sobre">Sobre</a></li>
          <li role="none"><a role="menuitem" href="Cardapio" class="btn btn-primary">Peça Online</a></li>
          <li>
            <a href="#carrinho" class="cart-link" aria-label="Ir para o carrinho">
              <svg class="icon-cart" viewBox="0 0 24 24" aria-hidden="true">
                <path d="M7 18c-1.1 0-1.99.9-1.99 2S5.9 22 7 22s2-.9 2-2-.9-2-2-2zm10 0c-1.1 0-1.99.9-1.99 2S15.9 22 17 22s2-.9 2-2-.9-2-2-2zM7.16 14h9.69c.75 0 1.41-.41 1.75-1.03l3.58-6.49A1 1 0 0 0 21.31 5H6.21L5.27 3.57A2 2 0 0 0 3.61 3H2a1 1 0 0 0 0 2h1.61l3.6 5.59-1.35 2.44A2 2 0 0 0 7.16 14zM7.42 7h12.61l-2.8 5H8.53L7.42 7z" />
              </svg>
            </a>
          </li>
          <li>
            <a href="login.php" class="user-link" aria-label="Acessar conta">
               <svg class="icon-user" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                  <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
               </svg>
            </a>
          </li>
        </ul>
      </nav>
    </div>
  </header>

  <main id="conteudo">
    <!-- HERO -->
    <section class="hero" aria-labelledby="tit-hero">
      <div class="container hero-inner">
        <div class="hero-copy">
          <h1 id="tit-hero">Hambúrguer artesanal, intenso e inesquecível.</h1>
          <p>Na Tadallas, cada mordida entrega fogo, textura e ingredientes frescos. Experimente nossos clássicos ou os lançamentos da semana.</p>
          <div class="hero-cta">
            <a href="cardapio.php" class="btn btn-primary">Ver cardápio</a>
            <a href="cardapio.php" class="btn btn-outline">Pedir agora</a>
          </div>
          <ul class="hero-badges" aria-label="Diferenciais">
            <li>🍖 Carne Angus</li>
            <li>🧀 Cheddar real</li>
            <li>🔥 Grelhado no fogo</li>
          </ul>
        </div>

      </div>
    </section>

    <!-- CATEGORIAS / ATALHOS -->
    <section id="categorias" class="categories" aria-labelledby="tit-categorias">
      <div class="container">
        <h2 id="tit-categorias">Escolha por categoria</h2>
        <div class="cat-grid" role="list">
          <!-- Ícones SVG inline para performance -->
          <a class="cat" role="listitem" href="cardapio.php" aria-label="Sanduíches">
            <svg viewBox="0 0 24 24" aria-hidden="true">
              <path d="M3 12a3 3 0 0 1 3-3h12a3 3 0 0 1 3 3v1H3v-1zM3 14h18v2a3 3 0 0 1-3 3H6a3 3 0 0 1-3-3v-2zM6 8a2 2 0 0 1 0-4h12a2 2 0 0 1 0 4H6z" />
            </svg>
            <span>Sanduíches</span>
          </a>
          <a class="cat" role="listitem" href="cardapio.php" aria-label="Combos">
            <svg viewBox="0 0 24 24" aria-hidden="true">
              <path d="M7 2h10l1 4H6l1-4zm-1 6h12l-1.5 12h-9L6 8zm3 3v6h2v-6H9zm4 0v6h2v-6h-2z" />
            </svg>
            <span>Combos</span>
          </a>
          <a class="cat" role="listitem" href="cardapio.php" aria-label="Bebidas">
            <svg viewBox="0 0 24 24" aria-hidden="true">
              <path d="M7 2h10v2H7V2zm2 4h6l-1 14a2 2 0 0 1-2 2h0a2 2 0 0 1-2-2L9 6z" />
            </svg>
            <span>Bebidas</span>
          </a>
          <a class="cat" role="listitem" href="cardapio.php" aria-label="Sobremesas">
            <svg viewBox="0 0 24 24" aria-hidden="true">
              <path d="M12 2l3 6 6 .5-4.5 4 1.5 6.5L12 16l-6 3 1.5-6.5L3 8.5 9 8l3-6z" />
            </svg>
            <span>Sobremesas</span>
          </a>
          <a class="cat" role="listitem" href="cardapio.php" aria-label="Acompanhamentos">
            <svg viewBox="0 0 24 24" aria-hidden="true">
              <path d="M3 12h18v2H3v-2zm2 4h14v3a3 3 0 0 1-3 3H8a3 3 0 0 1-3-3v-3zM6 5h12v2H6z" />
            </svg>
            <span>Porçoões</span>
          </a>
        </div>
      </div>
    </section>

    <!-- CARROSSEL DE PROMOÇÕES -->
    <section id="promocoes" class="promos" aria-labelledby="tit-promos">
      <div class="container promos-head">
        <h2 id="tit-promos">Destaques da semana</h2>
        <div class="promo-ctrl">
          <button class="ctrl prev" aria-label="Anterior" data-dir="prev">‹</button>
          <button class="ctrl next" aria-label="Próximo" data-dir="next">›</button>
        </div>
      </div>

      <div class="carousel" aria-roledescription="carrossel" aria-label="Banners promocionais">
        <div class="track" role="listbox">



    <section id="sobre" class="about" aria-labelledby="tit-sobre">
      <div class="container about-grid">
        <div>
          <h2 id="tit-sobre">Sobre a Tadallas</h2>
          <p>Somos apaixonados por grelha e ingredientes honestos. A Tadallas nasceu para entregar um hambúrguer com alma: crosta perfeita, queijo de verdade e molhos autorais.</p>
          <ul class="list-check">
            <li>Ingredientes selecionados e frescos</li>
            <li>Padrão de preparo com controle de temperatura</li>
          </ul>
        </div>
        <aside class="about-card" aria-label="Horários e localização">
          <h3>Visite ou peça online</h3>
          <p><strong>Seg–Dom:</strong> 11h às 23h</p>
          <p><strong>Endereço:</strong> Rua conceiçao do almeida numero: 88</p>
          <a href="cardapio.php" class="btn btn-primary">Fazer pedido</a>
        </aside>
      </div>
    </section>

  </main>

  <!-- RODAPÉ -->
  <footer class="site-footer" role="contentinfo">
    <div class="container footer-grid">
      <div>
        <a class="brand brand-footer" href="#">
          <span class="brand-mark" aria-hidden="true">🍔</span>
          <span class="brand-name">Tadallas</span>
        </a>
        <p class="muted">Hamburgueria artesanal — desde 2025.</p>
      </div>
      <nav aria-label="Links úteis">
        <ul class="footer-links">
          <li><a href="cardapio.php">Cardápio</a></li>
          <li><a href="#sobre">Sobre</a></li>
          <li><a href="#contato">Contato</a></li>
          <li><a href="#" aria-disabled="true">Política de Privacidade</a></li>
        </ul>
      </nav>
      <div class="footer-copy">
        <small>© <span id="year"></span> Tadallas Hamburgueria. Todos os direitos reservados.</small>
      </div>
    </div>
  </footer>


   <script src="assets/js/script.js"></script>
   
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