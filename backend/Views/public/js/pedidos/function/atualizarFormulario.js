import Central from "../../central.js";
import { atualizarPagamento } from "./atualizarPagamento.js";
import { renderizarItensDoPedido } from "./renderizarItensDoPedido.js";
import { qtditemFormulario } from "./atualizarQuantidadeFormulario.js";

const principal = new Central();

export async function atualizarFormulario(pedidoId, qtd) {
    if (await principal.alertaConfirmacao("Atualizar?","Tem certeza que deseja atualizar o formulario?","icon") === true) {
        principal.abrirCarregar();
        await qtditemFormulario(qtd, pedidoId);
        await atualizarPagamento(pedidoId);
        await renderizarItensDoPedido(pedidoId);
        principal.fecharCarregar("success","Atualizado!");
        return
    }
    return
}