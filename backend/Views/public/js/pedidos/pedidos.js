
import { renderizarConteudo } from "./function/renderizarPaginaPrincipal.js";
import { renderizarItensDoPedido } from "./function/renderizarItensDoPedido.js";
import { renderizarConteudoTab } from "./function/renderizarConteudoTab.js";



// Evento listener do botao para renderizar
document.querySelectorAll('.pedidosBusca').forEach(button => {
   button.addEventListener('click', async () => {
      const pedidoId = button.getAttribute('data-id');
      await renderizarConteudoTab(pedidoId);
   });
});

// Funcao para inicializar
async function inicilizar() {
   await renderizarConteudoTab(1);
}

inicilizar();


async function verItensPedidos(pedidoId, usuarioId) {
   principal.abrirCarregar();
   await renderizarItensDoPedido(pedidoId, usuarioId);
   principal.fecharCarregar();
}


document.querySelectorAll('.modal .close').forEach(btn => {
   btn.onclick = function() {
      btn.closest('.modal').style.display = "none";
   };
});

/**
 * =========================
 * SOFT DELETE PEDIDO/ITEM
 * =========================
 */
function SoftDelete(idPedido) {
   Swal.fire({
      title: "Você tem certeza?",
      text: "Você não poderá reverter isso!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Sim, Deletar Pedido!"
   }).then((result) => {
      if (result.isConfirmed) {
         FetchDadosGlobal('deletar', "POST", { idPedido },"pedidos");
         Swal.fire({
            title: "Deletado!",
            text: "Seu pedido está sendo deletado.",
            icon: "success",
            timerProgressBar: true,
         });
      }
   });
}

async function SoftDeleteItens(itemId, pedidoId) {
   Swal.fire({
      title: "Você tem certeza?",
      text: "Você ira Remover o Item todo!, Caso queira apenas alterar a quantidade, utilize o campo editar!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Sim, Deletar Item!"
   }).then(async (result) => {
      if (result.isConfirmed) {
         FetchDadosGlobal('deletarItem', "POST", { itemId },"pedidos");
         abrirCarregar();
         await atualizarPagamento(pedidoId);
         await renderizarItensDoPedido(pedidoId);
         fecharCarregar();
      }
   });
}

/**
 * =========================
 * ATUALIZAÇÃO DE ITENS E PAGAMENTO
 * =========================
 */
async function qtditemFormulario(qtd, pedidoId) {
   let arrayItems = [];
   for (let index = 1; index <= qtd; index++) {
      let qtdItem = document.getElementById(`itemQTD${index}`).value;
      let IDitem = document.getElementById(`itemID${index}`).value;
      if (qtdItem <= 0) {
         Swal.fire({
            icon: "error",
            title: "Erro",
            text: "Por favor, insira uma quantidade válida para todos os itens.",
         });
         return;
      }
      arrayItems.push({ id: IDitem, quantidade: qtdItem });
   }
   FetchDadosGlobal('atualizarItensPedidoQTD', "POST", { itens: arrayItems },"pedidos");
   await atualizarPagamento(pedidoId);
}

async function atualizarPagamento(pedidoId) {
   let dados = await FetchDadosGlobal(`busca/${pedidoId}`, "GET","pedidos");
   let valorTotal = dados.valorTotal.replace(',', '.');
   let statusID = parseInt(document.getElementById(`status_pagamento_id${pedidoId}`).value);
   let metodoID = parseInt(document.getElementById(`pagamentoMetodo${pedidoId}`).value);
   FetchDadosGlobal('atualizarMetodo', "POST", { statusID, metodoID, valorTotal, pedidoId },"pedidos");
}

async function atualizarFormulario(pedidoId, qtd) {
   Swal.fire({
      title: "Atualizar Pedido?",
      text: "Você tem certeza que deseja atualizar o pedido?",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      cancelButtonText: "Cancelar",
      confirmButtonText: "Sim, atualizar!"
   }).then((result) => {
      if (result.isConfirmed) {
         (async () => {
            abrirCarregar();
            await qtditemFormulario(qtd, pedidoId);
            await atualizarPagamento(pedidoId);
            await renderizarItensDoPedido(pedidoId);
            fecharCarregar();
         })();
      }
   });
}

/**
 * =========================
 * ADICIONAR PRODUTO AO PEDIDO
 * =========================
 */
async function adicionarProduto(pedidoId) {
   const selectProduto = document.getElementById(`novo-Produto${pedidoId}`);
   let dados = await FetchDadosGlobal(`busca/${pedidoId}`, "GET","pedidos");
   let qtd = dados.dados2.length;
   const valor = selectProduto.value;
   const quantidade = document.getElementById("nova-Quantidade").value;

   if (selectProduto.value === "0") {
      Swal.fire({
         icon: "error",
         title: "Erro",
         text: "Por favor, selecione um produto válido.",
      });
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
      Swal.fire({
         icon: "error",
         title: "Erro",
         text: "Por favor, insira uma quantidade válida.",
      });
      return;
   }
   const [produto, preco] = valor.split("@");
   Swal.fire({
      title: "Você tem certeza?",
      text: "Você não poderá reverter isso!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Sim, Atualizar Produto!"
   }).then(async (result) => {
      if (result.isConfirmed) {
         FetchDadosGlobal('adicionarItensPedido', "POST", { produtoId: produto, idPedido: pedidoId, quantidade, preco },"pedidos");
         abrirCarregar();
         await qtditemFormulario(qtd, pedidoId);
         await atualizarPagamento(pedidoId);
         await renderizarItensDoPedido(pedidoId);
         fecharCarregar();
      }
   });
}

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
