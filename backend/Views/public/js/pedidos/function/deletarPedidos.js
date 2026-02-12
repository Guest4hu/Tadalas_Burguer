import central from "../../central.js";
let principal = new central();
import { inicilizar } from "./renderizarConteudoTab.js";


export async function SoftDelete(idPedido) {
    if( await principal.alertaConfirmacao("Excluir","Você deseja excluir este pedido?","warning") === true){
        principal.abrirCarregar();
        principal.FetchDadosGlobal('deletar', "POST", "pedidos", { idPedido });
        inicilizar();
        principal.fecharCarregar("success","Pedido excluído com sucesso!");
        return
    }
    return
}