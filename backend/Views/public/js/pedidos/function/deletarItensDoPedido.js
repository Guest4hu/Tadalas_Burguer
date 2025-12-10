import central from "../../central.js";
import { renderizarItensDoPedido } from "./renderizarItensDoPedido.js";


let principal = new central();


export async function SoftDeleteItens(itemId, pedidoId) {
    if (await principal.alertaConfirmacao("Confirmação", "Tem certeza que deseja excluir este item do pedido?", "warning")) {
        principal.abrirCarregar();
        principal.FetchDadosGlobal('deletarItem', "POST","pedidos",{ itemId });
        await renderizarItensDoPedido(pedidoId);
        principal.fecharCarregar("success", "Item excluído com sucesso!");
    }
}
 