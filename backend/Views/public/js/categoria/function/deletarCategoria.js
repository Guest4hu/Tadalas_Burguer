import Central from "../../central.js";
let central = new Central();
export async function SoftDelete(id) {
    if(await central.alertaConfirmacao("Deletar Categoria?", "Você tem certeza que deseja deletar esta categoria?", "warning")) {
        central.abrirCarregar();
        await central.FetchDadosGlobal('deletar', "POST", 'categoria', { id: id });
        window.location.reload();
    }
}