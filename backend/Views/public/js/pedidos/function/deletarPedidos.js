import central from "../../central.js";
let principal = new central();
import { renderizarConteudoTab } from "./renderizarConteudoTab.js";


export async function SoftDelete(idPedido,status) {
    if( await principal.alertaConfirmacao("Excluir","Você deseja excluir este pedido?","warning") === true){
        principal.abrirCarregar();
        principal.FetchDadosGlobal('deletar', "POST", { idPedido },"pedidos");
        await renderizarConteudoTab(status);
        principal.fecharCarregar("Pedido Excluido!","success");
        return
    }
    return
}