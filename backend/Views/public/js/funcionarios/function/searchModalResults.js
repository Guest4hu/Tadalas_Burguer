import { resultModal } from "./resultModal.js";


export function searchModalResults(results) {
    const grid = document.getElementById('customerSearchResults');
    grid.innerHTML = '';
    if (results.length === 0) {
        grid.innerHTML = '<p>No customers found.</p>';
        return;
    }
    results.forEach(customer => {
        const customerCard = document.createElement('div');
        customerCard.className = 'customer-card';
        customerCard.innerHTML = `
            <input type="hidden" data-id="${customer.usuario_id}" class="customer-id">
            <h3>${customer.nome}</h3>
            <p>Telefone: ${customer.telefone}</p>
            <p>Email: ${customer.email}</p>
        `;
        grid.appendChild(customerCard);
        customerCard.addEventListener('click', function() {
            const id = this.querySelector('.customer-id').dataset.id;
            resultModal(id);
        });
    });
}