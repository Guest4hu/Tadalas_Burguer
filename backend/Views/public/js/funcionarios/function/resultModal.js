import { userData } from "../funcionariosCreate/funcionarioCreate.js";
export let selectedCustomer = null;

export function resultModal(id) {
    selectedCustomer = id;
    const customer = userData.find(c => c.usuario_id == id);
    
    if (!customer) return;
    
    // Esconder resultados de busca
    const searchResults = document.getElementById('customerSearchResults');
    searchResults.innerHTML = '';
    searchResults.classList.remove('show');
    
    // Esconder campo de busca
    document.getElementById('customerSearchBox').style.display = 'none';
    
    // Mostrar cliente selecionado
    const selectedDisplay = document.getElementById('selectedCustomerDisplay');
    const nameEl = document.getElementById('selectedCustomerName');
    const phoneEl = document.getElementById('selectedCustomerPhone');
    
    nameEl.innerHTML = `<i class="fa fa-user-check"></i> ${customer.nome}`;
    phoneEl.innerHTML = `<i class="fa fa-phone"></i> ${customer.telefone || 'Sem telefone'} &nbsp;|&nbsp; <i class="fa fa-envelope"></i> ${customer.email || 'Sem email'}`;
    
    selectedDisplay.classList.add('show');
    selectedDisplay.innerHTML = `
        <div class="customer-info-compact">
            <strong id="selectedCustomerName"><i class="fa fa-user-check"></i> ${customer.nome}</strong>
            <small id="selectedCustomerPhone"><i class="fa fa-phone"></i> ${customer.telefone || 'Sem telefone'} &nbsp;|&nbsp; <i class="fa fa-envelope"></i> ${customer.email || 'Sem email'}</small>
        </div>
        <button type="button" class="btn-change-customer" id="changeCustomerBtn">
            <i class="fa fa-times"></i>
        </button>
        <input type="hidden" id="selectedCustomerId" value="${customer.usuario_id}">
    `;
    
    // Remover estados ativos dos botões
    document.getElementById('searchExistingCustomerBtn').classList.remove('active');
    document.getElementById('newCustomerBtn').classList.remove('active');
    
    // Adicionar evento para trocar cliente
    const changeBtn = document.getElementById('changeCustomerBtn');
    changeBtn.addEventListener('click', function() {
        selectedCustomer = null;
        selectedDisplay.classList.remove('show');
        selectedDisplay.innerHTML = `
            <div class="customer-info-compact">
                <strong id="selectedCustomerName"></strong>
                <small id="selectedCustomerPhone"></small>
            </div>
        `;
    });
}