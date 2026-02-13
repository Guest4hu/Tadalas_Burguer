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

// ========= Carrossel leve =========
const track = $('.track');
const dotsWrap = $('.dots');
const prevBtn = $('.ctrl.prev');
const nextBtn = $('.ctrl.next');

let slides = $$('.slide', track);
let index = 0;
let autoplayId = null;
const prefersReduce = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

function updateCarousel() {
  const offset = -index * 100;
  track.style.transform = `translateX(${offset}%)`;
  $$('.dots button', dotsWrap).forEach((b, i) => b.setAttribute('aria-selected', i === index ? 'true' : 'false'));
}

function go(dir) {
  index = (index + dir + slides.length) % slides.length;
  updateCarousel();
}

function createDots() {
  dotsWrap.innerHTML = '';
  slides.forEach((_, i) => {
    const b = document.createElement('button');
    b.type = 'button';
    b.setAttribute('aria-label', `Ir para o slide ${i + 1}`);
    b.addEventListener('click', () => { index = i; updateCarousel(); stopAuto(); });
    dotsWrap.appendChild(b);
  });
}

function auto() {
  if (prefersReduce || slides.length <= 1) return;
  autoplayId = setInterval(() => go(1), 4500);
}
function stopAuto() { if (autoplayId) clearInterval(autoplayId); autoplayId = null; }

function buildSlidesFromProdutos(produtos) {
  if (!track) return;
  const promoProdutos = produtos.slice(0, 5);
  track.innerHTML = promoProdutos.map((produto, idx) => {
    const nome = produto.nome || `Produto ${idx + 1}`;
    const descricao = produto.descricao || 'Conheça este sabor da casa.';
    const caminho = produto.caminho_imagem || '/backend/upload/img-1.avif';
    return `
      <article class="slide" role="option" aria-label="${nome}">
        <div class="slide-media" style="background-image:url('${caminho}')" role="img" aria-label="${nome}"></div>
        <div class="slide-copy">
          <h3>${nome}</h3>
          <p>${descricao}</p>
          <a href="cardapio.php" class="btn btn-primary">Quero provar</a>
        </div>
      </article>
    `;
  }).join('');
  slides = $$('.slide', track);
}

function initCarousel() {
  if (!track || slides.length === 0) return;
  createDots();
  index = 0;
  updateCarousel();
  stopAuto();
  auto();
}

async function loadCarousel() {
  if (!track) return;
  try {
    const response = await fetch('/backend/api/produtos');
    if (!response.ok) throw new Error('Falha ao carregar produtos');
    const payload = await response.json();
    const produtos = Array.isArray(payload.data) ? payload.data : [];
    if (produtos.length) {
      buildSlidesFromProdutos(produtos);
    }
  } catch (error) {
    console.error('Erro ao carregar carrossel dinâmico:', error);
  }
  initCarousel();
}

loadCarousel();

prevBtn.addEventListener('click', () => { go(-1); stopAuto(); });
nextBtn.addEventListener('click', () => { go(1); stopAuto(); });
$('.carousel').addEventListener('mouseenter', stopAuto);
$('.carousel').addEventListener('mouseleave', auto);

// ========= Pedido e WhatsApp =========
const addButtons = $$('.card .add');
const pedidoTextarea = $('#pedido');
const nomeInput = $('#nome');
const telInput = $('#tel');
const endInput = $('#end');
const form = $('.form');

let pedidoItens = [];







//                                "Se der erro, deu erro"
//                                          - Vitão, 2025
document.addEventListener('DOMContentLoaded',
  function () {
    const container = document.querySelector('.menu-grid');
    const content = document.querySelector('.menu-grid').innerHTML

    if (!container) return;
    container.innerHTML = '<h3>Carregando serviços ...</h3>';
    fetch('/backend/api/produtos')
      .then(response => {
        if (!response.ok) {
          throw new Error('Falha ao carregar dados da rede.');
        }
        return response.json();
      })
      .then(json => {
        if (json.status !== 'success' || !json.data) {
          throw new Error('API retornou um erro: ' + (json.message || 'Formato inválido'));
        }
        console.log(json.data)
        container.innerHTML = content
        let n = 0
        console.log(json)
        json.data.forEach(produto => {

          // Muda as informações sobre o produto
          alterarCards(container, n, produto)
          
          // nome das classes inicia em 1
          n++

          // Muda a foto dos produtos
          document.querySelector(`.img-${n}`).style.background = `url('../..${produto.caminho_imagem}')`
          document.querySelector(`.img-${n}`).style.backgroundSize = 'cover'
          document.querySelector(`.img-${n}`).style.backgroundPosition = 'center'

        });

        // Sinaliza que os cards do menu foram reconstruídos
        document.dispatchEvent(new CustomEvent('menu-ready'));
      })
      .catch(error => {
        console.error('Erro ao buscar serviços:', error);
        container.innerHTML = '<p style="color: red;">Não foi possível carregar os serviços no momento. Tente novamente mais tarde.</p>';
      });
  }
);

function alterarCards(container, i, produto) {
  array_preco = produto.preco.split(".")
  preco = 'R$ ' + array_preco[0] + ',' + array_preco[1]

  container.children[i].children[1].children[0].value = produto.produto_id
  container.children[i].children[1].children[1].innerHTML = produto.nome
  container.children[i].children[1].children[2].innerHTML = produto.descricao
  container.children[i].children[1].children[3].children[0].innerHTML = preco
}
