import central from "../central.js";
let principal = new central();

import { renderizarConteudo } from "./function/renderizarPaginaPrincipal.js";
import { dadosPedidos, renderizarItensDoPedido } from "./function/renderizarItensDoPedido.js";
import { renderizarConteudoTab } from "./function/renderizarConteudoTab.js";
import { inicilizar } from "./function/renderizarConteudoTab.js";
import { SoftDelete } from "./function/deletarPedidos.JS";
import { SoftDeleteItens } from "./function/deletarItensDoPedido.js";
import { atualizarFormulario } from "./function/atualizarFormulario.js";
import { adicionarProduto } from "./function/adicionarProdutoPedidos.js";
import { alterarStatus } from "./function/alterarStatusPedido.js";
import { produtosAtivos } from "./function/renderizarConteudoTab.js";

// Começa com a pagina de pedidos novos como padrao;
inicilizar();



// Evento listener do botao para renderizar
document.querySelectorAll('.pedidosBusca').forEach(button => {
   button.addEventListener('click', async () => {
      const pedidoId = button.getAttribute('data-id');
      await renderizarConteudoTab(pedidoId);
   });
});


// Botao Ver
document.addEventListener("click", async (event) => {    
    const btn = event.target.closest(".botaoVerItens");
    if (!btn) return;
    const pedidoId = btn.dataset.id;
    const usuarioId = btn.dataset.usuarioId;
    principal.abrirCarregar();
    await renderizarItensDoPedido(pedidoId, usuarioId);
    principal.fecharCarregar("success","Pronto!");
});

// Botao Deletar Pedido
document.addEventListener('click', async (deletar) => {
   const btndelete = deletar.target.closest('.deletarPedido');
   if (!btndelete) return;
   const pedidoId = btndelete.dataset.id;
   const status = btndelete.dataset.status;
   await SoftDelete(pedidoId,status);
});



// Botao deletar os Itens do Pedido
document.addEventListener('click', async (deletar) => {
   const btnDeletarItens = deletar.target.closest('.deleteItensPedido');
   if (!btnDeletarItens) return;
   const itemId = btnDeletarItens.dataset.id;
   const pedidoId = btnDeletarItens.dataset.pedidoId;
   const usuarioId = btnDeletarItens.dataset.usuarioid;
   await SoftDeleteItens(itemId,pedidoId, usuarioId);
});



//Botao salvar Formulario

document.addEventListener('click', async (deletar) => {
   const btnAtualizarFormulario = deletar.target.closest('.btn-atualizarFormulario');
   if (!btnAtualizarFormulario) return;
   const pedidoId = btnAtualizarFormulario.dataset.pedidoId;
   const qtd = btnAtualizarFormulario.dataset.qtd;
   await atualizarFormulario(pedidoId, qtd);
});



// B0otao adicionar Produto do modal ver
document.addEventListener('change', async (adicionar) => {
   const btnAdicionarProduto = adicionar.target.closest('.select_produto');
   if (!btnAdicionarProduto) return;
   const dados = {
      produtoId: btnAdicionarProduto.value.split("@")[0],
      preco: btnAdicionarProduto.value.split("@")[1],
      pedidoId: btnAdicionarProduto.value.split("@")[2]
   };
   await adicionarProduto(dados);
});


document.addEventListener('change', async (event) => {
   const AlterarStatus = event.target.closest('.select_status_pedido');
   if (!AlterarStatus) return;
   const status = AlterarStatus.value;
   const idPedido = AlterarStatus.dataset.pedidoId;
   const valorAtualTab = AlterarStatus.dataset.valorAtualTab;
   await alterarStatus(status, idPedido, valorAtualTab);
   inicilizar()
})



// window.onload = async function() {
//    // setInterval(mostrarNotificacoes, 1000);
// };


// async function mostrarNotificacoes() {
//    let dados = await FetchDadosGlobal("notificacoes/1", "GET","pedidos");
//    let qtdAtual = dados.contagem;
//    if (qtdAtual > qtdAnterior) {
//       let novosPedidos = qtdAtual - qtdAnterior;
      
//       qtdAnterior = qtdAtual;
//    }
//    qtdAnterior = qtdAtual;
// }
