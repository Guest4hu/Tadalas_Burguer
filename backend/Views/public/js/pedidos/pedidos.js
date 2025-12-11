import central from "../central.js";
let principal = new central();

import { renderizarConteudo } from "./function/renderizarPaginaPrincipal.js";
import { renderizarItensDoPedido } from "./function/renderizarItensDoPedido.js";
import { renderizarConteudoTab } from "./function/renderizarConteudoTab.js";
import { inicilizar } from "./function/renderizarConteudoTab.js";
import { SoftDelete } from "./function/deletarPedidos.JS";
import { SoftDeleteItens } from "./function/deletarItensDoPedido.js";
import { atualizarFormulario } from "./function/atualizarFormulario.js";

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
   await SoftDeleteItens(itemId,pedidoId);
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
document.addEventListener('click', async (adicionar) => {
   const btnAdicionarProduto = adicionar.target.closest('.adicionarItensPedidos');
   if (!btnAdicionarProduto) return;
});


document.addEventListener('click', async (adicionar) => {
   const btnAdicionarProduto = adicionar.target.closest('.adicionarItensPedidos');
   if (!btnAdicionarProduto) return;
   const pedidoId = btnAdicionarProduto.dataset.pedidoId;
   const dados = btnAdicionarProduto.dataset.dados;
   await adicionarProduto(pedidoId,dados);

});



async function adicionarqtdExistente(pedidoId, item_id, quantidade) {
   let arrayItems = [{ id: item_id, quantidade: quantidade }];
   Swal.fire({
      title: "O produto já existe!",
      text: "Atualizar apenas a quantidade?",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Sim, Atualizar!"
   }).then(async (result) => {
      if (result.isConfirmed) {
         FetchDadosGlobal('atualizarItensPedidoQTD', "POST", { itens: arrayItems },"pedidos");
         abrirCarregar();
         await atualizarPagamento(pedidoId);
         await renderizarItensDoPedido(pedidoId);
         fecharCarregar();
      }
   });
}

/**
 * =========================
 * ALTERAR STATUS DO PEDIDO
 * =========================
 */
async function alterarStatus(status, idPedido, valorAtualTab) {
    if (valorAtualTab == status) {
      Swal.fire({
         icon: "info",
         title: "Info",
         text: "O pedido já está com esse status.",
      });
      return;
   } else {
      Swal.fire({
         title: "Você tem certeza?",
         text: "Você não poderá reverter isso!",
         icon: "warning",
         showCancelButton: true,
         confirmButtonColor: "#3085d6",
         cancelButtonColor: "#d33",
         confirmButtonText: "Sim, Atualizar Pedido!"
      }).then(async (result) => {
         if (result.isConfirmed) {
            FetchDadosGlobal('atualizarProcesso', "POST", { status: status, idPedido: idPedido },"pedidos");
            notificar("success","Alterado com sucesso!")
            await renderizarConteudo(dados.dados2[0].status_pedido_id);
         }
      });
   }
}

window.onload = async function() {
   // setInterval(mostrarNotificacoes, 1000);
};


async function mostrarNotificacoes() {
   let dados = await FetchDadosGlobal("notificacoes/1", "GET","pedidos");
   let qtdAtual = dados.contagem;
   if (qtdAtual > qtdAnterior) {
      let novosPedidos = qtdAtual - qtdAnterior;
      
      qtdAnterior = qtdAtual;
   }
   qtdAnterior = qtdAtual;
}
