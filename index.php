<?php
  session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Tadallas Hamburgueria — Artesanal, intenso e inesquecível</title>
  <meta name="description" content="Tadallas Hamburgueria: hambúrguer artesanal com ingredientes frescos, grelhado no fogo e muito sabor. Peça online ou retire no balcão." />
  <?php 
   if (isset($_SESSION['usuario_id'])) {
    echo '<input type="hidden" id="usuario_id" value="' . htmlspecialchars($_SESSION['usuario_id'] ?? '') . '">';
    echo '<input type="hidden" id="usuario_nome" value="' . htmlspecialchars($_SESSION['nome'] ?? '') . '">';
    echo '<input type="hidden" id="usuario_email" value="' . htmlspecialchars($_SESSION['email'] ?? '') . '">';
   } 
  
  ?>

  <!-- Fonte -->
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap" rel="stylesheet">

  <!-- CSS -->
  <link rel="stylesheet" href="assets/css/style.css" />

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
          <li role="none"><a role="menuitem" href="cardapio.php">Cardápio</a></li>
          <li role="none"><a role="menuitem" href="#categorias">Categorias</a></li>
          <li role="none"><a role="menuitem" href="#sobre">Sobre</a></li>
          <li role="none"><a role="menuitem" href="cardapio.php" class="btn btn-primary">Peça Online</a></li>
          <li>
            <div id="UserLogin"></div>
          </li>
        </ul>
      </nav>
    </div>
  </header>

  <main id="conteudo">
    <!-- HERO DINÂMICO COM PRODUTOS -->
    <section class="hero" aria-labelledby="tit-hero">
      <!-- Imagem de fundo borrada (injetada via JS) -->
      <div class="hero-bg" id="hero-bg" aria-hidden="true"></div>
      <div class="hero-overlay" aria-hidden="true"></div>

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

        <!-- Card do produto dinâmico -->
        <div class="hero-product" id="hero-product">
          <div class="hero-product-img" id="hero-product-img"></div>
          <div class="hero-product-info" id="hero-product-info">
            <span class="hero-product-name" id="hero-product-name"></span>
            <span class="hero-product-price" id="hero-product-price"></span>
          </div>
        </div>
      </div>
    </section>

    <!-- CATEGORIAS DINÂMICAS -->
    <section id="categorias" class="categories" aria-labelledby="tit-categorias">
      <div class="container">
        <div class="categories-head">
          <h2 id="tit-categorias">Escolha por categoria</h2>
          <p class="categories-sub">Encontre exatamente o que você está com vontade</p>
        </div>
        <div class="cat-grid" id="cat-grid" role="list">
          <!-- Skeleton loading -->
          <div class="cat cat-skeleton" aria-hidden="true"><div class="skeleton-icon"></div><div class="skeleton-text"></div></div>
          <div class="cat cat-skeleton" aria-hidden="true"><div class="skeleton-icon"></div><div class="skeleton-text"></div></div>
          <div class="cat cat-skeleton" aria-hidden="true"><div class="skeleton-icon"></div><div class="skeleton-text"></div></div>
          <div class="cat cat-skeleton" aria-hidden="true"><div class="skeleton-icon"></div><div class="skeleton-text"></div></div>
          <div class="cat cat-skeleton" aria-hidden="true"><div class="skeleton-icon"></div><div class="skeleton-text"></div></div>
        </div>
      </div>
    </section>

    <!-- DESTAQUES DE PRODUTOS (dinâmico via API) -->
    <section id="destaques" class="promos" aria-labelledby="tit-promos">
      <div class="container promos-head">
        <h2 id="tit-promos">Destaques da semana</h2>
        <div class="promo-ctrl">
          <button class="ctrl prev" aria-label="Anterior" data-dir="prev">‹</button>
          <button class="ctrl next" aria-label="Próximo" data-dir="next">›</button>
        </div>
      </div>

      <div class="container">
        <div class="carousel" aria-roledescription="carrossel" aria-label="Produtos em destaque">
          <div class="track" role="listbox">
            <!-- Slides carregados dinamicamente via JS -->
          </div>
          <div class="carousel-loading">Carregando produtos...</div>
        </div>
        <div class="dots" role="tablist" aria-label="Indicadores do carrossel"></div>
      </div>
    </section>


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

    <section id="userOrder"></section>

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


  <script src="assets/js/login/login.js" type="module"></script>
   <script src="assets/js/script.js"></script>
</body>

</html>