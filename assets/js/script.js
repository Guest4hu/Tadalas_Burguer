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
    const numero = '5511960217697'; // Número da hamburgueria

    window.open(`https://wa.me/${numero}?text=${msgEncoded}`, '_blank');

    form.reset();
    pedidoItens = [];
    atualizarPedido();
  });
}






//                                "Se der erro, deu erro"
//                                          - Vitão, 2025

document.addEventListener('DOMContentLoaded',
  function() {
    const container = document.querySelector('.menu-grid');
    if (!container) return; 
    container.innerHTML = '<h3>Carregando serviços...</h3>';
    fetch('/backend/api/servicos')
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
            
            container.innerHTML = ''; 
            json.data.forEach(servico => {
              document.querySelector('.img-1').style.backgroundImage = "url('../../backend/upload/img-1.avif')"
                const cardHtml = `
                  <article class="card">
                    <div class="card-img">
                      <img src"../../backend/upload/img-1">
                    </div>
                      <div class="card-body">
                        <h3>Dallas Burger</h3>
                        <p>Pão brioche, carne 120g, cheddar e bacon.</p>
                          <div class="card-foot">
                          <span class="price">R$ 29,90</span>
                          <button class="btn btn-outline add" aria-label="Adicionar Dallas Burger ao pedido">Adicionar</button>
                      </div>
                    </div>
                  </article>





                    <div class="card" data-service="${servico.nome_servico.toLowerCase()}">
                        <div class="card__frente" style="background-image: url('${servico.caminho_imagem}');">
                            <h3 class="card__titulo">${servico.nome_servico.toUpperCase()}</h3>
                        </div>
                        <div class="card__verso">
                            <h3 class="card__titulo--verso">${servico.nome_servico.toUpperCase()}</h3>
                            <p class="card__descricao">${servico.descricao_servico}</p>
                        </div>
                    </div>
                `;
                container.insertAdjacentHTML('beforeend', cardHtml);
            });
        })
        .catch(error => {
            console.error('Erro ao buscar serviços:', error);
            container.innerHTML = '<p style="color: red;">Não foi possível carregar os serviços no momento. Tente novamente mais tarde.</p>';
        });
  }
);