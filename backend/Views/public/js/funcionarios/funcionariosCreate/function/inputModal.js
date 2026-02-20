export function showInputmodal() {
    // Mostrar campo de busca e esconder formulário
    document.getElementById('customerSearchBox').style.display = 'block';
    document.getElementById('newCustomerForm').style.display = 'none';
    
    // Limpar resultados anteriores
    const resultsContainer = document.getElementById('customerSearchResults');
    resultsContainer.innerHTML = '';
    resultsContainer.classList.remove('show');
    
    // Limpar input
    const searchInput = document.getElementById('customerSearchInput');
    searchInput.value = '';
    searchInput.focus();
    
    // Atualizar estados dos botões
    document.getElementById('searchExistingCustomerBtn').classList.add('active');
    document.getElementById('newCustomerBtn').classList.remove('active');
}