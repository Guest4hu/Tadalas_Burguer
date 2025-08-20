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

    // Animação do ícone hamburguer (opcional simples)
    const bars = $('.menu-bars', toggle);
    if (!bars) return;
    bars.style.opacity = open ? '.0' : '1';
  });

  // Fecha ao navegar (mobile)
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
  // Dots
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

// ========= Formulário: validação leve (HTML5 + UX) =========
const form = $('.form');
if (form) {
  form.addEventListener('submit', (e) => {
    e.preventDefault();
    const required = $$('[required]', form).every(el => el.value.trim() !== '');
    if (!required) {
      alert('Preencha os campos obrigatórios.');
      return;
    }
    // Simulação de envio
    alert('Pedido enviado! Em instantes entraremos em contato. 😋');
    form.reset();
  });
}
