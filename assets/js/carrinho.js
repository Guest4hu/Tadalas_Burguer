// ========================================
// CARRINHO DE COMPRAS - TADALAS BURGUER
// Com suporte a Drawer, Toast e Controles
// ========================================

// Elementos da página de carrinho (carrinho.php)
const cartCountEl = document.getElementById('cart-count');
const cartItemsEl = document.getElementById('carrinho-itens');
const cartTotalEl = document.getElementById('total');

// Elementos do drawer
const drawerOverlay = document.getElementById('cart-drawer-overlay');
const drawerCartItems = document.getElementById('drawer-cart-items');
const drawerSubtotal = document.getElementById('drawer-subtotal');
const drawerFrete = document.getElementById('drawer-frete');
const drawerTotal = document.getElementById('drawer-total');
const cartFloatBtn = document.getElementById('cart-float-btn');
const cartFloatBadge = document.getElementById('cart-float-badge');
const closeDrawerBtn = document.getElementById('close-drawer');
const continueShoppingBtn = document.getElementById('continue-shopping');

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
            const itemHtml = `
                <li class="cart-item" style="margin-top: 5px; padding-bottom: 5px; border-bottom: 1px dotted #ccc; display: flex; justify-content: space-between; align-items: center;">
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
    atualizarBadges();
    renderizarDrawer();
}

// ========================================
// RENDERIZAÇÃO - DRAWER LATERAL
// ========================================

function renderizarDrawer() {
    if (!drawerCartItems) return;

    drawerCartItems.innerHTML = '';

    if (carrinho.length === 0) {
        drawerCartItems.innerHTML = '<li class="empty-cart-message">Seu carrinho está vazio 🛒</li>';
    } else {
        carrinho.forEach(item => {
            const subtotalItem = item.preco * item.quantidade;
            const itemHtml = `
                <li class="drawer-cart-item">
                    <img src="${item.imagem || '/backend/upload/img-1.avif'}" alt="${item.nome}" class="item-thumb">
                    <div class="item-details">
                        <h4 class="item-name">${item.nome}</h4>
                        <p class="item-price">${formatarPreco(item.preco)}</p>
                    </div>
                    <div class="item-right">
                        <div class="item-controls">
                            <button class="qty-btn qty-minus" data-id="${item.id}" aria-label="Diminuir quantidade">−</button>
                            <span class="qty-display">${item.quantidade}</span>
                            <button class="qty-btn qty-plus" data-id="${item.id}" aria-label="Aumentar quantidade">+</button>
                        </div>
                        <div class="item-subtotal">
                            <span>${formatarPreco(subtotalItem)}</span>
                            <button class="item-remove" data-id="${item.id}" aria-label="Remover item">🗑️</button>
                        </div>
                    </div>
                </li>
            `;
            drawerCartItems.insertAdjacentHTML('beforeend', itemHtml);
        });
    }

    // Atualizar resumo
    if (drawerSubtotal) drawerSubtotal.textContent = formatarPreco(calcularSubtotal());
    if (drawerFrete) drawerFrete.textContent = carrinho.length > 0 ? formatarPreco(calcularFrete()) : 'A calcular';
    if (drawerTotal) drawerTotal.textContent = formatarPreco(calcularTotal());
}

// ========================================
// CONTROLE DE QUANTIDADE
// ========================================

function incrementarQuantidade(id) {
    const idStr = String(id);
    const item = carrinho.find(item => item.id === idStr);
    if (item) {
        item.quantidade++;
        renderizarCarrinho();
    }
}

function decrementarQuantidade(id) {
    const idStr = String(id);
    const itemIndex = carrinho.findIndex(item => item.id === idStr);
    if (itemIndex > -1) {
        if (carrinho[itemIndex].quantidade > 1) {
            carrinho[itemIndex].quantidade--;
        } else {
            carrinho.splice(itemIndex, 1);
            mostrarToast(`Item removido do carrinho`, 'success');
        }
        renderizarCarrinho();
    }
}

function removerItemCompleto(id) {
    const idStr = String(id);
    const itemIndex = carrinho.findIndex(item => item.id === idStr);
    if (itemIndex > -1) {
        carrinho.splice(itemIndex, 1);
        mostrarToast(`Item removido do carrinho`, 'success');
        renderizarCarrinho();
    }
}

// ========================================
// ADICIONAR/REMOVER DO CARRINHO
// ========================================

function adicionarAoCarrinho(id, nome, preco, imagem = null) {
    const idStr = String(id);
    const itemExistente = carrinho.find(item => item.id === idStr);
    
    if (itemExistente) {
        itemExistente.quantidade++;
        mostrarToast(`${nome} adicionado novamente!`, 'success');
    } else {
        carrinho.push({ 
            id: idStr, 
            nome, 
            preco: parseFloat(preco), 
            quantidade: 1,
            imagem: imagem 
        });
        mostrarToast(`🎉 ${nome} adicionado ao carrinho!`, 'success');
    }
    
    renderizarCarrinho();
    
    // Opcional: abrir drawer automaticamente no primeiro item
    if (carrinho.length === 1) {
        setTimeout(() => abrirDrawer(), 300);
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
// CONTROLE DO DRAWER
// ========================================

function abrirDrawer() {
    if (drawerOverlay) {
        drawerOverlay.classList.add('active');
        document.body.style.overflow = 'hidden';
        renderizarDrawer();
    }
}

function fecharDrawer() {
    if (drawerOverlay) {
        drawerOverlay.classList.remove('active');
        document.body.style.overflow = '';
    }
}

function toggleDrawer() {
    if (drawerOverlay && drawerOverlay.classList.contains('active')) {
        fecharDrawer();
    } else {
        abrirDrawer();
    }
}

// ========================================
// SISTEMA DE TOAST
// ========================================

function mostrarToast(mensagem, tipo = 'success') {
    const toastContainer = document.getElementById('toast-container');
    if (!toastContainer) return;

    const toast = document.createElement('div');
    toast.className = `toast ${tipo}`;
    
    const icon = tipo === 'success' ? '✓' : '✕';
    const title = tipo === 'success' ? 'Sucesso!' : 'Erro';
    
    toast.innerHTML = `
        <div class="toast-icon">${icon}</div>
        <div class="toast-content">
            <p class="toast-title">${title}</p>
            <p class="toast-message">${mensagem}</p>
        </div>
        <button class="toast-close" aria-label="Fechar">×</button>
    `;
    
    toastContainer.appendChild(toast);
    
    // Fechar ao clicar no X
    const closeBtn = toast.querySelector('.toast-close');
    closeBtn.addEventListener('click', () => esconderToast(toast));
    
    // Auto-dismiss após 3.5 segundos
    setTimeout(() => esconderToast(toast), 3500);
}

function esconderToast(toastElement) {
    toastElement.classList.add('hiding');
    setTimeout(() => {
        if (toastElement.parentNode) {
            toastElement.parentNode.removeChild(toastElement);
        }
    }, 300);
}

// ========================================
// ATUALIZAR BADGES
// ========================================

function atualizarBadges() {
    const totalItens = getTotalItens();
    
    if (cartCountEl) {
        cartCountEl.textContent = totalItens;
    }
    
    if (cartFloatBadge) {
        cartFloatBadge.textContent = totalItens;
        if (totalItens > 0) {
            cartFloatBadge.style.display = 'flex';
        } else {
            cartFloatBadge.style.display = 'none';
        }
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

// Drawer - controles de quantidade e remoção
if (drawerCartItems) {
    drawerCartItems.addEventListener('click', function(e) {
        const target = e.target;
        const id = target.getAttribute('data-id');
        
        if (target.classList.contains('qty-plus')) {
            incrementarQuantidade(id);
        } else if (target.classList.contains('qty-minus')) {
            decrementarQuantidade(id);
        } else if (target.classList.contains('item-remove')) {
            removerItemCompleto(id);
        }
    });
}

// Botão flutuante - abrir drawer
if (cartFloatBtn) {
    cartFloatBtn.addEventListener('click', abrirDrawer);
}

// Fechar drawer
if (closeDrawerBtn) {
    closeDrawerBtn.addEventListener('click', fecharDrawer);
}

if (continueShoppingBtn) {
    continueShoppingBtn.addEventListener('click', fecharDrawer);
}

// Fechar drawer ao clicar no overlay
if (drawerOverlay) {
    drawerOverlay.addEventListener('click', function(e) {
        if (e.target === drawerOverlay) {
            fecharDrawer();
        }
    });
}

// Fechar drawer com ESC
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape' && drawerOverlay && drawerOverlay.classList.contains('active')) {
        fecharDrawer();
    }
});

// ========================================
// EXPORTAR FUNÇÕES GLOBAIS
// ========================================

window.adicionarAoCarrinho = adicionarAoCarrinho;
window.removerDoCarrinho = removerDoCarrinho;
window.abrirDrawer = abrirDrawer;
window.fecharDrawer = fecharDrawer;
window.mostrarToast = mostrarToast;

// ========================================
// INICIALIZAÇÃO
// ========================================

document.addEventListener('DOMContentLoaded', function() {
    carregarCarrinhoLocalStorage();
    renderizarCarrinho();
    atualizarBadges();
});