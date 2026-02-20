export function showCreateForm() {
    // Esconder busca e mostrar formulário
    document.getElementById('customerSearchBox').style.display = 'none';
    document.getElementById('newCustomerForm').style.display = 'block';
    
    // Esconder resultados de busca
    const resultsContainer = document.getElementById('customerSearchResults');
    resultsContainer.innerHTML = '';
    resultsContainer.classList.remove('show');
    
    // Limpar campos do formulário
    document.getElementById('customerName').value = '';
    document.getElementById('customerEmail').value = '';
    document.getElementById('customerPassword').value = '';
    document.getElementById('customerPasswordConfirm').value = '';
    
    document.getElementById('customerName').focus();
    
    // Atualizar estados dos botões
    document.getElementById('newCustomerBtn').classList.add('active');
    document.getElementById('searchExistingCustomerBtn').classList.remove('active');
}