import central from "../central.js";
let principal = new central();



export async function qtditemFormulario(qtd, pedido_id) {
   let arrayItems = [];
   for (let index = 1; index <= qtd; index++) {
      let qtdItem = document.getElementById(`itemQTD${index}`).value;
      let IDitem = document.getElementById(`itemID${index}`).value;
      if (qtdItem <= 0) {
            principal.fecharCarregar("A quantidade de itens deve ser maior que zero.","error");
         return;
      }
      arrayItems.push({ id: IDitem, quantidade: qtdItem });
   }
   principal.FetchDadosGlobal('atualizarItensPedidoQTD', "POST","pedidos", { itens: arrayItems });
}