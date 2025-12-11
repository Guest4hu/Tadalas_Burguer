import Central from "../../central.js";
import { renderizarItensDoPedido } from "./renderizarItensDoPedido.js";
let principal = new Central();

export async function adicionarqtdExistente(pedidoId, item_id, quantidade) {
    let arrayItems = [{ id: item_id, quantidade: quantidade }];

    if (await principal.alertaConfirmacao("O produto ja existe!","Atualizar apenas a quantidade?","warning") === true) {
        principal.FetchDadosGlobal('atualizarItensPedidoQTD', "POST", { itens: arrayItems },"pedidos");
        principal.abrirCarregar();
        await renderizarItensDoPedido(pedidoId);
        principal.fecharCarregar("success","Quantidade atualizada com sucesso!");
    }
}