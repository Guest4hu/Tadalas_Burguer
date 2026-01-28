import Central from "../../central.js";
const principal = new Central();

import { adicionarqtdExistente } from "./adicionarqtdExistente.js";
import { renderizarItensDoPedido } from "./renderizarItensDoPedido.js";

export async function adicionarProduto(pedidoId, dados, usuario_id) {
   const selectProduto = document.getElementById(`novo-Produto${pedidoId}`);
   let qtd = dados.produtos.length;
   const valor = selectProduto.value;
   const quantidade = document.getElementById("nova-Quantidade").value;

   if (selectProduto.value === "0") {
      principal.fecharCarregar("error","Escolha um produto valido!")
      return;
   }
   for (let i = 0; i < qtd; i++) {
      if (parseInt(dados.produtos.produto_id) === parseInt(selectProduto.value.split("@")[0])) {
         let qtdNova = parseInt(quantidade) + parseInt(dados.produtos.quantidade);
         adicionarqtdExistente(pedidoId, dados.produtos.item_id, qtdNova);
         return;
      }
   }
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

      