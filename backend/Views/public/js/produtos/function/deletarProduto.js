import Central from "../../central.js";
let central = new Central();

export async function SoftDelete(id) {
    if(await central.alertaConfirmacao("Deletar Produto?", "Você tem certeza que deseja deletar este produto?", "warning")) {
        central.abrirCarregar();
        await central.FetchDadosGlobal('deletar', "POST", 'produtos', { id: id });
        window.location.reload();
    }
}