
// Catch Date user data from hidden input
export const userData = JSON.parse(document.getElementById("UserData").value);

import { showInputmodal } from "./function/inputModal.js";
import { searchExistingCustomer } from "./function/searchExistingCustomer.js";
import { searchModalResults } from "./function/searchModalResults.js";
import { selectedCustomer } from "./function/resultModal.js";




// Search existing customer button event listener
const btnExistUser = document.getElementById('searchExistingCustomerBtn');
btnExistUser.addEventListener('click', function() {  
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
const createUser = document.getElementById






