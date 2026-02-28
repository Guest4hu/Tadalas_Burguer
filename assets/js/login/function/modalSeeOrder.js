export function modalSeeOrder() {
    // Verifica se o modal já existe
    let overlay = document.getElementById('orders-overlay');
    
    if (!overlay) {
        // Cria o modal se não existir
        criarModalHTML();
        overlay = document.getElementById('orders-overlay');
    }
    
    // Abre o modal
    abrirModal();
    
    // Carrega os pedidos
    carregarPedidos();
}

function criarModalHTML() {
    const modalHTML = `
        <div class="modal-overlay orders-modal-overlay" id="orders-overlay">
            <div class="modal-orders" id="orders-modal">
                <div class="modal-header">
                    <h2>Meus Pedidos</h2>
                    <button type="button" class="modal-close" id="btn-close-orders" aria-label="Fechar">&times;</button>
                </div>
                <div class="modal-body" id="modal-orders-content">
                    <div class="modal-loading">
                        <div class="spinner"></div>
                        <p>Carregando pedidos...</p>
                    </div>
                </div>
            </div>
        </div>
    `;
    
    // Adiciona CSS do modal
    if (!document.getElementById('orders-modal-styles')) {
        const styles = document.createElement('style');
        styles.id = 'orders-modal-styles';
        styles.textContent = `
            .orders-modal-overlay {
                position: fixed;
                inset: 0;
                background: rgba(0,0,0,.7);
                backdrop-filter: blur(4px);
                z-index: 9000;
                opacity: 0;
                visibility: hidden;
                transition: opacity .3s, visibility .3s;
                display: flex;
                align-items: center;
                justify-content: center;
                padding: 20px;
            }
            .orders-modal-overlay.open {
                opacity: 1;
                visibility: visible;
            }
            
            .modal-orders {
                width: 100%;
                max-width: 600px;
                max-height: 85vh;
                background: #141414;
                border: 1px solid #2a2a2a;
                border-radius: 16px;
                display: flex;
                flex-direction: column;
                transform: scale(0.95) translateY(20px);
                transition: transform .35s cubic-bezier(.4,0,.2,1);
                box-shadow: 0 20px 60px rgba(0,0,0,.5);
            }
            .orders-modal-overlay.open .modal-orders {
                transform: scale(1) translateY(0);
            }
            
            .modal-orders .modal-header {
                display: flex;
                align-items: center;
                justify-content: space-between;
                padding: 20px 24px;
                border-bottom: 1px solid #2a2a2a;
                flex-shrink: 0;
            }
            .modal-orders .modal-header h2 {
                margin: 0;
                font-size: 20px;
                font-weight: 800;
                color: #f5f5f5;
            }
            .modal-orders .modal-close {
                background: none;
                border: none;
                color: #888;
                font-size: 28px;
                cursor: pointer;
                width: 36px;
                height: 36px;
                display: flex;
                align-items: center;
                justify-content: center;
                border-radius: 8px;
                transition: all .2s;
            }
            .modal-orders .modal-close:hover {
                background: rgba(255,255,255,.08);
                color: #fff;
            }
            
            .modal-orders .modal-body {
                flex: 1;
                overflow-y: auto;
                padding: 16px 24px;
            }
            .modal-orders .modal-body::-webkit-scrollbar {
                width: 4px;
            }
            .modal-orders .modal-body::-webkit-scrollbar-thumb {
                background: #333;
                border-radius: 4px;
            }
            
            .modal-loading {
                text-align: center;
                padding: 48px 0;
                color: #888;
            }
            .spinner {
                width: 40px;
                height: 40px;
                border: 3px solid #333;
                border-top-color: #e63946;
                border-radius: 50%;
                margin: 0 auto 16px;
                animation: spin 1s linear infinite;
            }
            @keyframes spin {
                to { transform: rotate(360deg); }
            }
            
            .modal-empty {
                text-align: center;
                color: #888;
                padding: 48px 0;
                font-style: italic;
            }
            
            .order-card {
                background: #1c1c1c;
                border: 1px solid #2a2a2a;
                border-radius: 12px;
                padding: 16px;
                margin-bottom: 12px;
                transition: border-color .2s;
            }
            .order-card:hover {
                border-color: #3a3a3a;
            }
            
            .order-header {
                display: flex;
                justify-content: space-between;
                align-items: flex-start;
                margin-bottom: 12px;
                flex-wrap: wrap;
                gap: 8px;
            }
            .order-id {
                font-weight: 700;
                font-size: 16px;
                color: #f5f5f5;
            }
            .order-date {
                font-size: 13px;
                color: #888;
            }
            
            .order-status {
                display: inline-block;
                padding: 4px 12px;
                border-radius: 20px;
                font-size: 12px;
                font-weight: 600;
                text-transform: uppercase;
            }
            .order-status.status-1 { background: #ffd60a22; color: #ffd60a; }
            .order-status.status-2 { background: #3b82f622; color: #3b82f6; }
            .order-status.status-3 { background: #8b5cf622; color: #8b5cf6; }
            .order-status.status-4 { background: #22c55e22; color: #22c55e; }
            .order-status.status-5 { background: #ef444422; color: #ef4444; }
            
            .order-items {
                border-top: 1px solid #2a2a2a;
                padding-top: 12px;
                margin-top: 12px;
            }
            .order-item {
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 8px 0;
                font-size: 14px;
                color: #cfcfcf;
            }
            .order-item:not(:last-child) {
                border-bottom: 1px dashed #2a2a2a;
            }
            .item-name {
                flex: 1;
            }
            .item-qty {
                color: #888;
                margin: 0 12px;
            }
            .item-price {
                color: #ffd60a;
                font-weight: 600;
            }
            
            .order-total {
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding-top: 12px;
                margin-top: 12px;
                border-top: 1px solid #2a2a2a;
                font-weight: 700;
            }
            .order-total-label {
                color: #f5f5f5;
            }
            .order-total-value {
                color: #ffd60a;
                font-size: 18px;
            }
            
            .order-type {
                font-size: 12px;
                color: #888;
                margin-top: 8px;
            }
        `;
        document.head.appendChild(styles);
    }
    
    document.body.insertAdjacentHTML('beforeend', modalHTML);
    
    // Adiciona event listeners
    const overlay = document.getElementById('orders-overlay');
    const closeBtn = document.getElementById('btn-close-orders');
    
    closeBtn.addEventListener('click', fecharModal);
    overlay.addEventListener('click', (e) => {
        if (e.target === overlay) fecharModal();
    });
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && overlay.classList.contains('open')) {
            fecharModal();
        }
    });
}

function abrirModal() {
    const overlay = document.getElementById('orders-overlay');
    overlay.classList.add('open');
    document.body.style.overflow = 'hidden';
}

function fecharModal() {
    const overlay = document.getElementById('orders-overlay');
    overlay.classList.remove('open');
    document.body.style.overflow = '';
}

async function carregarPedidos() {
    const content = document.getElementById('modal-orders-content');
    
    try {
        const response = await fetch('/backend/api/meus-pedidos');
        const result = await response.json();
        
        if (!response.ok) {
            if (response.status === 401) {
                content.innerHTML = `
                    <div class="modal-empty">
                        <p>Você precisa estar logado para ver seus pedidos.</p>
                        <a href="/backend/login" style="color: #e63946; text-decoration: underline;">Fazer login</a>
                    </div>
                `;
                return;
            }
            throw new Error(result.message || 'Erro ao carregar pedidos');
        }
        
        const pedidos = result.data;
        
        if (!pedidos || pedidos.length === 0) {
            content.innerHTML = `
                <div class="modal-empty">
                    <p>Você ainda não fez nenhum pedido.</p>
                    <a href="/cardapio.php" style="color: #e63946; text-decoration: underline;">Ver cardápio</a>
                </div>
            `;
            return;
        }
        
        content.innerHTML = pedidos.map(pedido => renderizarPedido(pedido)).join('');
        
    } catch (error) {
        console.error('Erro ao carregar pedidos:', error);
        content.innerHTML = `
            <div class="modal-empty">
                <p>Erro ao carregar pedidos. Tente novamente.</p>
            </div>
        `;
    }
}

function renderizarPedido(pedido) {
    const dataFormatada = formatarData(pedido.criado_em);
    const statusClass = `status-${pedido.status_id}`;
    
    const itensHTML = pedido.itens && pedido.itens.length > 0 
        ? pedido.itens.map(item => `
            <div class="order-item">
                <span class="item-name">${item.nome_produto || item.nome || 'Produto'}</span>
                <span class="item-qty">x${item.quantidade}</span>
                <span class="item-price">R$ ${formatarPreco(item.valor_unitario * item.quantidade)}</span>
            </div>
        `).join('')
        : '<p style="color: #888; font-size: 13px;">Sem itens</p>';
    
    return `
        <div class="order-card">
            <div class="order-header">
                <div>
                    <span class="order-id">Pedido #${pedido.pedido_id}</span>
                    <div class="order-date">${dataFormatada}</div>
                </div>
                <span class="order-status ${statusClass}">${pedido.status_descricao}</span>
            </div>
            <div class="order-items">
                ${itensHTML}
            </div>
            <div class="order-total">
                <span class="order-total-label">Total</span>
                <span class="order-total-value">R$ ${formatarPreco(pedido.valor_total)}</span>
            </div>
            <div class="order-type">Tipo: ${pedido.tipo_pedido}</div>
        </div>
    `;
}

function formatarData(dataString) {
    const data = new Date(dataString);
    return data.toLocaleDateString('pt-BR', {
        day: '2-digit',
        month: '2-digit',
        year: 'numeric',
        hour: '2-digit',
        minute: '2-digit'
    });
}

function formatarPreco(valor) {
    return Number(valor || 0).toFixed(2).replace('.', ',');
}