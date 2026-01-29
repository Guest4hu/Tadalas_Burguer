import Central from "../../central.js";
const principal = new Central();
import { dadosPedidos } from "./renderizarItensDoPedido.js";
import { adicionarqtdExistente } from "./adicionarqtdExistente.js";
import { renderizarItensDoPedido } from "./renderizarItensDoPedido.js";
import { produtosAtivos } from "./renderizarConteudoTab.js";

export async function adicionarProduto(dados) {

   if (dados.produtoId == "0") {
      principal.fecharCarregar("error","Escolha um produto valido!")
      return;
   }
   
   produtosAtivos.produtos.forEach(async (produto) => {
      if (produto.produto_id == dados.produtoId) {
         principal.fecharCarregar("error","Eu ja existo no Carrinho!")
         return
      }
   })
   

   
      
         
   if (quantidade <= 0) {
      principal.fecharCarregar("error","por favor coloque uma quantidade valida")
      return;
    }
    const [produto, preco] = valor.split("@");
    if (await principal.alertaConfirmacao("Voce deseja adicionar este produto?","Adicionar Produto", "info") === true) {
        principal.FetchDadosGlobal('adicionarItensPedido',"POST",'pedidos',{ produtoId: produto, idPedido: pedidoId, quantidade, preco });
        principal.abrirCarregar();
        await renderizarItensDoPedido(pedidoId,parseInt(usuario_id));
        principal.fecharCarregar("success","Pronto!");
   }
}

      