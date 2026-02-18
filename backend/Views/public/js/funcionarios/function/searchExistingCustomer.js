import { userData } from "../funcionario.js";



export function searchExistingCustomer(searchTerm) {
    const term = searchTerm.toLowerCase();
    const searchCleaned = term.replace(/\s/g, '');

    return userData.filter(customer => {
            const matchName = customer.nome && customer.nome.toLowerCase().includes(term);
            const phoneClean = customer.telefone ? customer.telefone.replace(/\D/g, '') : '';
            const matchPhone = searchCleaned.length > 0 && phoneClean.includes(searchCleaned);
            const matchEmail = customer.email && customer.email.toLowerCase().includes(term);
            return matchName || matchPhone || matchEmail;   
    })
}