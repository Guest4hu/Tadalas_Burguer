import Central from "../../central.js";
let principal = new Central();
import { dadosMetodo,dadosStatus } from "../pedidos.js";




export async function atualizarPagamento(pedidoId) {
   principal.FetchDadosGlobal('atualizarMetodo', "POST", "pedidos", { metodoStatus: parseInt(dadosStatus.metodoStatus), metodoid: parseInt(dadosMetodo.metodoid), pedidoId: parseInt(pedidoId) });
}