import central from "../central.js";
const principal = new central();


// Catch Date user data from hidden input
const data = JSON.parse(document.getElementById("UserData").value);
export const userData = data.filter(user => user.tipo_usuario_id == 3);




import { showInputmodal } from "./function/inputModal.js";
import { searchExistingCustomer } from "./function/searchExistingCustomer.js";
import { searchModalResults } from "./function/searchModalResults.js";
import { showCreateForm } from "./function/createForm.js";
import { createFunc } from "./function/createFunc.js";





let newUser = null;

// Search existing customer button event listener
const btnExistUser = document.getElementById('searchExistingCustomerBtn');
btnExistUser.addEventListener('click', function() {  
    newUser = false;
    showInputmodal()
});

// Search input event listener for real-time search results
const searchInput = document.getElementById('customerSearchInput');
searchInput.addEventListener('input', function() {
    const searchTerm = this.value.toLowerCase();
    const results = searchExistingCustomer(searchTerm);
    searchModalResults(results);
});


// Create Functionary
const createUser = document.getElementById('newCustomerBtn');
createUser.addEventListener('click', function() {
    newUser = true;
    showCreateForm();
});

// Password confirmation validation
const confirmPassWord = document.getElementById('customerPasswordConfirm');
confirmPassWord.addEventListener('input', function() {
    const password = document.getElementById('customerPassword').value;
    const confirmPassword = this.value;
    if (password !== confirmPassword) {
        confirmPassWord.classList.add('input-error');
    } else {
        confirmPassWord.classList.remove('input-error');
    } 
});


const btnCreateFunc = document.getElementById('createFunc');
btnCreateFunc.addEventListener('click', async function(event) {
    event.preventDefault();
    await createFunc(newUser);
})








