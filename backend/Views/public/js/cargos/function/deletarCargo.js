import Central from "../../central.js";
let central = new Central();

export async function SoftDelete(id) {
    if(await central.alertaConfirmacao("Deletar Cargo?", "Você tem certeza que deseja deletar este cargo?", "warning")) {
        central.abrirCarregar();
        await central.FetchDadosGlobal('deletar', "POST", 'cargo', { id: id });
        window.location.reload();
    }
}