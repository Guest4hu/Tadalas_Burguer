import central from "../../central.js";
import { renderizarConteudo } from "./renderizarPaginaPrincipal.js";
let principal = new central();


let comparacao = "";
let pedidosRemoto = [];
export async function busca() {
 return await principal.FetchDadosGlobal(`buscarTipoPedidos`,"GET", "pedidos");
}

export async function renderizarConteudoTab(pedidoId) {
    clearInterval(comparacao);
    const container = document.getElementById(`itens${pedidoId}`);
      let qtdAntiga = await renderizarConteudo(pedidoId,pedidosRemoto) ?? 0;
       comparacao = setInterval(async () => {
             let dados = await principal.FetchDadosGlobal(`quantidades/${pedidoId}`,"GET","pedidos");
             let novaQtd = dados.contagem;
             if (novaQtd != qtdAntiga) {
                principal.abrirCarregar();
                   let qtdNova = await renderizarConteudo(pedidoId);
                   principal.fecharCarregar("info", "Chegou novo item!");
                   qtdAntiga = qtdNova;
               }
           }, 5000);
}

// Funcao para inicializar
export async function inicilizar() {
   pedidosRemoto = await busca()
   await renderizarConteudoTab(1);
}