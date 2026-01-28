import Central from "../../central.js";
import { atualizarPagamento } from "./atualizarPagamento.js";
import { renderizarItensDoPedido } from "./renderizarItensDoPedido.js";
import { qtditemFormulario } from "./atualizarQuantidadeFormulario.js";

const principal = new Central();

export async function atualizarFormulario(pedidoId, qtd, usuario_id) {
    if (await principal.alertaConfirmacao("Atualizar?","Tem certeza que deseja atualizar o formulario?","info") === true) {
        principal.abrirCarregar();
        await qtditemFormulario(qtd, pedidoId);
        await atualizarPagamento(pedidoId);
        await renderizarItensDoPedido(pedidoId, usuario_id);
        principal.fecharCarregar("success","Atualizado!");
        return
    }
    return
}