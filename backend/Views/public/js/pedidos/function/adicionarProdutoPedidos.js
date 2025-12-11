import Central from "../../central.js";
const principal = new Central();

import { adicionarqtdExistente } from "./adicionarqtdExistente.js";

export async function adicionarProduto(pedidoId, dados) {
   const selectProduto = document.getElementById(`novo-Produto${pedidoId}`);
   let qtd = dados.dados2.length;
   const valor = selectProduto.value;
   const quantidade = document.getElementById("nova-Quantidade").value;

   if (selectProduto.value === "0") {
      principal.fecharCarregar("error","Escolha um produto valido!")
      return;
   }
   for (let i = 0; i < qtd; i++) {
      if (parseInt(dados.dados2[i].produto_id) === parseInt(selectProduto.value.split("@")[0])) {
         let qtdNova = parseInt(quantidade) + parseInt(dados.dados2[i].quantidade);
         adicionarqtdExistente(pedidoId, dados.dados2[i].item_id, qtdNova);
         return;
      }
   }
   if (quantidade <= 0) {
      principal.fecharCarregar("error","por favor coloque uma quantidade valida")
      return;
    }
    const [produto, preco] = valor.split("@");
    if (await principal.alertaConfirmacao("Voce deseja adicionar este produto?","Adicionar Produto", "info") === true) {
        principal.FetchDadosGlobal('adicionarItensPedido', "POST", { produtoId: produto, idPedido: pedidoId, quantidade, preco },"pedidos");
        principal.abrirCarregar();
        await principal.renderizarItensDoPedido(pedidoId);
        principal.fecharCarregar("success","Pronto!");
   }
}

      