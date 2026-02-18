export function showCreateForm() {
    document.getElementById('customerSearchBox').style.display = 'none';
    document.getElementById('newCustomerForm').style.display = 'block';
    document.getElementById('customerName').focus();
}