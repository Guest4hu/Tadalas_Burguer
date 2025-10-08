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
          <li role="none"><a role="menuitem" href="#cardapio">Cardápio</a></li>
          <li role="none"><a role="menuitem" href="#categorias">Categorias</a></li>
          <li role="none"><a role="menuitem" href="#promocoes">Promoções</a></li>
          <li role="none"><a role="menuitem" href="#sobre">Sobre</a></li>
          <li role="none"><a role="menuitem" href="#contato" class="btn btn-primary">Peça Online</a></li>
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
            <a href="#cardapio" class="btn btn-primary">Ver cardápio</a>
            <a href="#contato" class="btn btn-outline">Pedir agora</a>
          </div>
          <ul class="hero-badges" aria-label="Diferenciais">
            <li>🍖 Carne Angus</li>
            <li>🧀 Cheddar real</li>
            <li>🔥 Grelhado no fogo</li>
          </ul>
        </div>
        <!-- Imagem de fundo sugerida via CSS. Alternativamente, você pode usar <img> com alt apropriado. -->
      </div>
    </section>

    <!-- CATEGORIAS / ATALHOS -->
    <section id="categorias" class="categories" aria-labelledby="tit-categorias">
      <div class="container">
        <h2 id="tit-categorias">Escolha por categoria</h2>
        <div class="cat-grid" role="list">
          <!-- Ícones SVG inline para performance -->
          <a class="cat" role="listitem" href="#cardapio" aria-label="Sanduíches">
            <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M3 12a3 3 0 0 1 3-3h12a3 3 0 0 1 3 3v1H3v-1zM3 14h18v2a3 3 0 0 1-3 3H6a3 3 0 0 1-3-3v-2zM6 8a2 2 0 0 1 0-4h12a2 2 0 0 1 0 4H6z"/></svg>
            <span>Sanduíches</span>
          </a>
          <a class="cat" role="listitem" href="#cardapio" aria-label="Combos">
            <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M7 2h10l1 4H6l1-4zm-1 6h12l-1.5 12h-9L6 8zm3 3v6h2v-6H9zm4 0v6h2v-6h-2z"/></svg>
            <span>Combos</span>
          </a>
          <a class="cat" role="listitem" href="#cardapio" aria-label="Bebidas">
            <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M7 2h10v2H7V2zm2 4h6l-1 14a2 2 0 0 1-2 2h0a2 2 0 0 1-2-2L9 6z"/></svg>
            <span>Bebidas</span>
          </a>
          <a class="cat" role="listitem" href="#cardapio" aria-label="Sobremesas">
            <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M12 2l3 6 6 .5-4.5 4 1.5 6.5L12 16l-6 3 1.5-6.5L3 8.5 9 8l3-6z"/></svg>
            <span>Sobremesas</span>
          </a>
          <a class="cat" role="listitem" href="#cardapio" aria-label="Acompanhamentos">
            <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M3 12h18v2H3v-2zm2 4h14v3a3 3 0 0 1-3 3H8a3 3 0 0 1-3-3v-3zM6 5h12v2H6z"/></svg>
            <span>Acompanh.</span>
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
          <!-- Slide 1 -->
          <article class="slide" role="option" aria-label="Dallas Burger com cheddar e bacon">
            <div class="slide-media slide-1" role="img" aria-label="Close de hambúrguer com cheddar derretido"></div>
            <div class="slide-copy">
              <h3>Dallas Burger</h3>
              <p>Carne 180g, cheddar de verdade e bacon crocante. Peça no combo e ganhe desconto.</p>
              <a href="#cardapio" class="btn btn-primary">Quero provar</a>
            </div>
          </article>

          <!-- Slide 2 -->
          <article class="slide" role="option" aria-label="Texano Picante com jalapeños">
            <div class="slide-media slide-2" role="img" aria-label="Hambúrguer picante com jalapeños"></div>
            <div class="slide-copy">
              <h3>Texano Picante</h3>
              <p>Pimenta na medida certa, molho especial e crocância. Calor que vicia.</p>
              <a href="#cardapio" class="btn btn-primary">Quero o Texano</a>
            </div>
          </article>

          <!-- Slide 3 -->
          <article class="slide" role="option" aria-label="McShake da casa (exemplo de sobremesa)">
            <div class="slide-media slide-3" role="img" aria-label="Milk-shake cremoso em copo alto"></div>
            <div class="slide-copy">
              <h3>Shake Tadallas</h3>
              <p>Sobremesa cremosa para fechar com chave de ouro. Chocolate ou baunilha.</p>
              <a href="#cardapio" class="btn btn-primary">Ver sobremesas</a>
            </div>
          </article>
        </div>
      </div>
      <div class="dots" role="tablist" aria-label="Indicadores do carrossel"></div>
    </section>

    <!-- CARDÁPIO (GRID) -->
    <section id="cardapio" class="menu" aria-labelledby="tit-cardapio">
      <div class="container">
        <h2 id="tit-cardapio">Cardápio</h2>

        <div class="menu-grid">
          <!-- Card -->
          <article class="card">
            <div class="card-img img-1" role="img" aria-label="Hambúrguer artesanal com cheddar"></div>
            <div class="card-body">
              <h3>Dallas Burger</h3>
              <p>Pão brioche, carne 120g, cheddar e bacon.</p>
              <div class="card-foot">
                <span class="price">R$ 29,90</span>
                <button class="btn btn-outline add" aria-label="Adicionar Dallas Burger ao pedido">Adicionar</button>
              </div>
            </div>
          </article>

          <article class="card">
            <div class="card-img img-2" role="img" aria-label="Hambúrguer picante com jalapeños"></div>
            <div class="card-body">
              <h3>Texano Picante</h3>
              <p>Jalapeños, pepper jack e molho especial.</p>
              <div class="card-foot">
                <span class="price">R$ 31,90</span>
                <button class="btn btn-outline add" aria-label="Adicionar Texano Picante ao pedido">Adicionar</button>
              </div>
            </div>
          </article>

          <article class="card">
            <div class="card-img img-3" role="img" aria-label="Hambúrguer duplo com barbecue"></div>
            <div class="card-body">
              <h3>BBQ Supreme</h3>
              <p>Duplo smash, cebola caramelizada e BBQ.</p>
              <div class="card-foot">
                <span class="price">R$ 34,90</span>
                <button class="btn btn-outline add" aria-label="Adicionar BBQ Supreme ao pedido">Adicionar</button>
              </div>
            </div>
          </article>

          <article class="card">
            <div class="card-img img-4" role="img" aria-label="Porção de batatas crocantes"></div>
            <div class="card-body">
              <h3>Batatas Crocantes</h3>
              <p>Porção generosa com sal da casa.</p>
              <div class="card-foot">
                <span class="price">R$ 14,90</span>
                <button class="btn btn-outline add" aria-label="Adicionar Batatas Crocantes ao pedido">Adicionar</button>
              </div>
            </div>
          </article>

          <article class="card">
            <div class="card-img img-5" role="img" aria-label="Milk-shake de chocolate"></div>
            <div class="card-body">
              <h3>Shake Chocolate</h3>
              <p>Feito com sorvete cremoso e calda.</p>
              <div class="card-foot">
                <span class="price">R$ 17,90</span>
                <button class="btn btn-outline add" aria-label="Adicionar Shake Chocolate ao pedido">Adicionar</button>
              </div>
            </div>
          </article>

          <article class="card">
            <div class="card-img img-6" role="img" aria-label="Refrigerante gelado"></div>
            <div class="card-body">
              <h3>Refrigerante</h3>
              <p>Lata gelo — vários sabores.</p>
              <div class="card-foot">
                <span class="price">R$ 7,90</span>
                <button class="btn btn-outline add" aria-label="Adicionar Refrigerante ao pedido">Adicionar</button>
              </div>
            </div>
          </article>
        </div>
      </div>
    </section>

    <!-- SOBRE -->
    <section id="sobre" class="about" aria-labelledby="tit-sobre">
      <div class="container about-grid">
        <div>
          <h2 id="tit-sobre">Sobre a Tadallas</h2>
          <p>Somos apaixonados por grelha e ingredientes honestos. A Tadallas nasceu para entregar um hambúrguer com alma: crosta perfeita, queijo de verdade e molhos autorais.</p>
          <ul class="list-check">
            <li>Ingredientes selecionados e frescos</li>
            <li>Padrão de preparo com controle de temperatura</li>
            <li>Opções vegetarianas sob demanda</li>
          </ul>
        </div>
        <aside class="about-card" aria-label="Horários e localização">
          <h3>Visite ou peça online</h3>
          <p><strong>Seg–Dom:</strong> 11h às 23h</p>
          <p><strong>Endereço:</strong> Rua da Grelha, 123 — São Paulo/SP</p>
          <a href="#contato" class="btn btn-primary">Fazer pedido</a>
        </aside>
      </div>
    </section>

    <!-- CONTATO / PEDIDO -->
    <section id="contato" class="contact" aria-labelledby="tit-contato">
      <div class="container">
        <h2 id="tit-contato">Peça agora</h2>
        <form class="form" aria-describedby="form-help" novalidate>
          <div class="field">
            <label for="nome">Nome</label>
            <input id="nome" name="nome" type="text" autocomplete="name" required />
          </div>
          <div class="field">
            <label for="tel">Telefone</label>
            <input id="tel" name="tel" type="tel" inputmode="tel" autocomplete="tel" required />
          </div>
          <div class="field">
            <label for="end">Endereço (para delivery)</label>
            <input id="end" name="end" type="text" autocomplete="street-address" />
          </div>
          <div class="field full">
            <label for="pedido">Seu pedido</label>
            <textarea id="pedido" name="pedido" rows="4" required readonly placeholder="adicione o seu pedido"></textarea>
          </div>
          <p id="form-help" class="muted">Confirmaremos seu pedido por WhatsApp/SMS.</p>
          <button type="submit" class="btn btn-primary">Enviar pedido</button>
        </form>
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
          <li><a href="#cardapio">Cardápio</a></li>
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

  <!-- JS -->
  <script src="assets/javascript/script.js"></script>
</body>
</html>
