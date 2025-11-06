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
      background: #E3F2FD;
      color: #1565C0
   }

   .btn-delete {
      background: #FFEBEE;
      color: #C62828
   }

   .btn-edit:hover {
      background: #BBDEFB
   }   .btn-delete:hover {
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
</style>



<!-- Header -->
<header class="w3-container" style="padding:22px 0 12px 0;">
   <h5 style="margin:0; display:flex; align-items:center; gap:10px; color:#2f3a57">
      <i class="fa fa-cutlery" aria-hidden="true"></i>
      Painel de Pedidos
   </h5>
   <div style="color:#6b7a99; font-size:13px; margin-top:6px">Visão geral e gerenciamento dos pedidos do sistema</div>
</header>



<!-- Lista -->
<div style="display:flex; align-items:center; justify-content:space-between; margin:8px 0 10px 0;">
   <div style="font-weight:700; color:#2f3a57; display:flex; align-items:center; gap:8px">
      <i class="fa fa-list-alt" aria-hidden="true"></i>
      Listagem de Pedidos
   </div>
</div>






<!-- Pedidos Saiu Para Entrega -->


<div id="Saiu_Para_Entrega" class="tabcontent">
   <h3>Pedidos Em entrega</h3>
   <summary style="font-weight:700; font-size:16px; cursor:pointer; display:flex; align-items:center; gap:8px;">
      <i class="fa fa-plus-square" aria-hidden="true"></i> Pedidos Saiu Para Entrega
   </summary>
   <div style="margin-top:16px;">
      <?php if (isset($pedidos3) && count($pedidos3) > 0): ?>
         <div class="w3-responsive card-table">
            <table class="w3-table w3-striped w3-white">
               <thead class="table-head">
                  <tr>
                     <th class="td-tight"><i class="fa fa-hashtag" title="ID" aria-hidden="true"></i> ID</th>
                     <th><i class="fa fa-user" title="Cliente" aria-hidden="true"></i> Cliente</th>
                     <th class="td-tight"><i class="fa fa-info-circle" title="Status" aria-hidden="true"></i> Status</th>
                     <th class="td-tight"><i class="fa fa-calendar" title="Data" aria-hidden="true"></i> Data</th>
                     <th class="td-tight"><i class="fa fa-list" title="Tipo Pedido" aria-hidden="true"></i> Tipo Pedido</th>
                     <th class="td-tight"><i class="fa fa-cutlery" title="Itens" aria-hidden="true"></i> Itens</th>
                     <th class="td-tight"><i class="fa fa-cutlery" title="Itens" aria-hidden="true"></i>Editar</th>
                     <th class="td-tight"><i class="fa fa-trash" title="Excluir" aria-hidden="true"></i> Excluir</th>
                     <th class="td-tight"><i class="fa fa-refresh" title="Reativar" aria-hidden="true"></i> Atualizar Pedido!</th>
                  </tr>
               </thead>
               <tbody>
                  <?php foreach ($pedidos3 as $pedido): ?>
                     <?php

                     $id = htmlspecialchars($pedido['pedido_id']);
                     $nome = htmlspecialchars($pedido['nome']);
                     $statusMeta = htmlspecialchars($pedido['descricao']);
                     $data = htmlspecialchars($pedido['criado_em']);
                     $tipoPedido = htmlspecialchars($pedido['descricao_tipo']);
                     ?>
                     <tr class="table-row">
                        <td class="td-tight"><?php echo $id; ?></td>
                        <td>
                           <i class="fa fa-user" style="color:#34495e;" aria-hidden="true"></i>
                           <span><?php echo $nome; ?></span>
                        </td>
                        <td class="td-tight">
                           <span class="badge">
                              <i class="fa " aria-hidden="true"></i>
                              <?php echo htmlspecialchars($statusMeta); ?>
                           </span>
                        </td>
                        <td class="td-tight">
                           <i class="fa fa-calendar" aria-hidden="true"></i>
                           <?php echo $data; ?>
                        </td>
                        <td class="td-tight">
                           <i class="fa fa-list" aria-hidden="true"></i>
                           <?php echo $tipoPedido; ?>
                        </td>
                        <td class="td-tight">
                           <button class="w3-button action-btn btn-view" data-id="<?php echo $id; ?>" title="Ver itens do pedido">
                              <i class="fa fa-eye"></i> Ver
                           </button>
                        </td>
                        <td class="td-tight">
                           <button type="button" class="w3-button w3-blue btn-edit" data-id="<?php echo $id; ?>" style="border-radius:8px; font-weight:600; margin-top:8px;" id="btn<?php echo htmlspecialchars($id); ?>">
                              <i class="fa fa-edit"></i> Editar
                           </button>
                        </td>
                        <td class="td-tight">
                           <button class="w3-button action-btn btn-delete" data-id="<?php echo $id; ?>" id="botaoExcluir" onclick="SoftDelete(<?php echo htmlspecialchars($id); ?>)">EXCLUIR</button>
                        </td>
                        <td class="td-tight"><select name="" id="pedido-Status" class="select_status" onchange="alterarStatus(this.value, <?php echo $pedido['pedido_id']; ?>)">
                              <option value="0">ESCOLHA AQUI</option>
                              <?php foreach ($statusPedido as $status) { ?>

                                 <option value="<?php echo $status['id']; ?>"><?php echo $status['descricao']; ?></option>

                              <?php } ?>
                           </select>
                        </td>
                     </tr>
                  <?php endforeach; ?>
               </tbody>
            </table>
         </div>

         <!-- Modal para detalhes dos itens do pedido -->

         <!-- Paginação -->

         <div class="paginacao-controls" style="display:flex; justify-content:flex-end; align-items:center; margin-top:16px;">
            <a class="w3-button w3-blue" href="/backend/pedidos/tipopedidos/entrega/1" style="border-radius:8px; font-weight:600;">
               <i class="fa fa-eye"></i> Veja mais
            </a>
         </div>
      <?php else: ?>
         <div class="w3-panel w3-pale-blue w3-leftbar w3-border-blue" style="border-radius:8px;">
            <p style="margin:8px 0;"><i class="fa fa-info-circle"></i> Nenhum pedido em Entrega.</p>
         </div>
      <?php endif; ?>
   </div>
</div>




<div id="id01" class="modal">
   <div class="modal-content">
      <button class="close" title="Fechar Modal">&times;</button>
      <div id="itemsPedidos"></div>
      <button class="w3-button w3-green btn-edit-pagamento-endereco" style="border-radius:8px; font-weight:600;">
         <i class="fa fa-times"></i> Editar
      </button>
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
   // Função para abrir a aba de Ver items do pedido
   document.querySelectorAll('.btn-view[data-id]').forEach(btn => {
      btn.addEventListener('click', async (e) => {
         const pedidoId = btn.getAttribute('data-id');
         let response = await fetch(`/backend/pedidos/busca/${pedidoId}`, {
            method: "GET"
         });
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
            let valor_item = Number(item.quantidade) * Number(item.valor_unitario);
            valorTotal += valor_item;
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

         // Agora atualiza o modal só uma vez
         items.innerHTML = html;
         const modal = document.getElementById('id01');
         modal.style.display = "block";
         window.onclick = function(event) {
            const modal = document.getElementById('id01');
            if (event.target === modal) {
               modal.style.display = "none";
            }
         };
      });
   });


      // Função para abrir a aba de editar items de pagamentos e Endereço
   document.querySelectorAll('.btn-edit-pagamento-endereco').forEach(btn => {
      btn.addEventListener('click', async (e) => {
         const pedidoId = document
         console.log("Pedido ID para editar pagamento e endereço:", pedidoId); 
         let response = await fetch(`/backend/pedidos/busca/${pedidoId}`, {
            method: "GET"
         });
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

         // Agora atualiza o modal só uma vez
         items.innerHTML = html;
         const modal = document.getElementById('id03');
         modal.style.display = "block";
         window.onclick = function(event) {
            const modal = document.getElementById('id03');
            if (event.target === modal) {
               modal.style.display = "none";
            }
         };
      });
   });


   // Fechar modal
   document.querySelectorAll('.modal .close').forEach(btn => {
      btn.onclick = function() {
         btn.closest('.modal').style.display = "none";
      };
   });



   // Função para abrir a aba de Editar items do pedido
   btn = document.querySelectorAll('.btn-edit[data-id]').forEach(btn => {
      btn.addEventListener('click', async (e) => {
         let qtd = 0;
         const id = btn.getAttribute('data-id');
         let response = await fetch(`/backend/pedidos/busca/${id}`, {
            method: "GET"
         });
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
          <!-- Adicionar produto -->
          <tr>
            <td colspan="3" style="padding:8px; text-align:right;">
            <select name="" id="novo-Produto${id}" class="select_status">
               <option value="0"  id="opcaoEscolha">ESCOLHA AQUI</option>
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
            const modal = document.getElementById('id02');
            if (event.target === modal) {
               modal.style.display = "none";
            }
         };
      })
   });

   // Função para deletar pedido
   function SoftDelete(idPedido) {
      const data = JSON.stringify({
         idPedido: idPedido
      });

      const xhr = new XMLHttpRequest();
      xhr.withCredentials = true;

      xhr.addEventListener('readystatechange', function() {

         if (this.readyState === this.DONE) {
            location.reload()
         }
      });

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
            if (this.readyState === this.DONE) {
               xhr.send(data);
               Swal.fire({
                  title: "Deletado!",
                  text: "Seu pedido está sendo deletado.",
                  icon: "success"
               });
               location.reload();
            }
         }
      });

   }
   // Função para deletar itens do pedido
   function SoftDeleteItens(itemId) {

      const data = JSON.stringify({
         itemId: itemId
      });

      const xhr = new XMLHttpRequest();
      xhr.withCredentials = true;

      xhr.addEventListener('readystatechange', function() {

         if (this.readyState === this.DONE) {}
      });

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
            if (this.readyState === this.DONE) {
               location.reload()
               xhr.send(data);
               Swal.fire({
                  title: "Deletado!",
                  text: "Seu item está sendo deletado.",
                  icon: "success"
               });
            }
         }
      });

   }

   //Função para atualizar quantidade dos itens do pedido
   function qtditemFormulario(qtd) {




      let arrayItems = [];
      for (let index = 1; index <= qtd; index++) {
         console.log(index);
         let qtdItem = document.getElementById(`itemQTD${index}`).value;
         let IDitem = document.getElementById(`itemID${index}`).value;
         arrayItems.push({
            id: IDitem,
            quantidade: qtdItem
         });
      }
       const data = JSON.stringify({
            itens: arrayItems
         });

         const xhr = new XMLHttpRequest();
         xhr.withCredentials = true;

         xhr.addEventListener('readystatechange', function() {

            if (this.readyState === this.DONE) {
               location.reload();
            }
         });
         console.log(data);
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
               if (this.readyState === this.DONE) {
                  xhr.send(data);
                  Swal.fire({
                     title: "Atualizado!",
                     text: "Os itens do pedido estão sendo atualizados.",
                     icon: "success"
                  });
                  location.reload();
               }
            }
         });

   }
   //Função para adicionar produto ao pedido
   function adicionarProduto(pedidoId) {
      if (document.getElementById(`novo-Produto${pedidoId}`).value === "0") {
         Swal.fire({
            icon: "error",
            title: "Erro",
            text: "Por favor, selecione um produto válido.",
         });
      }
   }

   //Função para adicionar produto ao pedido
   function adicionarProduto(pedidoId) {
      if (document.getElementById(`novo-Produto${pedidoId}`).value === "0") {
         Swal.fire({
            icon: "error",
            title: "Erro",
            text: "Por favor, selecione um produto válido.",
         });
      } else {
         const valor = document.getElementById(`novo-Produto${pedidoId}`).value;
         const inputQuantidade = document.getElementById("nova-Quantidade");
         const quantidade = inputQuantidade.value;
         const Array = valor.split("@")
         const preco = Array[1]
         const produto = Array[0]
         const data = JSON.stringify({
            produtoId: produto,
            idPedido: pedidoId,
            quantidade: quantidade,
            preco: preco,
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
               if (this.readyState === this.DONE) {
                  xhr.send(data);
                  Swal.fire({
                     title: "Atualizado!",
                     text: "Seu produto está sendo adicionado.",
                     icon: "success"
                  });
                  location.reload();
               }
            }
         });
      }
   }

   //Função para alterar status do pedido
   function alterarStatus(status, idPedido) {
      if (status == 0) {
         Swal.fire({
            icon: "error",
            title: "Erro",
            text: "Por favor, selecione um status válido.",
         });

      } else {
         const data = JSON.stringify({
            status: status,
            idPedido: idPedido
         });
         console.log(data);

         const xhr = new XMLHttpRequest();
         xhr.withCredentials = true;

         xhr.addEventListener('readystatechange', function() {

         });

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
               if (this.readyState === this.DONE) {
                  xhr.send(data);
                  Swal.fire({
                     title: "Atualizado!",
                     text: "Seu pedido está sendo atualizado.",
                     icon: "success"
                  });
                  location.reload();
               }
            }
         });
      }


   }

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

   // Get the element with id="defaultOpen" and click on it
   document.getElementById("defaultOpen").click();
</script>