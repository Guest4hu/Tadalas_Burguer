import Central from "../../central.js";
let principal = new Central();


export async function atualizarPagamento(pedidoId) {
   let dados = await principal.FetchDadosGlobal(`calculaValorTotal/${pedidoId}`, "GET","pedidos");
   let valorTotal = dados.valorTotal;
   console.log(document.getElementById(`status_pagamento_id${pedidoId}`));
   // let statusID = parseInt(document.getElementById(`status_pagamento_id${pedidoId}`).value);
   // let metodoID = parseInt(document.getElementById(`pagamentoMetodo${pedidoId}`).value);
   // principal.FetchDadosGlobal('atualizarMetodo', "POST", "pedidos", { statusID, metodoID, valorTotal, pedidoId });
}