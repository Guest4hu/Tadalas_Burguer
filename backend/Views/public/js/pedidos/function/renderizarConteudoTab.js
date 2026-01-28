import central from "../../central.js";
import { renderizarConteudo } from "./renderizarPaginaPrincipal.js";
let principal = new central();
let pedidosRemoto = [];
export let produtosAtivos = []
export let enderecoAtivos = []


// Funcao para inicializar
export async function inicilizar(valorTab) {
   pedidosRemoto = await principal.FetchDadosGlobal(`buscarTipoPedidos`,"GET", "pedidos");
   produtosAtivos = await principal.FetchDadosGlobal(`buscarProdutos`,"GET", "pedidos")
   enderecoAtivos = await principal.FetchDadosGlobal('buscaEndereco',"GET","pedidos")
   await renderizarConteudoTab(valorTab ?? 1);
}

export async function renderizarConteudoTab(pedidoId) {
   await renderizarConteudo(pedidoId,pedidosRemoto,produtosAtivos) ?? 0;
}