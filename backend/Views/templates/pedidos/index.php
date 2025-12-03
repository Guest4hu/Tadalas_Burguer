<style>
   .select_status {
      appearance: none;
      -webkit-appearance: none;
      -moz-appearance: none;
      background: linear-gradient(135deg, #3949AB 0%, #5C6BC0 100%);
      font-weight: 600;
      font-size: 15px;
      padding: 8px 32px 8px 12px;
      border: none;
      border-radius: 8px;
      box-shadow: 0 2px 8px rgba(60, 60, 120, 0.10);
      transition: background 0.2s, color 0.2s, box-shadow 0.2s;
      outline: none;
      cursor: pointer;
      position: relative;
      margin: 0 2px;
   }

   .select_status:focus,
   .select_status:hover {
      background: linear-gradient(135deg, #1976D2 0%, #42A5F5 100%);
      color: #fff;
      box-shadow: 0 4px 16px rgba(33, 150, 243, 0.15);
   }

   .select_status option {
      color: #2f3a57;
      background: #fff;
      font-weight: 600;
      border-radius: 0;
      padding: 8px;
   }

   .select_status:disabled {
      opacity: .6;
      cursor: not-allowed;
   }

   .select_status::-ms-expand {
      display: none;
   }

   /* Custom arrow */
   .select_status {
      background-image: url("data:image/svg+xml;charset=UTF-8,<svg width='16' height='16' viewBox='0 0 16 16' fill='orange' xmlns='http://www.w3.org/2000/svg'><path d='M4 6l4 4 4-4' stroke='white' stroke-width='2' fill='none' stroke-linecap='round'/></svg>");
      background-repeat: no-repeat;
      background-position: right 12px center;
      background-size: 18px 18px;
   }

   @media (max-width: 900px) {
      .select_status {
         font-size: 13px;
         padding: 6px 28px 6px 10px;
      }
   }

   .stat-card {
      border-radius: 10px;
      box-shadow: 0 6px 16px rgba(0, 0, 0, .12);
      position: relative;
      overflow: hidden;
   }

   .stat-card .w3-left {
      opacity: .9
   }

   .stat-card h3 {
      margin: 0;
      font-weight: 700;
      letter-spacing: .5px
   }

   .stat-subtitle {
      margin: 6px 0 0;
      font-weight: 600
   }

   .bg-blue {
      background: linear-gradient(135deg, #1976D2 0%, #42A5F5 100%)
   }

   .bg-green {
      background: linear-gradient(135deg, #2E7D32 0%, #66BB6A 100%)
   }

   .bg-orange {
      background: linear-gradient(135deg, #EF6C00 0%, #FFA726 100%)
   }

   .bg-indigo {
      background: linear-gradient(135deg, #3949AB 0%, #5C6BC0 100%)
   }

   .bg-red {
      background: linear-gradient(135deg, #C62828 0%, #FF5252 100%)
   }

   /* Tabela */
   .card-table {
      border-radius: 10px;
      overflow: hidden;
      box-shadow: 0 6px 16px rgba(0, 0, 0, .08);
   }

   .table-head {
      background: #f7f9fc;
      border-bottom: 1px solid #e6ebf1
   }

   .table-head th {
      font-weight: 700;
      color: #2f3a57;
      white-space: nowrap
   }

   .table-row:hover {
      background: #f9fbff
   }

   .td-tight {
      white-space: nowrap
   }

   .badge {
      font-size: 12px;
      padding: 4px 10px;
      border-radius: 999px;
      font-weight: 700;
      display: inline-flex;
      align-items: center;
      gap: 6px
   }

   .badge i {
      font-size: 12px
   }

   .badge-blue {
      background: #E3F2FD;
      color: #1565C0
   }

   .badge-amber {
      background: #FFF8E1;
      color: #EF6C00
   }

   .badge-red {
      background: #FFEBEE;
      color: #C62828
   }

   .badge-green {
      background: #E8F5E9;
      color: #2E7D32
   }

   .badge-gray {
      background: #ECEFF1;
      color: #455A64
   }

   /* Ações */
   .action-btn {
      border-radius: 8px;
      padding: 6px 10px;
      font-weight: 600
   }

   .action-btn i {
      margin-right: 6px
   }

   .btn-desativo {
      background: #C62828;
      color: #FFCDD2;
      border: 1px solid #FFCDD2;
   }

   .btn-edit {
      display: flex;
      background: #E3F2FD;
      color: #1565C0;
      justify-content: center;
      text-align: center;
   }

   .btn-delete {
      background: #FFEBEE;
      color: #C62828
   }

   .btn-edit:hover {
      background: #BBDEFB
   }

   .btn-delete:hover {
      background: #FFCDD2
   }

   .btn-view {
      background: #E8F5E9;
      color: #2E7D32
   }

   .btn-view:hover {
      background: #C8E6C9
   }

   /* Paginação */
   .pager .w3-button {
      border-radius: 8px;
      font-weight: 600
   }

   .pager .w3-button.w3-disabled {
      opacity: .5;
      cursor: not-allowed
   }

   /* Modal */
   .modal {
      display: none;
      position: fixed;
      z-index: 1001;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      overflow: auto;
      background-color: rgba(0, 0, 0, 0.4);
   }

   .modalEditar {
      display: none;
      position: fixed;
      z-index: 1002;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      overflow: auto;
      background-color: rgba(0, 0, 0, 0.4);

   }

   .modal-content {
      background-color: #fefefe;
      margin: 5% auto;
      padding: 24px 20px;
      border: 1px solid #888;
      width: 90%;
      max-width: 600px;
      border-radius: 12px;
      box-shadow: 0 8px 32px rgba(0, 0, 0, .18);
      position: relative;
   }

   .close {
      float: right;
      font-size: 28px;
      font-weight: bold;
      cursor: pointer;
      position: absolute;
      right: 18px;
      top: 10px;
      transition: color .2s;
   }
   .titulo_carregando{
      text-align: center;
      font-size: 18px;
      color: #6b7a99;
      font-weight: 600;
   }

   .close:hover,
   .close:focus {
      color: #C62828;
      text-decoration: none;
      cursor: pointer;
   }

   .tablink {
      width: 100%;
      background: linear-gradient(135deg, #3949AB 0%, #5C6BC0 100%);
      color: #fff;
      border: none;
      outline: none;
      cursor: pointer;
      padding: 18px 0;
      font-size: 18px;
      font-weight: 700;
      transition: background 0.2s, color 0.2s, box-shadow 0.2s, transform 0.15s;
      border-radius: 12px 12px 0 0;
      box-shadow: 0 4px 16px rgba(60, 60, 120, 0.10);
      letter-spacing: 0.7px;
      /* float: left; */
      /* Removed to avoid conflict with display:inline-block */
      margin-right: 2px;
      display: inline-block;
      text-align: center;
      position: relative;
      z-index: 2;
   }

   .nav_botoes ul {
      display: flex;
      flex-direction: row;
      gap: 0;
      padding: 0;
      margin: 0 0 0 0;
      list-style: none;
      justify-content: space-between;
      align-items: stretch;
      background: #fff;
      border-radius: 12px 12px 0 0;
      box-shadow: 0 2px 8px rgba(60, 60, 120, 0.04);
      border-bottom: 1px solid black;
      overflow: hidden;
      width: 100%;
   }

   .nav_botoes ul li {
      width: 100%;
      margin: 0;
      padding: 0;
      display: flex;
   }

   .tablink:active,
   .tablink.active,
   .tablink[aria-selected="true"] {
      background: linear-gradient(135deg, #EF6C00 0%, #FFA726 100%);
      color: #fff;
      box-shadow: 0 8px 32px rgba(255, 152, 0, 0.18);
      border-bottom: 3px solid #fff;
      transform: translateY(-2px) scale(1.03);
      z-index: 3;
   }

   .tablink:hover,
   .tablink:focus {
      background: linear-gradient(135deg, #1976D2 0%, #42A5F5 100%);
      color: #fff;
      box-shadow: 0 6px 24px rgba(33, 150, 243, 0.15);
      transform: translateY(-1px) scale(1.01);
   }

   @media (max-width: 900px) {
      .tablink {
         font-size: 15px;
         padding: 12px 0;
      }

      .nav_botoes ul {
         flex-direction: column;
         border-radius: 12px;
      }

      .nav_botoes ul li {
         flex: 1 1 100%;
      }
   }

   .tablink:last-child {
      margin-right: 0;
   }

   .tablink:hover,
   .tablink:focus {
      background: linear-gradient(135deg, #1976D2 0%, #42A5F5 100%);
      color: #fff;
      box-shadow: 0 4px 16px rgba(33, 150, 243, 0.15);
   }

   .tablink.active,
   .tablink[aria-selected="true"] {
      background: linear-gradient(135deg, #EF6C00 0%, #FFA726 100%);
      color: #fff;
      box-shadow: 0 6px 24px rgba(255, 152, 0, 0.18);
      border-bottom: 3px solid #fff;
   }

   .tabcontent {
      padding: 32px 24px 24px 24px;
      background: #f7f9fc;
      border-radius: 0 0 12px 12px;
      box-shadow: 0 6px 24px rgba(0, 0, 0, 0.08);
      margin-top: -2px;
      min-height: 320px;
      animation: fadeInTab 0.3s;
   }

   @keyframes fadeInTab {
      from {
         opacity: 0;
         transform: translateY(16px);
      }

      to {
         opacity: 1;
         transform: translateY(0);
      }
   }

   /* Container for tabs */
   .tabs-container {
      width: 100%;
      display: flex;
      gap: 0;
      margin-bottom: 0;
      border-bottom: 1px solid #e6ebf1;
      background: #fff;
      border-radius: 12px 12px 0 0;
      box-shadow: 0 2px 8px rgba(60, 60, 120, 0.04);
      overflow: hidden;
   }

   /* Responsive tabs */
   @media (max-width: 900px) {
      .tablink {
         font-size: 15px;
         padding: 12px 0;
      }

      .tabcontent {
         padding: 20px 8px 8px 8px;
         min-height: 180px;
      }
   }

   .container {
      z-index: 5000;


   }
</style>

<header class="w3-container" style="padding:22px 0 12px 0;">
   <h5 style="margin:0; display:flex; align-items:center; gap:10px; color:#2f3a57">
      <i class="fa fa-cutlery" aria-hidden="true"></i>
      Painel de Pedidos
   </h5>
   <div style="color:#6b7a99; font-size:13px; margin-top:6px">Visão geral e gerenciamento dos pedidos do sistema</div>
</header>

<nav class="nav_botoes">
   <ul>
      <li>
         <button class="tablink pedidosBusca" data-id="1" onclick="openPage('novo', this, 'red')" id="defaultOpen">
            <i class="fa fa-plus-square" aria-hidden="true"></i> Novos
         </button>
      </li>
      <li>
         <button class="tablink pedidosBusca" data-id="2" onclick="openPage('emPreparo', this, 'green')">
            <i class="fa fa-fire" aria-hidden="true"></i> Em Preparo
         </button>
      </li>
      <li>
         <button class="tablink pedidosBusca" data-id="3" onclick="openPage('emEntrega', this, 'blue')">
            <i class="fa fa-truck" aria-hidden="true"></i> Saiu Para Entrega
         </button>
      </li>
      <li>
         <button class="tablink pedidosBusca" data-id="4" onclick="openPage('concluido', this, 'orange')">
            <i class="fa fa-check-circle" aria-hidden="true"></i> Concluídos
         </button>
      </li>
      <li>
         <button class="tablink pedidosBusca" data-id="5" onclick="openPage('cancelado', this, 'orange')">
            <i class="fa fa-ban" aria-hidden="true"></i> Cancelados
         </button>
      </li>
   </ul>
</nav>

<div id="novo" class="tabcontent">
   <div class="container" id="itens1">
      <p class="titulo_carregando">Carregando...</p>
   </div>
</div>
<div id="emPreparo" class="tabcontent">
   <div class="container" id="itens2">
      <p class="titulo_carregando">Carregando...</p>
   </div>
</div>
<div id="emEntrega" class="tabcontent">
   <div class="container" id="itens3">
      <p class="titulo_carregando">Carregando...</p>
   </div>
</div>
<div id="concluido" class="tabcontent">
   <div class="container" id="itens4">
      <p class="titulo_carregando">Carregando...</p>
   </div>
</div>
<div id="cancelado" class="tabcontent">
   <div class="container" id="itens5">
      <p class="titulo_carregando">Carregando...</p>
   </div>
</div>

<div id="id01" class="modal">
   <div class="modal-content">
      <button class="close" title="Fechar Modal">&times;</button>
      <div id="itemsPedidos"></div>
   </div>
</div>
<div id="id02" class="modal">
   <div class="modal-content">
      <button class="close" title="Fechar Modal">&times;</button>
      <div id="editarItems"></div>
   </div>
</div>
<div id="id03" class="modalEditar">
   <div class="modal-content">
      <button class="close" title="Fechar Modal">&times;</button>
      <div id="editarPagamentoeEndereco"></div>
   </div>
</div>

<script defer>
   /**
    * Painel de Pedidos - JS
    * Organização minuciosa por GitHub Copilot
   */
  
  // ==========================
  // Variáveis Globais
  // ==========================


  // Parar o polling anterior quanto trocar de aba
  let comparacao = null;
  

  // Comparar com as notificações qtdAnterior
  let qtdAnterior = 0;
// ==========================
// Funções utilitárias
// ==========================


/**
 * Função para obter o numero de pedidos novos para utilizar nas notificações
 */

async function contarNotificacoes() {
   let response = await fetch(`/backend/pedidos/notificacoes/1`, {
      method: "GET",
      cache: "no-store"
   });
   const data = await response.json();
   return data.contagem;
}
/**
 * Atualiza a quantidade de pedidos de um tipo
 */
async function atualizarPedido(pedidoId) {
   let response = await fetch(`/backend/pedidos/quantidades/${pedidoId}`, {
      method: "GET",
      cache: "no-store"
   });
   const data = await response.json();
   return data.contagem;
}

/**
 * Busca os pedidos de um tipo
 */
async function buscarPedidos(pedidoId) {
   let response = await fetch(`/backend/api/pedidos/buscarTipoPedidos/${pedidoId}`, {
      method: "GET",
      cache: "no-store"
   });
   const data = await response.json();
   return data;
}

/**
 * Renderiza o conteúdo dos pedidos na tabela
 */
function renderizarConteudo(conteudo, pedidoId) {
   // 1️⃣ Obter o container
   const container = document.getElementById(`itens${pedidoId}`);
   if (!container) {
      console.error(`Elemento com id "itens${pedidoId}" não encontrado.`);
      return;
   }

   // 2️⃣ Validar conteúdo recebido
   const pedidos = Array.isArray(conteudo?.pedidos) ? conteudo.pedidos : [];
   const statusList = Array.isArray(conteudo?.statusPedido) ? conteudo.statusPedido : [];

   // 3️⃣ Limpar container
   container.replaceChildren();

   // 4️⃣ Se não houver pedidos
   if (pedidos.length === 0) {
      const msg = document.createElement("p");
      msg.className = "titulo_carregando";
      msg.textContent = "Nenhum pedido encontrado.";
      container.appendChild(msg);
      return;
   }

   // 5️⃣ Criar estrutura base da tabela
   const wrapper = document.createElement("div");
   wrapper.style.marginTop = "16px";

   const responsiveDiv = document.createElement("div");
   responsiveDiv.className = "w3-responsive card-table";

   const table = document.createElement("table");
   table.className = "w3-table w3-striped w3-white";

   // 6️⃣ Cabeçalho
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
         <th class="td-tight"><i class="fa fa-edit"></i> Editar</th>
         <th class="td-tight"><i class="fa fa-trash"></i> Excluir</th>
         <th class="td-tight"><i class="fa fa-refresh"></i> Atualizar Pedido!</th>
      </tr>`;

   // 7️⃣ Corpo da tabela
   const tbody = document.createElement("tbody");

   for (const pedido of pedidos) {
      const tr = document.createElement("tr");
      tr.className = "table-row";

      // Função auxiliar para criar célula
      const td = (html) => {
         const cell = document.createElement("td");
         cell.className = "td-tight";
         if (typeof html === "string") cell.innerHTML = html;
         else cell.appendChild(html);
         return cell;
      };

      // Células
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
      tr.appendChild(td(btnView));

      // Botão "Editar"
      const btnEdit = document.createElement("button");
      btnEdit.className = "w3-button w3-blue btn-edit";
      btnEdit.style.cssText = "border-radius:8px; font-weight:600; margin-top:8px;";
      btnEdit.dataset.id = pedido.pedido_id;
      btnEdit.id = `btn${pedido.pedido_id}`;
      btnEdit.innerHTML = `<i class="fa fa-edit"></i> Editar`;
      tr.appendChild(td(btnEdit));

      // Botão "Excluir"
      const btnDelete = document.createElement("button");
      btnDelete.className = "w3-button action-btn btn-delete";
      btnDelete.dataset.id = pedido.pedido_id;
      btnDelete.id = "botaoExcluir";
      btnDelete.innerHTML = `<i class="fa fa-trash"></i> Excluir`;
      btnDelete.onclick = () => SoftDelete(pedido.pedido_id);
      tr.appendChild(td(btnDelete));

      // Select de status
      const select = document.createElement("select");
      select.className = "select_status";
      select.name = `pedido-status-${pedido.pedido_id}`;
      select.id = `pedido-status-${pedido.pedido_id}`;
      select.onchange = (e) => alterarStatus(e.target.value, pedido.pedido_id);

      // Opções
      const optDefault = new Option("ESCOLHA AQUI", 0);
      select.appendChild(optDefault);

      for (const status of statusList) {
         select.appendChild(new Option(status.descricao, status.id));
      }

      tr.appendChild(td(select));

      tbody.appendChild(tr);
   }

   // 8️⃣ Montar hierarquia final
   table.appendChild(thead);
   table.appendChild(tbody);
   responsiveDiv.appendChild(table);
   wrapper.appendChild(responsiveDiv);
   container.appendChild(wrapper);
}

// ==========================
// Eventos de Tabs e Atualização
// ==========================



//Renderiza o conteudo ao clicar na tab

document.querySelectorAll('.pedidosBusca[data-id]').forEach(btn => {
   btn.addEventListener('click', async () => {

      // Limpar a busca do intervalo de outra Tab
      clearInterval(comparacao);
      const pedidoId = btn.getAttribute('data-id');
      // Faz a busca do counteudo com base no id da tab
      let conteudo = await buscarPedidos(pedidoId);
      // Renderiza o conteudo na Tab
      renderizarConteudo(conteudo, pedidoId);

      // Guarda a quantidade antiga antes de começar o polling
      let qtdAntiga = conteudo.pedidos.length;

      // Começo do polling
      comparacao = setInterval(async () => {

         // Faz a busca da quantidade atual do banco de dados
         let novaQtd = await atualizarPedido(pedidoId);

         // Comparação entre as quantidades
         if (novaQtd != qtdAntiga) {

            // Caso chegue uma quantidade nova atualizar o conteudo
            let conteudo = await buscarPedidos(pedidoId);
            renderizarConteudo(conteudo, pedidoId);
            qtdAntiga = conteudo.pedidos.length;
            console.log("Atualizei");
         }
      }, 5000);
   });
});

// ==========================
// Modais: Editar, Ver, Pagamento/Endereço
// ==========================

/**
 * Modal Editar Itens do Pedido
 */
document.querySelectorAll('.btn-edit[data-id]').forEach(btn => {
   btn.addEventListener('click', async () => {
      let qtd = 0;
      const id = btn.getAttribute('data-id');
      let response = await fetch(`/backend/pedidos/busca/${id}`, { method: "GET" });
      const dados = await response.json();
      const items = document.getElementById("editarItems");
      let html = `
<h3 style="margin-top:0; color:#2f3a57"><i class="fa fa-edit"></i> Editar Itens do Pedido</h3>
<table style="width:100%; border-collapse:collapse; margin-bottom:16px;">
   <thead>
      <tr>
         <th style="border:1px solid #ccc; padding:8px;">Produto</th>
         <th style="border:1px solid #ccc; padding:8px;">Quantidade</th>
      </tr>
   </thead>
   <tbody>
`;
      dados.dados2.forEach((item, idx) => {
         qtd++;
         html += `
<tr>
   <input type="hidden" name="itemID" value="${item.item_id}" id="itemID${qtd}">
   <td style="border:1px solid #ccc; padding:8px;">
      <input type="text" name="nome" value="${item.nome}" readonly style="width:100%; border:none; background:transparent;">
   </td>
   <td style="border:1px solid #ccc; padding:8px;">
      <input type="number" name="quantidade" value="${item.quantidade}" min="1" style="width:60px;" id="itemQTD${qtd}">
   </td>
</tr>`;
      });
      html += `
<tr>
   <td colspan="3" style="padding:8px; text-align:right;">
      <select name="" id="novo-Produto${id}" class="select_status">
         <option value="0" id="opcaoEscolha">ESCOLHA AQUI</option>
         <?php foreach ($produtos as $produto): ?>
            <option value="<?php echo htmlspecialchars($produto['produto_id']); ?>@<?php echo htmlspecialchars($produto['preco']); ?>"><?php echo $produto['nome']; ?></option>
         <?php endforeach; ?>
      </select>
      <input type="number" id="nova-Quantidade" min="1" value="1" style="width:60px; margin-left:8px;" placeholder="Qtd">
      <button type="button" class="w3-button w3-blue" id="btnAdicionarProduto" onclick="adicionarProduto('${id}')" style="margin-left:8px;">
         <i class="fa fa-plus"></i> Adicionar Produto
      </button>
   </td>
</tr>
   </tbody>
</table>
<button class="w3-button w3-green" style="border-radius:8px; font-weight:600;" onclick="qtditemFormulario(${qtd})">
   <i class="fa fa-save"></i> Salvar Alterações
</button>
`;
      items.innerHTML = html;
      const modal = document.getElementById('id02');
      modal.style.display = "block";
      window.onclick = function(event) {
         if (event.target === modal) modal.style.display = "none";
      };
   });
});

/**
 * Modal Ver Itens do Pedido
 */
document.querySelectorAll('.btn-view[data-id]').forEach(btn => {
   btn.addEventListener('click', async () => {
      const pedidoId = btn.getAttribute('data-id');
      let response = await fetch(`/backend/pedidos/busca/${pedidoId}`, { method: "GET" });
      const dados = await response.json();
      const items = document.getElementById("itemsPedidos");
      let html = `
<h3 style="margin-top:0; color:#2f3a57"><i class="fa fa-cutlery"></i> Detalhes do Pedido</h3>
<table style="width:100%; border-collapse:collapse; margin-bottom:16px;">
   <thead>
      <tr>
         <th style="border:1px solid #ccc; padding:8px;">Produto</th>
         <th style="border:1px solid #ccc; padding:8px;">Quantidade</th>
         <th style="border:1px solid #ccc; padding:8px;">Valor Unitário</th>
         <th style="border:1px solid #ccc; padding:8px;">Subtotal</th>
         <th style="border:1px solid #ccc; padding:8px;">Remover</th>
      </tr>
   </thead>
   <tbody>
`;
      let valorTotal = 0;
      let metodo = '';
      let statusPagamento = '';
      dados.dados2.forEach(item => {
         html += `
<tr>
   <td style="border:1px solid #ccc; padding:8px;">${item.nome}</td>
   <td style="border:1px solid #ccc; padding:8px;">${item.quantidade}</td>
   <td style="border:1px solid #ccc; padding:8px;">R$ ${Number(item.valor_unitario).toFixed(2)}</td>
   <td style="border:1px solid #ccc; padding:8px;">R$ ${(Number(item.quantidade) * Number(item.valor_unitario)).toFixed(2)}</td>
   <td style="border:1px solid #ccc; padding:8px;">
      <button class="w3-button action-btn btn-delete" data-id="${item.item_id}" id="botaoExcluir" onclick="SoftDeleteItens(${item.item_id})">EXCLUIR</button>
   </td>
</tr>
`;
         if (item.tipo_pedido === 3) {
            html += `
<h4 style="margin-bottom:8px; color:#2f3a57"><i class="fa fa-map-marker"></i> Endereço de Entrega</h4>
<ul style="list-style:none; padding:0; margin:0 0 8px 0;">
   <li><strong>Rua:</strong> ${item.rua}, Nº ${item.numero}</li>
   <li><strong>Bairro:</strong> ${item.bairro}</li>
   <li><strong>Cidade:</strong> ${item.cidade} - ${item.estado}</li>
   <li><strong>CEP:</strong> ${item.cep}</li>
</ul>
`;
         }
         valorTotal += Number(item.quantidade) * Number(item.valor_unitario);
         metodo = item.descricao_metodo;
         statusPagamento = item.descricao;
      });
      html += `
   </tbody>
</table>
<h4 style="margin-bottom:8px; color:#2f3a57"><i class="fa fa-credit-card"></i> Pagamento</h4>
<ul style="list-style:none; padding:0; margin:0 0 8px 0;">
   <li><strong>Valor Total:</strong> R$ ${valorTotal.toFixed(2)}</li>
   <li><strong>Método de Pagamento:</strong> ${metodo}</li>
   <li><strong>Status do Pagamento:</strong> ${statusPagamento}</li>
</ul>
`;
      items.innerHTML = html;
      const modal = document.getElementById('id01');
      modal.style.display = "block";
      window.onclick = function(event) {
         if (event.target === modal) modal.style.display = "none";
      };
   });
});

/**
 * Modal Editar Pagamento e Endereço
 */
document.querySelectorAll('.btn-edit-pagamento-endereco').forEach(btn => {
   btn.addEventListener('click', async () => {
      const pedidoId = btn.getAttribute('data-id');
      let response = await fetch(`/backend/pedidos/busca/${pedidoId}`, { method: "GET" });
      const dados = await response.json();
      const items = document.getElementById("editarPagamentoeEndereco");
      let html = `
<h3 style="margin-top:0; color:#2f3a57"><i class="fa fa-edit"></i> Editar Pagamento e Endereço</h3>
<form id="formEditarPagamentoEndereco">
   <input type="hidden" name="pedido_id" value="${pedidoId}">
   <div style="margin-bottom:16px;">
      <label for="metodo_pagamento"><strong>Método de Pagamento:</strong></label>
      <select name="metodo_pagamento" id="metodo_pagamento" required>
         <option value="">Selecione o método de pagamento</option>
         <option value="1" ${dados.dados2[0].metodo_pagamento_id == 1 ? 'selected' : ''}>Cartão de Crédito</option>
         <option value="2" ${dados.dados2[0].metodo_pagamento_id == 2 ? 'selected' : ''}>Boleto Bancário</option>
         <option value="3" ${dados.dados2[0].metodo_pagamento_id == 3 ? 'selected' : ''}>Pix</option>
         <option value="4" ${dados.dados2[0].metodo_pagamento_id == 4 ? 'selected' : ''}>Dinheiro</option>
      </select>
   </div>
</form>
`;
      items.innerHTML = html;
      const modal = document.getElementById('id03');
      modal.style.display = "block";
      window.onclick = function(event) {
         if (event.target === modal) modal.style.display = "none";
      };
   });
});

// ==========================
// Fechar Modais
// ==========================
document.querySelectorAll('.modal .close').forEach(btn => {
   btn.onclick = function() {
      btn.closest('.modal').style.display = "none";
   };
});

// ==========================
// Funções de Pedido
// ==========================

/**
 * Soft Delete Pedido
 */
function SoftDelete(idPedido) {
   const data = JSON.stringify({ idPedido });
   const xhr = new XMLHttpRequest();
   xhr.withCredentials = true;
   xhr.open('POST', '/backend/pedidos/deletar');
   xhr.setRequestHeader('Content-Type', 'application/json');
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
         xhr.send(data);
         Swal.fire({
            title: "Deletado!",
            text: "Seu pedido está sendo deletado.",
            icon: "success"
         });
      }
   });
}

/**
 * Soft Delete Item do Pedido
 */
function SoftDeleteItens(itemId) {
   const data = JSON.stringify({ itemId });
   const xhr = new XMLHttpRequest();
   xhr.withCredentials = true;
   xhr.open('POST', '/backend/pedidos/deletarItem');
   xhr.setRequestHeader('Content-Type', 'application/json');
   Swal.fire({
      title: "Você tem certeza?",
      text: "Você ira Remover o Item todo!, Caso queira apenas alterar a quantidade, utilize o campo editar!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Sim, Deletar Item!"
   }).then((result) => {
      if (result.isConfirmed) {
         xhr.send(data);
         Swal.fire({
            title: "Deletado!",
            text: "Seu item está sendo deletado.",
            icon: "success"
         });
      }
   });
}

/**
 * Atualiza quantidade dos itens do pedido
 */
function qtditemFormulario(qtd) {
   let arrayItems = [];
   for (let index = 1; index <= qtd; index++) {
      let qtdItem = document.getElementById(`itemQTD${index}`).value;
      let IDitem = document.getElementById(`itemID${index}`).value;
      arrayItems.push({ id: IDitem, quantidade: qtdItem });
   }
   const data = JSON.stringify({ itens: arrayItems });
   const xhr = new XMLHttpRequest();
   xhr.withCredentials = true;
   xhr.open('POST', `/backend/pedidos/atualizarItensPedidoQTD`);
   xhr.setRequestHeader('Content-Type', 'application/json');
   Swal.fire({
      title: "Você tem certeza?",
      text: "Você não poderá reverter isso!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Sim, Atualizar Itens!"
   }).then((result) => {
      if (result.isConfirmed) {
         xhr.send(data);
         Swal.fire({
            title: "Atualizado!",
            text: "Os itens do pedido estão sendo atualizados.",
            icon: "success"
         });
      }
   });
}

/**
 * Adiciona produto ao pedido
 */
function adicionarProduto(pedidoId) {
   const selectProduto = document.getElementById(`novo-Produto${pedidoId}`);
   if (selectProduto.value === "0") {
      Swal.fire({
         icon: "error",
         title: "Erro",
         text: "Por favor, selecione um produto válido.",
      });
      return;
   }
   const valor = selectProduto.value;
   const quantidade = document.getElementById("nova-Quantidade").value;
   const [produto, preco] = valor.split("@");
   const data = JSON.stringify({
      produtoId: produto,
      idPedido: pedidoId,
      quantidade,
      preco,
   });
   const xhr = new XMLHttpRequest();
   xhr.withCredentials = true;
   xhr.open('POST', '/backend/pedidos/adicionarItensPedido');
   xhr.setRequestHeader('Content-Type', 'application/json');
   Swal.fire({
      title: "Você tem certeza?",
      text: "Você não poderá reverter isso!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Sim, Atualizar Produto!"
   }).then((result) => {
      if (result.isConfirmed) {
         xhr.send(data);
         Swal.fire({
            title: "Atualizado!",
            text: "Seu produto está sendo adicionado.",
            icon: "success"
         });
      }
   });
}

/**
 * Altera status do pedido
 */
async function alterarStatus(status, idPedido,idStatus) {
   if (status == 0) {
      Swal.fire({
         icon: "error",
         title: "Erro",
         text: "Por favor, selecione um status válido.",
      });
       let conteudo = await buscarPedidos(idPedido);
         renderizarConteudo(conteudo, idPedido);
      return;
   }
   const data = JSON.stringify({ status, idPedido });
   const xhr = new XMLHttpRequest();
   xhr.withCredentials = true;
   xhr.open('POST', '/backend/pedidos/atualizarProcesso');
   xhr.setRequestHeader('Content-Type', 'application/json');
   Swal.fire({
      title: "Você tem certeza?",
      text: "Você não poderá reverter isso!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Sim, Atualizar Pedido!"
   }).then((result) => {
      if (result.isConfirmed) {
         xhr.send(data);
         Swal.fire({
            position: "top-end",
            icon: "success",
            title: "Seu pedido foi atualizado.",
            showConfirmButton: false,
            timer: 1000
         });
      }
   });
}

// ==========================
// Tabs - Navegação
// ==========================
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
// Abre a aba padrão ao carregar
document.getElementById("defaultOpen").click();



// Funções Apenas para quando a pagina carregar

window.onload = function() {
   setInterval(mostrarNotificacoes, 5000); // Verifica notificações a cada 50 segundos
};

async function mostrarNotificacoes() {
      let qtdAtual = await contarNotificacoes(); // Verifica novos pedidos
      if (qtdAtual > qtdAnterior) {
         let novosPedidos = qtdAtual - qtdAnterior;
         Swal.fire({
                     position: "top-end",
                     icon: "info",
                     title: "Você tem " + novosPedidos + " novo(s) pedido(s)!",
                     showConfirmButton: false,
                     timer: 3000
                  });
         console.log("Chegou novo pedido");
         qtdAnterior = qtdAtual;
      }
      qtdAnterior = qtdAtual;
   }
</script>
