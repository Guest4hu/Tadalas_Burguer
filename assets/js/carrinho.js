
const cartCountEl = document.getElementById('cart-count');
const cartItemsEl = document.getElementById('carrinho-itens');
const cartTotalEl = document.getElementById('total');

let carrinho = [];
const localStorageKey = 'carrinhoTadallas'; 

function salvarCarrinhoLocalStorage() {
    localStorage.setItem(localStorageKey, JSON.stringify(carrinho));
}

function carregarCarrinhoLocalStorage() {
    const carrinhoSalvo = localStorage.getItem(localStorageKey);
    if (carrinhoSalvo) {
        carrinho = JSON.parse(carrinhoSalvo);
    }
}

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
    renderizarCarrinho();
    if (typeof window.onItemAdicionado === 'function') {
        window.onItemAdicionado(nome, imagem);
    }
}

function removerDoCarrinho(id) {
    const idStr = String(id);
    const itemIndex = carrinho.findIndex(item => item.id === idStr);
    console.log(itemIndex)
    if (itemIndex > -1) { 
        if (carrinho[itemIndex].quantidade > 1) {
            carrinho[itemIndex].quantidade--;
        } else {
            carrinho.splice(itemIndex, 1);
        }
        renderizarCarrinho();
    }
}

if (cartItemsEl) {
    cartItemsEl.addEventListener('click', function(e) {
        if (e.target.classList.contains('btn-remove-cart')) {
            const id = e.target.getAttribute('data-id');
            removerDoCarrinho(id);
        }
    });
}


window.adicionarAoCarrinho = adicionarAoCarrinho;
window.removerDoCarrinho = removerDoCarrinho;


document.addEventListener('DOMContentLoaded', function() {
    carregarCarrinhoLocalStorage();
    renderizarCarrinho();
});