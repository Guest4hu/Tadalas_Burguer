import Central from "../../../central.js";
const principal = new Central();
export async function deletFunc(dados) {
    return await principal.FetchDadosGlobal(`delete`, 'POST', 'funcionario', dados);
}