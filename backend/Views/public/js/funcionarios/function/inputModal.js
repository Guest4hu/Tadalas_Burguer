export function showInputmodal() {
    document.getElementById('customerSearchBox').style.display = 'block';
    document.getElementById('newCustomerForm').style.display = 'none';
    document.getElementById('customerSearchInput').focus();
}