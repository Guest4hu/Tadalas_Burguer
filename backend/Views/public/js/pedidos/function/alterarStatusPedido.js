import Central from "../../central.js";
const principal = new Central();


export async function alterarStatus(status, idPedido, valorAtualTab) {
    if (valorAtualTab == status) {
        principal.fecharCarregar("info","O pedido ja esta neste status!");
      return;
   } else {
        if (await principal.alertaConfirmacao("Voce deseja alterar o status deste pedido?","Alterar Status", "info") === true) {     
            principal.FetchDadosGlobal('atualizarProcesso', "POST", "pedidos",{ status: status, idPedido: idPedido });
            principal.tocarAudio(principal.notificacao);
            await principal.renderizarConteudo(valorAtualTab);
        }
      };
}
    