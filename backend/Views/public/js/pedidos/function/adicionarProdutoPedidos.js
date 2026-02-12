import Central from "../../central.js";
const principal = new Central();
import { dadosPedidos } from "./renderizarItensDoPedido.js";
import { renderizarItensDoPedido } from "./renderizarItensDoPedido.js";
import { produtosAtivos } from "./renderizarConteudoTab.js";

export async function adicionarProduto(dados) {

   if (dados.produtoId == "0") {
      principal.fecharCarregar("error","Escolha um produto valido!")
      return;
   }




   dadosPedidos.forEach(item => {
      if (item.produtoId == dados.produtoId) {
         principal.fecharCarregar("error","Produto ja existe na lista!")
         throw "Produto ja existe na lista";
      }
      });
   

    if (await principal.alertaConfirmacao("Voce deseja adicionar este produto?","Adicionar Produto", "info") === true) {
        principal.FetchDadosGlobal('adicionarItensPedido',"POST",'pedidos',{ produtoId: dados.produtoId, idPedido: dados.pedidoId, quantidade: 1, preco: dados.preco });
        principal.abrirCarregar();
        await renderizarItensDoPedido(dados.pedidoId,parseInt(dados.usuarioId));
        principal.fecharCarregar("success","Pronto!");
   }
}

      