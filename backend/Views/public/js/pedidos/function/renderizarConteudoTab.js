import central from "../../central.js";
import { renderizarConteudo } from "./renderizarPaginaPrincipal.js";
let principal = new central();


let comparacao = "";

export async function renderizarConteudoTab(pedidoId) {
    clearInterval(comparacao);
    const container = document.getElementById(`itens${pedidoId}`);
    principal.abrirCarregar();
      let qtdAntiga = await renderizarConteudo(pedidoId) ?? 0;
    principal.fecharCarregar("Pronto","success");
       comparacao = setInterval(async () => {
             let dados = await principal.FetchDadosGlobal(`quantidades/${pedidoId}`,"GET","pedidos");
             let novaQtd = dados.contagem;
             if (novaQtd != qtdAntiga) {
                principal.abrirCarregar();
                   let qtdNova = await renderizarConteudo(pedidoId);
                   principal.fecharCarregar();
                   qtdAntiga = qtdNova;
               }
           }, 5000);
}