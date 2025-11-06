
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
 
    if (!cartItemsEl || !cartTotalEl) return;
    
    cartItemsEl.innerHTML = ''; 
    let total = 0;
    let totalItens = 0;
    
    if (carrinho.length === 0) {
        cartItemsEl.innerHTML = '<li style="list-style: none; font-style: italic;">Carrinho vazio. Adicione itens do cardápio.</li>';
    }

    carrinho.forEach(item => {
        const precoItemTotal = (item.preco * item.quantidade).toFixed(2);
        const precoFormatado = parseFloat(item.preco).toFixed(2).replace('.', ',');
        const precoTotalFormatado = precoItemTotal.replace('.', ',');

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
        total += item.preco * item.quantidade;
        totalItens += item.quantidade;
    });

    // A cada vez que se adiciona ou remove um item do carrinho, o foreach itera pela itens do array carrinho recém modificado e ele acrescenta esses valores
    if (cartCountEl) {
        cartCountEl.textContent = totalItens;
    }
    cartTotalEl.textContent = total.toFixed(2).replace('.', ','); 
    salvarCarrinhoLocalStorage(); 
}

function adicionarAoCarrinho(id, nome, preco) {
    const idStr = String(id);
    const itemExistente = carrinho.find(item => item.id === idStr); // retorna o array do produto se já tiver outro dele no carrinho, incrementa a quantidade dele e insere no array carrinho
    console.log(itemExistente)
    if (itemExistente) {
        itemExistente.quantidade++;
    } else {
        // push se caso ele não foi selecionado ainda
        carrinho.push({ id: idStr, nome, preco: parseFloat(preco), quantidade: 1 });
    }
    renderizarCarrinho();
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


//window.adicionarAoCarrinho = adicionarAoCarrinho;
//window.removerDoCarrinho = removerDoCarrinho;


document.addEventListener('DOMContentLoaded', function() {
    carregarCarrinhoLocalStorage();
    renderizarCarrinho();
});