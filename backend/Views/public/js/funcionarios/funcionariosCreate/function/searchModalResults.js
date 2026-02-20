import { resultModal } from "./resultModal.js";


export function searchModalResults(results) {
    const grid = document.getElementById('customerSearchResults');
    grid.innerHTML = '';
    
    if (results.length === 0) {
        grid.innerHTML = `
            <div class="search-no-results">
                <i class="fa fa-user-slash"></i>
                Nenhum usuário encontrado
                <span>Tente buscar por outro nome, telefone ou email</span>
            </div>
        `;
        grid.classList.add('show');
        return;
    }
    
    results.forEach(customer => {
        const initials = customer.nome ? customer.nome.split(' ').map(n => n[0]).slice(0, 2).join('').toUpperCase() : '?';
        const customerCard = document.createElement('div');
        customerCard.className = 'search-result-item';
        customerCard.innerHTML = `
            <input type="hidden" data-id="${customer.usuario_id}" class="customer-id">
            <div class="result-avatar">${initials}</div>
            <div class="result-info">
                <span class="result-name">${customer.nome || 'Sem nome'}</span>
                <span class="result-detail">
                    <i class="fa fa-phone"></i> ${customer.telefone || 'Sem telefone'}
                    &nbsp;|&nbsp;
                    <i class="fa fa-envelope"></i> ${customer.email || 'Sem email'}
                </span>
            </div>
            <div class="select-icon">
                <i class="fa fa-check"></i>
            </div>
        `;
        grid.appendChild(customerCard);
        customerCard.addEventListener('click', function() {
            const id = this.querySelector('.customer-id').dataset.id;
            resultModal(id);
        });
    });
    
    grid.classList.add('show');
}