// ========= Utilidades =========
const $ = (sel, ctx = document) => ctx.querySelector(sel);
const $$ = (sel, ctx = document) => Array.from(ctx.querySelectorAll(sel));

// Ano dinâmico no rodapé
$('#year').textContent = new Date().getFullYear();

// ========= Menu mobile acessível ====== 
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
const slides = $$('.slide', track);
const dotsWrap = $('.dots');
const prevBtn = $('.ctrl.prev');
const nextBtn = $('.ctrl.next');

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
  slides.forEach((_, i) => {
    const b = document.createElement('button');
    b.type = 'button';
    b.setAttribute('aria-label', `Ir para o slide ${i + 1}`);
    b.addEventListener('click', () => { index = i; updateCarousel(); stopAuto(); });
    dotsWrap.appendChild(b);
  });
}

function auto() {
  if (prefersReduce) return;
  autoplayId = setInterval(() => go(1), 4500);
}
function stopAuto() { if (autoplayId) clearInterval(autoplayId); autoplayId = null; }

createDots();
updateCarousel();
auto();

prevBtn.addEventListener('click', () => { go(-1); stopAuto(); });
nextBtn.addEventListener('click', () => { go(1);  stopAuto(); });
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

// Adicionar itens ao pedido
addButtons.forEach(btn => {
  btn.addEventListener('click', () => {
    const card = btn.closest('.card');
    const nome = card.querySelector('h3').innerText;
    const precoText = card.querySelector('.price').innerText;
    const preco = parseFloat(precoText.replace('R$', '').replace(',', '.'));

    pedidoItens.push({ nome, preco });
    atualizarPedido();
  });
});

// Atualiza textarea com itens + total
function atualizarPedido() {
  let texto = '';
  let total = 0;
  pedidoItens.forEach(item => {
    texto += `${item.nome} - R$ ${item.preco.toFixed(2).replace('.', ',')}\n`;
    total += item.preco;
  });
  texto += `\nTotal: R$ ${total.toFixed(2).replace('.', ',')}`;
  pedidoTextarea.value = texto;
}

// Submissão do formulário com WhatsApp
if (form) {
  form.addEventListener('submit', (e) => {
    e.preventDefault();

    if (!nomeInput.value.trim() || !telInput.value.trim() || pedidoItens.length === 0) {
      alert('Por favor, preencha nome, telefone e adicione pelo menos um item ao pedido.');
      return;
    }

    let mensagem = `Olá, meu nome é ${nomeInput.value.trim()}.\n`;
    if (endInput.value.trim()) mensagem += `Endereço: ${endInput.value.trim()}\n`;
    mensagem += `Telefone: ${telInput.value.trim()}\n`;
    mensagem += `Meu pedido:\n${pedidoTextarea.value}`;

    const msgEncoded = encodeURIComponent(mensagem);
    const numero = '5511917896030'; // Número da hamburgueria

    window.open(`https://wa.me/${numero}?text=${msgEncoded}`, '_blank');

    form.reset();
    pedidoItens = [];
    atualizarPedido();
  });
}
