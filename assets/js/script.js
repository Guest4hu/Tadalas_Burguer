// ========= Utilidades =========
const $ = (sel, ctx = document) => ctx.querySelector(sel);
const $$ = (sel, ctx = document) => Array.from(ctx.querySelectorAll(sel));

// Ano dinâmico no rodapé
$('#year').textContent = new Date().getFullYear();

// ========= Menu mobile acessível =========
const toggle = $('.menu-toggle');
const menu = $('#menu');

if (toggle && menu) {
  toggle.addEventListener('click', () => {
    const open = menu.classList.toggle('show');
    toggle.setAttribute('aria-expanded', open ? 'true' : 'false');
    const bars = $('.menu-bars', toggle);
    if (bars) bars.style.opacity = open ? '.0' : '1';
  });

  menu.addEventListener('click', e => {
    if (e.target.matches('a')) {
      menu.classList.remove('show');
      toggle.setAttribute('aria-expanded', 'false');
      const bars = $('.menu-bars', toggle);
      if (bars) bars.style.opacity = '1';
    }
  });
}

// ========= Hero dinâmico com produtos =========
const heroBg = $('#hero-bg');
const heroImg = $('#hero-product-img');
const heroName = $('#hero-product-name');
const heroPrice = $('#hero-product-price');
const heroInfo = $('#hero-product-info');

let heroProdutos = [];
let heroIndex = 0;
let heroAutoId = null;

function formatPreco(valor) {
  const num = Number(valor ?? 0);
  return num.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
}

function mostrarProdutoHero(produto) {
  const imgSrc = produto.caminho_imagem || '/backend/upload/img-1.avif';

  // Fade out
  heroImg.classList.remove('active');
  heroInfo.classList.remove('active');
  heroBg.classList.remove('active');

  setTimeout(() => {
    // Troca imagens e textos
    heroBg.style.backgroundImage = `url('${imgSrc}')`;
    heroImg.style.backgroundImage = `url('${imgSrc}')`;
    heroName.textContent = produto.nome;
    heroPrice.textContent = formatPreco(produto.preco);

    // Fade in
    heroBg.classList.add('active');
    heroImg.classList.add('active');
    heroInfo.classList.add('active');
  }, 400);
}

function heroNext() {
  if (!heroProdutos.length) return;
  heroIndex = (heroIndex + 1) % heroProdutos.length;
  mostrarProdutoHero(heroProdutos[heroIndex]);
}

function heroAutoPlay() {
  if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) return;
  heroAutoId = setInterval(heroNext, 4000);
}

async function carregarHeroProdutos() {
  try {
    const resp = await fetch('/backend/api/produtos');
    if (!resp.ok) throw new Error('Falha na rede');
    const json = await resp.json();
    heroProdutos = (json.data || []).slice(0, 8);

    if (heroProdutos.length) {
      mostrarProdutoHero(heroProdutos[0]);
      heroAutoPlay();
    }
  } catch (err) {
    console.error('Erro ao carregar produtos no hero:', err);
  }
}

carregarHeroProdutos();

// ========= Categorias dinâmicas =========
const catGrid = $('#cat-grid');

// Ícones SVG para cada categoria (fallback genérico se não mapeada)
const catIcons = {
  'default': '<svg viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 17.93c-3.95-.49-7-3.85-7-7.93 0-.62.08-1.21.21-1.79L9 15v1c0 1.1.9 2 2 2v1.93zm6.9-2.54c-.26-.81-1-1.39-1.9-1.39h-1v-3c0-.55-.45-1-1-1H8v-2h2c.55 0 1-.45 1-1V7h2c1.1 0 2-.9 2-2v-.41c2.93 1.19 5 4.06 5 7.41 0 2.08-.8 3.97-2.1 5.39z"/></svg>',
  'sandu': '<svg viewBox="0 0 24 24"><path d="M3 12a3 3 0 0 1 3-3h12a3 3 0 0 1 3 3v1H3v-1zM3 14h18v2a3 3 0 0 1-3 3H6a3 3 0 0 1-3-3v-2zM6 8a2 2 0 0 1 0-4h12a2 2 0 0 1 0 4H6z"/></svg>',
  'combo': '<svg viewBox="0 0 24 24"><path d="M7 2h10l1 4H6l1-4zm-1 6h12l-1.5 12h-9L6 8zm3 3v6h2v-6H9zm4 0v6h2v-6h-2z"/></svg>',
  'bebid': '<svg viewBox="0 0 24 24"><path d="M7 2h10v2H7V2zm2 4h6l-1 14a2 2 0 0 1-2 2h0a2 2 0 0 1-2-2L9 6z"/></svg>',
  'sobre': '<svg viewBox="0 0 24 24"><path d="M12 2l3 6 6 .5-4.5 4 1.5 6.5L12 16l-6 3 1.5-6.5L3 8.5 9 8l3-6z"/></svg>',
  'porco': '<svg viewBox="0 0 24 24"><path d="M3 12h18v2H3v-2zm2 4h14v3a3 3 0 0 1-3 3H8a3 3 0 0 1-3-3v-3zM6 5h12v2H6z"/></svg>',
  'acomp': '<svg viewBox="0 0 24 24"><path d="M3 12h18v2H3v-2zm2 4h14v3a3 3 0 0 1-3 3H8a3 3 0 0 1-3-3v-3zM6 5h12v2H6z"/></svg>',
  'hambu': '<svg viewBox="0 0 24 24"><path d="M3 12a3 3 0 0 1 3-3h12a3 3 0 0 1 3 3v1H3v-1zM3 14h18v2a3 3 0 0 1-3 3H6a3 3 0 0 1-3-3v-2zM6 8a2 2 0 0 1 0-4h12a2 2 0 0 1 0 4H6z"/></svg>',
  'lanche': '<svg viewBox="0 0 24 24"><path d="M3 12a3 3 0 0 1 3-3h12a3 3 0 0 1 3 3v1H3v-1zM3 14h18v2a3 3 0 0 1-3 3H6a3 3 0 0 1-3-3v-2zM6 8a2 2 0 0 1 0-4h12a2 2 0 0 1 0 4H6z"/></svg>',
  'doce': '<svg viewBox="0 0 24 24"><path d="M12 2l3 6 6 .5-4.5 4 1.5 6.5L12 16l-6 3 1.5-6.5L3 8.5 9 8l3-6z"/></svg>',
};

function buscarIcone(nome) {
  const n = (nome || '').toLowerCase();
  for (const key of Object.keys(catIcons)) {
    if (key !== 'default' && n.includes(key)) return catIcons[key];
  }
  return catIcons['default'];
}

function criarCatCard(cat, idx) {
  const a = document.createElement('a');
  a.className = 'cat cat-enter';
  a.setAttribute('role', 'listitem');
  a.href = 'cardapio.php';
  a.setAttribute('aria-label', cat.nome);
  a.style.animationDelay = `${idx * 0.08}s`;
  a.innerHTML = `
    <div class="cat-icon">${buscarIcone(cat.nome)}</div>
    <span class="cat-name">${cat.nome}</span>
  `;
  return a;
}

async function carregarCategorias() {
  try {
    const resp = await fetch('/backend/api/categorias');
    if (!resp.ok) throw new Error('Falha na rede');
    const json = await resp.json();
    const categorias = json.data || [];

    if (!categorias.length) {
      catGrid.innerHTML = '<p style="color:var(--muted); text-align:center; grid-column:1/-1;">Nenhuma categoria disponível.</p>';
      return;
    }

    catGrid.innerHTML = '';
    categorias.forEach((cat, i) => catGrid.appendChild(criarCatCard(cat, i)));

  } catch (err) {
    console.error('Erro ao carregar categorias:', err);
    catGrid.innerHTML = '<p style="color:var(--muted); text-align:center; grid-column:1/-1;">Erro ao carregar categorias.</p>';
  }
}

carregarCategorias();

// ========= Carrossel dinâmico de produtos =========
const track = $('.track');
const dotsWrap = $('.dots');
const prevBtn = $('.ctrl.prev');
const nextBtn = $('.ctrl.next');
const carouselEl = $('.carousel');
const loadingEl = $('.carousel-loading');

let slides = [];
let index = 0;
let autoplayId = null;
const prefersReduce = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

// Formata preço para BRL
function formatPreco(valor) {
  const num = Number(valor ?? 0);
  return num.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
}

// Cria HTML de um slide a partir de um produto da API
function criarSlide(produto) {
  const imgSrc = produto.caminho_imagem || '/backend/upload/img-1.avif';
  const article = document.createElement('article');
  article.className = 'slide';
  article.setAttribute('role', 'option');
  article.setAttribute('aria-label', produto.nome);
  article.innerHTML = `
    <div class="slide-media" role="img" aria-label="${produto.nome}"
         style="background-image:linear-gradient(rgba(0,0,0,.18),rgba(0,0,0,.18)), url('${imgSrc}')"></div>
    <div class="slide-copy">
      <h3>${produto.nome}</h3>
      <p>${produto.descricao || ''}</p>
      <div class="slide-price">
        <span class="price-label">a partir de</span>
        <span class="price-value">${formatPreco(produto.preco)}</span>
      </div>
      <a href="cardapio.php" class="btn btn-primary">Pedir agora</a>
    </div>
  `;
  return article;
}

// Popula o carrossel com produtos da API
async function carregarDestaques() {
  try {
    const resp = await fetch('/backend/api/produtos');
    if (!resp.ok) throw new Error('Falha na rede');
    const json = await resp.json();
    const produtos = (json.data || []).slice(0, 6); // máx 6 slides

    if (!produtos.length) {
      if (loadingEl) loadingEl.textContent = 'Nenhum produto disponível no momento.';
      if (loadingEl) loadingEl.className = 'carousel-empty';
      return;
    }

    // Insere slides no track
    track.innerHTML = '';
    produtos.forEach(p => track.appendChild(criarSlide(p)));
    slides = $$('.slide', track);

    // Remove loading
    if (loadingEl) loadingEl.remove();

    // Monta dots e inicia
    criarDots();
    updateCarousel();
    autoPlay();

    // Eventos de navegação
    prevBtn.addEventListener('click', () => { go(-1); stopAuto(); });
    nextBtn.addEventListener('click', () => { go(1); stopAuto(); });
    carouselEl.addEventListener('mouseenter', stopAuto);
    carouselEl.addEventListener('mouseleave', autoPlay);

    // Swipe mobile
    let touchX = 0;
    carouselEl.addEventListener('touchstart', e => { touchX = e.touches[0].clientX; }, { passive: true });
    carouselEl.addEventListener('touchend', e => {
      const delta = e.changedTouches[0].clientX - touchX;
      if (Math.abs(delta) > 50) { go(delta < 0 ? 1 : -1); stopAuto(); }
    }, { passive: true });

  } catch (err) {
    console.error('Erro ao carregar destaques:', err);
    if (loadingEl) {
      loadingEl.textContent = 'Não foi possível carregar os produtos.';
      loadingEl.className = 'carousel-empty';
    }
  }
}

function updateCarousel() {
  if (!slides.length) return;
  const offset = -index * 100;
  track.style.transform = `translateX(${offset}%)`;
  $$('.dots button', dotsWrap).forEach((b, i) =>
    b.setAttribute('aria-selected', i === index ? 'true' : 'false')
  );
}

function go(dir) {
  if (!slides.length) return;
  index = (index + dir + slides.length) % slides.length;
  updateCarousel();
}

function criarDots() {
  dotsWrap.innerHTML = '';
  slides.forEach((_, i) => {
    const b = document.createElement('button');
    b.type = 'button';
    b.setAttribute('aria-label', `Ir para o slide ${i + 1}`);
    b.setAttribute('aria-selected', 'false');
    b.addEventListener('click', () => { index = i; updateCarousel(); stopAuto(); });
    dotsWrap.appendChild(b);
  });
}

function autoPlay() {
  if (prefersReduce) return;
  stopAuto();
  autoplayId = setInterval(() => go(1), 5000);
}
function stopAuto() { if (autoplayId) clearInterval(autoplayId); autoplayId = null; }

// Inicia o carrossel
carregarDestaques();
