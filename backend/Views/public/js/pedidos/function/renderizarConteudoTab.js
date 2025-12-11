import central from "../../central.js";
import { renderizarConteudo } from "./renderizarPaginaPrincipal.js";
let principal = new central();

let pedidosRemoto = [];

export async function renderizarConteudoTab(pedidoId) {
   await renderizarConteudo(pedidoId,pedidosRemoto) ?? 0;
}

// Funcao para inicializar
export async function inicilizar() {
   pedidosRemoto = await busca()
   let filtro = pedidosRemoto.pedidos.filter(pedido => pedido.status_pedido_id === 3);
   await renderizarConteudoTab(1);
}

//funcao para puxar os dados ao inicializar a pagina
export async function busca() {
 return await principal.FetchDadosGlobal(`buscarTipoPedidos`,"GET", "pedidos");
}