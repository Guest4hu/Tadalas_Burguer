import Central from "../../../central.js";
const principal = new Central();
import { selectedCustomer } from "./resultModal.js";
import { userData } from "../funcionarioCreate.js";

export async function createFunc(newUser) {
    if(newUser === null) return principal.fecharCarregar('error', 'Selecione um Usuario ou crie um novo para continuar');
    let data = []
    if(newUser) {
        const nome = document.getElementById('customerName')?.value ??  principal.fecharCarregar('error', 'O campo nome é obrigatório');
        const email = document.getElementById('customerEmail')?.value ?? principal.fecharCarregar('error', 'O campo email é obrigatório');
        const password = document.getElementById('customerPassword')?.value ?? principal.fecharCarregar('error', 'O campo senha é obrigatório');
        const confirmPassword = document.getElementById('customerPasswordConfirm')?.value ?? principal.fecharCarregar('error', 'O campo confirmação de senha é obrigatório');
        if(password !== confirmPassword) return principal.fecharCarregar('error', 'As senhas não coincidem');
        if(userData.some(user => user.email === email)) return principal.fecharCarregar('error', 'O email já está em uso por outro usuário');
        data = {
            nome: nome,
            email: email,
            password: password
        }
    } else {
        data = {
            usuario_id: selectedCustomer
        }
    }
    data.cargo_id = document.getElementById('cargo_id')?.value;
    data.status_funcionario_id = document.getElementById('status_funcionario_id')?.value;
    data.salario = parseFloat(document.getElementById('salario')?.value.replace(/,/g, '.')).toFixed(2);

    if(!data.cargo_id || !data.status_funcionario_id || !data.salario) return principal.fecharCarregar('error', 'Preencha todos os campos para continuar');
    principal.abrirCarregar();
    await principal.FetchDadosGlobal('create', 'POST', 'funcionario', data)
    window.location.href = '/backend/funcionarios';
}