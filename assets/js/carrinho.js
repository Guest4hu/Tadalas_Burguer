// ========================================
// CARRINHO DE COMPRAS - TADALAS BURGUER
// Com suporte a Drawer, Toast e Controles
// ========================================

// Elementos da página de carrinho (carrinho.php)
const cartCountEl = document.getElementById('cart-count');
const cartItemsEl = document.getElementById('carrinho-itens');
const cartTotalEl = document.getElementById('total');

// (Drawer removido — carrinho apenas via modal ou carrinho.php)

// Estado do carrinho
let carrinho = [];
const localStorageKey = 'carrinhoTadallas';
const FRETE_FIXO = 5.00; // Frete fixo por enquanto

// ========================================
// PERSISTÊNCIA (LocalStorage)
// ========================================

function salvarCarrinhoLocalStorage() {
    localStorage.setItem(localStorageKey, JSON.stringify(carrinho));
}

function carregarCarrinhoLocalStorage() {
    const carrinhoSalvo = localStorage.getItem(localStorageKey);
    if (carrinhoSalvo) {
        try {
            carrinho = JSON.parse(carrinhoSalvo);
        } catch (e) {
            console.error('Erro ao carregar carrinho:', e);
            carrinho = [];
        }
    }
}

// ========================================
// CÁLCULOS
// ========================================

function calcularSubtotal() {
    return carrinho.reduce((total, item) => total + (item.preco * item.quantidade), 0);
}


function calcularTotal() {
    return calcularSubtotal() + calcularFrete();
}

function getTotalItens() {
    return carrinho.reduce((total, item) => total + item.quantidade, 0);
}

function formatarPreco(valor) {
    return valor.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
}

// ========================================
// RENDERIZAÇÃO - PÁGINA CARRINHO.PHP
// ========================================

function renderizarCarrinho() {
    let total = 0;
    let totalItens = 0;

    if (cartItemsEl) {
        cartItemsEl.innerHTML = '';
    }

    if (carrinho.length === 0 && cartItemsEl) {
        cartItemsEl.innerHTML = '<li style="list-style: none; font-style: italic;">Carrinho vazio. Adicione itens do cardápio.</li>';
    }

    carrinho.forEach(item => {
        const precoItemTotal = (item.preco * item.quantidade).toFixed(2);
        const precoFormatado = parseFloat(item.preco).toFixed(2).replace('.', ',');
        const precoTotalFormatado = precoItemTotal.replace('.', ',');

        if (cartItemsEl) {
            const imgTag = item.imagem ? `<img src="${item.imagem}" alt="" style="width:40px;height:40px;border-radius:8px;object-fit:cover;flex-shrink:0;">` : '';
            const itemHtml = `
                <li class="cart-item" style="margin-top: 5px; padding-bottom: 5px; border-bottom: 1px dotted #ccc; display: flex; align-items: center; gap: 10px;">
                    ${imgTag}
                    <span style="flex-grow: 1;">
                        ${item.nome} - R$ ${precoFormatado} x ${item.quantidade} 
                        <strong style="color: var(--color-primary);">= R$ ${precoTotalFormatado}</strong>
                    </span>
                    <button class="btn-remove-cart btn btn-outline w3-button w3-tiny w3-red" 
                            data-id="${item.id}" 
                            style="margin-left: 10px; padding: 4px 8px; font-size: 0.7em;">
                        Remover 1
                    </button>
                </li>`;
            cartItemsEl.insertAdjacentHTML('beforeend', itemHtml);
        }

        total += item.preco * item.quantidade;
        totalItens += item.quantidade;
    });

    if (cartCountEl) {
        cartCountEl.textContent = totalItens;
    }
    if (cartTotalEl) {
        cartTotalEl.textContent = total.toFixed(2).replace('.', ',');
    }
    
    salvarCarrinhoLocalStorage();
    if (typeof window.onCarrinhoRenderizado === 'function') {
        window.onCarrinhoRenderizado([...carrinho]);
    }
}

function adicionarAoCarrinho(id, nome, preco, imagem) {
    const idStr = String(id);
    const itemExistente = carrinho.find(item => item.id === idStr);
    if (itemExistente) {
        itemExistente.quantidade++;
    } else {
        carrinho.push({ id: idStr, nome, preco: parseFloat(preco), quantidade: 1, imagem: imagem || '' });
    }
    mostrarToast(`${nome} adicionado ao carrinho!`, 'success', imagem);
    renderizarCarrinho();
    if (typeof window.onItemAdicionado === 'function') {
        window.onItemAdicionado(nome, imagem);
    }
}

function removerDoCarrinho(id) {
    const idStr = String(id);
    const itemIndex = carrinho.findIndex(item => item.id === idStr);
    if (itemIndex > -1) { 
        if (carrinho[itemIndex].quantidade > 1) {
            carrinho[itemIndex].quantidade--;
        } else {
            carrinho.splice(itemIndex, 1);
        }
        renderizarCarrinho();
    }
}



// ========================================
// SISTEMA DE TOAST (auto-estilizado)
// ========================================

(function injectToastStyles() {
    if (document.getElementById('carrinho-toast-styles')) return;
    const style = document.createElement('style');
    style.id = 'carrinho-toast-styles';
    style.textContent = `
        .carrinho-toast-wrap {
            position: fixed; top: 20px; right: 20px; z-index: 10000;
            display: flex; flex-direction: column; gap: 8px;
            pointer-events: none;
        }
        .carrinho-toast {
            pointer-events: auto;
            display: flex; align-items: center; gap: 10px;
            background: #1a1a1a; border-radius: 14px;
            padding: 12px 18px; color: #fff;
            font-size: 14px; font-weight: 500;
            box-shadow: 0 8px 32px rgba(0,0,0,.5);
            animation: ctIn .3s ease forwards;
            max-width: 360px;
            font-family: inherit;
        }
        .carrinho-toast.success { border: 1px solid rgba(74,222,128,.4); }
        .carrinho-toast.error   { border: 1px solid rgba(239,68,68,.4); }
        .carrinho-toast .ct-icon {
            width: 22px; height: 22px; flex-shrink: 0;
            display: flex; align-items: center; justify-content: center;
            font-weight: 700; font-size: 16px;
        }
        .carrinho-toast.success .ct-icon { color: #4ade80; }
        .carrinho-toast.error   .ct-icon { color: #ef4444; }
        .carrinho-toast .ct-msg { flex: 1; }
        .carrinho-toast .ct-close {
            background: none; border: none; color: #888;
            font-size: 18px; cursor: pointer; padding: 0 0 0 6px;
            line-height: 1;
        }
        .carrinho-toast .ct-close:hover { color: #fff; }
        .carrinho-toast .ct-img {
            width: 40px; height: 40px; border-radius: 8px;
            object-fit: cover; flex-shrink: 0;
        }
        .carrinho-toast.ct-out { animation: ctOut .3s ease forwards; }
        @keyframes ctIn  { from { opacity:0; transform:translateX(40px); } to { opacity:1; transform:translateX(0); } }
        @keyframes ctOut { from { opacity:1; transform:translateX(0); } to { opacity:0; transform:translateX(40px); } }
    `;
    document.head.appendChild(style);
})();

function _getToastContainer() {
    let wrap = document.getElementById('carrinho-toast-wrap');
    if (!wrap) {
        wrap = document.createElement('div');
        wrap.id = 'carrinho-toast-wrap';
        wrap.className = 'carrinho-toast-wrap';
        document.body.appendChild(wrap);
    }
    return wrap;
}

function mostrarToast(mensagem, tipo = 'success', imagem = '') {
    const wrap = _getToastContainer();
    const toast = document.createElement('div');
    toast.className = `carrinho-toast ${tipo}`;

    const icon = tipo === 'success' ? '✓' : '✕';
    const imgHtml = imagem ? `<img class="ct-img" src="${imagem}" alt="">` : '';
    toast.innerHTML = `
        <span class="ct-icon">${icon}</span>
        ${imgHtml}
        <span class="ct-msg">${mensagem}</span>
        <button class="ct-close" aria-label="Fechar">×</button>
    `;

    wrap.appendChild(toast);
    toast.querySelector('.ct-close').addEventListener('click', () => esconderToast(toast));
    setTimeout(() => esconderToast(toast), 3000);
}

function esconderToast(el) {
    if (el.classList.contains('ct-out')) return;
    el.classList.add('ct-out');
    el.addEventListener('animationend', () => el.remove());
}

// ========================================
// ATUALIZAR BADGES
// ========================================

function atualizarBadges() {
    const totalItens = getTotalItens();
    
    if (cartCountEl) {
        cartCountEl.textContent = totalItens;
    }
}

// ========================================
// EVENT LISTENERS
// ========================================

// Página carrinho.php - remover item
if (cartItemsEl) {
    cartItemsEl.addEventListener('click', function(e) {
        if (e.target.classList.contains('btn-remove-cart')) {
            const id = e.target.getAttribute('data-id');
            removerDoCarrinho(id);
        }
    });
}



// ========================================
// EXPORTAR FUNÇÕES GLOBAIS
// ========================================

window.adicionarAoCarrinho = adicionarAoCarrinho;
window.removerDoCarrinho = removerDoCarrinho;
window.mostrarToast = mostrarToast;

// ========================================
// INICIALIZAÇÃO
// ========================================

document.addEventListener('DOMContentLoaded', function() {
    carregarCarrinhoLocalStorage();
    renderizarCarrinho();
    atualizarBadges();
});