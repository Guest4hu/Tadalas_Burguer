import { userData } from "../funcionario.js";
export let selectedCustomer = null;

export function resultModal(id) {
    selectedCustomer = id;
     const grid = document.getElementById('customerSearchResults');
        const customer = userData.find(c => c.usuario_id == id);
        const customerCard = document.createElement('div');
        customerCard.className = 'customer-card';
        customerCard.innerHTML = `
            <button class="closeResultModal">
            <i>X</i></button>
            <input type="hidden" data-id="${customer.usuario_id}" class="customer-id">
            <h3>${customer.nome}</h3>
            <p>Telefone: ${customer.telefone}</p>
            <p>Email: ${customer.email}</p>
        `;
        grid.innerHTML = '';
        grid.appendChild(customerCard);

     const closeBtn = customerCard.querySelector('.closeResultModal');
        closeBtn.addEventListener('click', function() {
            grid.innerHTML = '';
            selectedCustomer = null;
        });
}