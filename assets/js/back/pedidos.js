/**
 * =========================
 * VARIÁVEIS GLOBAIS
 * =========================
 */
let comparacao = null;
let qtdAnterior = 0;

/**
 * =========================
 * FUNÇÕES UTILITÁRIAS
 * =========================
 */

// Fetch genérico para dados dos pedidos
async function FetchDadosGlobal(url, metodo, dados) {
  let config = {
    method: metodo,
    cache: "no-store",
    headers: {
      "Content-Type": "application/json",
      "Authorization": "Bearer 5d242b5294d72df332ca2c492d2c0b9b"
    }
  };
  if (metodo === "POST") {
    config.body = JSON.stringify(dados);
  }
  const res = await fetch(`/backend/pedidos/api/${url}`, config);
  return await res.json();
}

/**
 * =========================
 * RENDERIZAÇÃO DE CONTEÚDO
 * =========================
 */

// Renderiza tabela de pedidos na aba
async function renderizarConteudo(pedidoId) {
   let conteudo = await FetchDadosGlobal(`buscarTipoPedidos/${pedidoId}`,"GET");
   const container = document.getElementById(`itens${pedidoId}`);
   if (!container) return;
   const pedidos = Array.isArray(conteudo?.pedidos) ? conteudo.pedidos : [];
   const statusList = Array.isArray(conteudo?.statusPedido) ? conteudo.statusPedido : [];
   container.replaceChildren();
   if (pedidos.length === 0) {
      const msg = document.createElement("p");
      msg.className = "titulo_carregando";
      msg.textContent = "Nenhum pedido encontrado.";
      container.appendChild(msg);
      return;
   }

   const wrapper = document.createElement("div");
   wrapper.style.marginTop = "16px";
   const responsiveDiv = document.createElement("div");
   responsiveDiv.className = "w3-responsive card-table";
   const table = document.createElement("table");
   table.className = "w3-table w3-striped w3-white";

   // Cabeçalho
   const thead = document.createElement("thead");
   thead.className = "table-head";
   thead.innerHTML = `
      <tr>
         <th class="td-tight"><i class="fa fa-hashtag"></i> ID</th>
         <th><i class="fa fa-user"></i> Cliente</th>
         <th class="td-tight"><i class="fa fa-info-circle"></i> Status</th>
         <th class="td-tight"><i class="fa fa-calendar"></i> Data</th>
         <th class="td-tight"><i class="fa fa-list"></i> Tipo Pedido</th>
         <th class="td-tight"><i class="fa fa-cutlery"></i> Itens</th>
         <th class="td-tight"><i class="fa fa-trash"></i> Excluir</th>
         <th class="td-tight"><i class="fa fa-refresh"></i> Atualizar Pedido!</th>
      </tr>`;
   const tbody = document.createElement("tbody");

   for (const pedido of pedidos) {
      const tr = document.createElement("tr");
      tr.className = "table-row";
      const td = (html) => {
         const cell = document.createElement("td");
         cell.className = "td-tight";
         if (typeof html === "string") cell.innerHTML = html;
         else cell.appendChild(html);
         return cell;
      };
      tr.appendChild(td(`${pedido.pedido_id}`));
      tr.appendChild(td(`<i class="fa fa-user" style="color:#34495e;"></i> <span>${pedido.nome}</span>`));
      tr.appendChild(td(`<span class="badge"><i class="fa"></i> ${pedido.descricao}</span>`));
      tr.appendChild(td(`<i class="fa fa-calendar"></i> ${pedido.criado_em}`));
      tr.appendChild(td(`<i class="fa fa-list"></i> ${pedido.descricao_tipo}`));

      // Botão "Ver Itens"
      const btnView = document.createElement("button");
      btnView.className = "w3-button action-btn btn-view";
      btnView.dataset.id = pedido.pedido_id;
      btnView.title = "Ver itens do pedido";
      btnView.innerHTML = `<i class="fa fa-eye"></i> Ver`;
      btnView.onclick = () => verItensPedidos(pedido.pedido_id, pedido.usuario_id);
      tr.appendChild(td(btnView));

      // Botão "Excluir"
      const btnDelete = document.createElement("button");
      btnDelete.className = "w3-button action-btn btn-delete";
      btnDelete.dataset.id = pedido.pedido_id;
      btnDelete.id = "botaoExcluir";
      btnDelete.innerHTML = `<i class="fa fa-trash"></i> Excluir`;
      btnDelete.onclick = () => SoftDelete(pedido.pedido_id);
      tr.appendChild(td(btnDelete));

      // Select de status
      let select = document.createElement("select");
      select.className = "select_status";
      select.name = `pedido-status-${pedido.pedido_id}`;
      select.id = `pedido-status-${pedido.pedido_id}`;
      select.onchange = (e) => alterarStatus(e.target.value, pedido.pedido_id,pedidoId);
      for (const status of statusList) {
         select.appendChild(new Option(status.descricao, status.id));
      }
      tr.appendChild(td(select));
      tbody.appendChild(tr);
      select.value = pedidoId;
   }
   table.appendChild(thead);
   table.appendChild(tbody);
   responsiveDiv.appendChild(table);
   wrapper.appendChild(responsiveDiv);
   container.appendChild(wrapper);
   
   return conteudo.pedidos.length;
}

// Renderiza detalhes e edição dos itens do pedido no modal
async function renderizarItensDoPedido(pedidoId, usuarioId) {
      const items = document.getElementById('itemsPedidos');
      let dados = await FetchDadosGlobal(`busca/${pedidoId}`, "GET");
      let qtd = 0;
      let html = `
         <div id="aba-ver" class="tab-content active">
            <h3 style="margin-top:0; color:#2f3a57">
               <i class="fa fa-cutlery"></i> Detalhes do Pedido
            </h3>
      `;
      if (dados.tipoPedido.tipo_pedido === 3) {
         let enderecoDados = await FetchDadosGlobal(`buscaEndereco/${usuarioId}`, "GET");
         html += `
            <h4 style="color:#2f3a57; margin-top:15px;">
               <i class="fa fa-map-marker"></i> Endereço de Entrega
            </h4>
            <ul class="details-list">
               <li><strong>Rua:</strong> ${enderecoDados.endereco.rua}, Nº ${enderecoDados.endereco.numero}</li>
               <li><strong>Bairro:</strong> ${enderecoDados.endereco.bairro}</li>
               <li><strong>Cidade:</strong> ${enderecoDados.endereco.cidade} - ${enderecoDados.endereco.estado}</li>
               <li><strong>CEP:</strong> ${enderecoDados.endereco.cep}</li>
            </ul>
         `;
      }
      html += `
            <table class="table-default">
               <thead>
                  <tr>
                     <th>Produto</th>
                     <th>Quantidade</th>
                     <th>Valor Unitário</th>
                     <th>Subtotal</th>
                     <th>Remover</th>
                  </tr>
               </thead>
               <tbody>
      `;
      dados.dados2.forEach(item => {
         qtd++;
         let subtotal = item.quantidade * item.valor_unitario;
         html += `
            <tr>
               <input type="hidden" id="itemID${qtd}" value="${item.item_id}" min="1">
               <td>${item.nome}</td>
               <td>
                  <input type="number" min="1" class="input-number" id="itemQTD${qtd}" value="${item.quantidade}">
               </td>
               <td>R$ ${Number(item.valor_unitario).toFixed(2)}</td>
               <td>R$ ${subtotal.toFixed(2)}</td>
               <td>
                  <button class="btn-delete" onclick="SoftDeleteItens(${item.item_id}, ${pedidoId})">
                     Excluir
                  </button>
               </td>
            </tr>
         `;
      });
      // Linha para adicionar novo produto
      html += `
            <tr>
               <td colspan="2" style="text-align:right;">
                  <select id="novo-Produto${pedidoId}" class="select_status" style="max-width:240px;">
                     <option value="0">ESCOLHA O PRODUTO</option>`;
      dados.produtos.forEach(produto => {
         html += `<option value="${produto.produto_id}@${produto.preco}">${produto.nome}</option>`;
      });
      html += `
                  </select>
                  <input type="number" min="1" id="nova-Quantidade" class="input-number" value="1" style="margin-left:8px;">
                  <button class="btn-blue" onclick="adicionarProduto('${pedidoId}')" style="margin-left:8px;">
                     <i class="fa fa-plus"></i> Adicionar
                  </button>
               </td>
            </tr>
      `;
      html += `
               </tbody>
            </table>
            <h4 style="margin-top:18px; color:#2f3a57"><i class="fa fa-credit-card"></i> Pagamento</h4>
            <ul class="details-list">
               <li><input type="hidden" id="valor_total${pedidoId}" value="${dados.valorTotal}"><strong>Valor Total:</strong> R$ ${dados.valorTotal}</li>
               <li><strong>Status:</strong><select id="status_pagamento_id${pedidoId}" class="select_status" style="max-width:240px;">`;
      dados.statusPagamento.forEach(status => {
         html += `<option value="${status.id}">${status.descricao}</option>`;
      });
      html += `</select></li>
               <li><strong>Método:</strong><select id="pagamentoMetodo${pedidoId}" class="select_status" style="max-width:240px;">`;
      dados.metodoPagamento.forEach(pagamento => {
         html += `<option value="${pagamento.id}">${pagamento.descricao_metodo}</option>`;
      });
      html += `</select></li>
            </ul>
            <button class="btn-primary" onclick="atualizarFormulario(${pedidoId}, ${qtd})">
               <i class="fa fa-save"></i> Salvar Alterações
            </button>
         </div>
      `;
      items.innerHTML = html;
      const modal = document.getElementById('id01');
      document.getElementById(`pagamentoMetodo${pedidoId}`).value = `${dados.buscarMetodoPagamento.metodo}`;
      document.getElementById(`status_pagamento_id${pedidoId}`).value = `${dados.buscarMetodoPagamento.status_pagamento_id}`;
      modal.style.display = "block";
      window.onclick = function(event) {
         if (event.target === modal) modal.style.display = "none";
      };
   }

/**
 * =========================
 * EVENTOS DE TABS E ATUALIZAÇÃO
 * =========================
 */

// Renderiza conteúdo ao clicar na tab
document.querySelectorAll('.pedidosBusca[data-id]').forEach(btn => {
   btn.addEventListener('click', async () => {
      clearInterval(comparacao);
      const pedidoId = btn.getAttribute('data-id');
      const container = document.getElementById(`itens${pedidoId}`);
      abrirCarregar();
      let qtdAntiga = await renderizarConteudo(pedidoId) ?? 0;
      fecharCarregar();
      // comparacao = setInterval(async () => {
      //    let dados = await FetchDadosGlobal(`quantidades/${pedidoId}`,"GET");
      //    let novaQtd = dados.contagem;
      //    if (novaQtd != qtdAntiga) {
      //       abrirCarregar();
      //       let qtdNova = await renderizarConteudo(pedidoId);
      //       fecharCarregar();
      //       qtdAntiga = qtdNova;
      //    }
      // }, 5000);
   });
});

/**
 * =========================
 * MODAIS: VER/EDITAR ITENS
 * =========================
 */
async function verItensPedidos(pedidoId, usuarioId) {
   abrirCarregar();
   await renderizarItensDoPedido(pedidoId, usuarioId);
   fecharCarregar();
}

/**
 * =========================
 * FECHAR MODAIS
 * =========================
 */
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
         FetchDadosGlobal('deletar', "POST", { idPedido });
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
         FetchDadosGlobal('deletarItem', "POST", { itemId });
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
   FetchDadosGlobal('atualizarItensPedidoQTD', "POST", { itens: arrayItems });
   await atualizarPagamento(pedidoId);
}

async function atualizarPagamento(pedidoId) {
   let dados = await FetchDadosGlobal(`busca/${pedidoId}`, "GET");
   let valorTotal = dados.valorTotal.replace(',', '.');
   let statusID = parseInt(document.getElementById(`status_pagamento_id${pedidoId}`).value);
   let metodoID = parseInt(document.getElementById(`pagamentoMetodo${pedidoId}`).value);
   FetchDadosGlobal('atualizarMetodo', "POST", { statusID, metodoID, valorTotal, pedidoId });
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
   let dados = await FetchDadosGlobal(`busca/${pedidoId}`, "GET");
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
         FetchDadosGlobal('adicionarItensPedido', "POST", { produtoId: produto, idPedido: pedidoId, quantidade, preco });
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
         FetchDadosGlobal('atualizarItensPedidoQTD', "POST", { itens: arrayItems });
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
            FetchDadosGlobal('atualizarProcesso', "POST", { status: status, idPedido: idPedido });
            notificar("success","Alterado com sucesso!")
            await renderizarConteudo(dados.dados2[0].status_pedido_id);
         }
      });
   }
}

/**
 * =========================
 * TABS - NAVEGAÇÃO
 * =========================
 */
function openPage(pageName, elmnt, color) {
   var i, tabcontent, tablinks;
   tabcontent = document.getElementsByClassName("tabcontent");
   for (i = 0; i < tabcontent.length; i++) {
      tabcontent[i].style.display = "none";
   }
   tablinks = document.getElementsByClassName("tablink");
   for (i = 0; i < tablinks.length; i++) {
      tablinks[i].style.backgroundColor = "";
   }
   document.getElementById(pageName).style.display = "block";
   elmnt.style.backgroundColor = color;
}
document.getElementById("defaultOpen").click();

/**
 * =========================
 * NOTIFICAÇÕES
 * =========================
 */
window.onload = async function() {
   // setInterval(mostrarNotificacoes, 1000);
};


async function mostrarNotificacoes() {
   let dados = await FetchDadosGlobal("notificacoes/1", "GET");
   let qtdAtual = dados.contagem;
   if (qtdAtual > qtdAnterior) {
      let novosPedidos = qtdAtual - qtdAnterior;
      
      qtdAnterior = qtdAtual;
   }
   qtdAnterior = qtdAtual;
}


function abrirCarregar(){
   Swal.fire({
  title: "CARREGANDO",
  html: "Espere por favor...",
  allowEscapeKey: false,
  allowOutsideClick: false,
  showConfirmButton: false,
  didOpen: () => {
    Swal.showLoading();
  }
});


}
function fecharCarregar(){
   Swal.close();
   Swal.fire({
  position: "top-end",
  icon: "success",
  title: "Pronto!",
  showConfirmButton: false,
  timer: 900
});
}