<style>
   /* Cartões de métricas */
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
</style>

<?php
// Métricas seguras
$total_usuarios = isset($total_usuarios) ? (int)$total_usuarios : 0;
$total_ativos   = isset($total_ativos)   ? (int)$total_ativos   : 0;
$total_inativos = isset($total_inativos) ? (int)$total_inativos : 0;
$taxa_ativacao  = $total_usuarios > 0 ? round(($total_ativos / $total_usuarios) * 100) : 0;

// Para pedidos
$total         = isset($total) ? (int)$total : 0;
$total_entregues = isset($total_inativos) ? (int)$total_inativos : 0;
$total_pendentes = isset($total_ativos) ? (int)$total_ativos : 0;
$taxa_pedidos   = $total > 0 ? round(($total_pendentes / $total) * 100) : 0;

// Status do pedido
?>

<!-- Header -->
<header class="w3-container" style="padding:22px 0 12px 0;">
   <h5 style="margin:0; display:flex; align-items:center; gap:10px; color:#2f3a57">
      <i class="fa fa-cutlery" aria-hidden="true"></i>
      Painel de Pedidos
   </h5>
   <div style="color:#6b7a99; font-size:13px; margin-top:6px">Visão geral e gerenciamento dos pedidos do sistema</div>
</header>

<!-- Cards de métricas -->
<!-- <div class="w3-row-padding w3-margin-bottom">
   <div class="w3-quarter">
      <div class="w3-container w3-padding-16 stat-card bg-blue" title="Total de pedidos realizados">
         <div class="w3-left"><i class="fa fa-shopping-cart w3-xxxlarge" style="color:#fff;"></i></div>
         <div class="w3-right">
            <h3 style="color:#fff;"><?php echo number_format($total, 0, ',', '.'); ?></h3>
         </div>
         <div class="w3-clear"></div>
         <h4 class="stat-subtitle" style="color:#E3F2FD">Total de Pedidos</h4>
      </div>
   </div>
   <div class="w3-quarter">
      <div class="w3-container w3-padding-16 stat-card bg-green" title="Pedidos entregues">
         <div class="w3-left"><i class="fa fa-check-circle w3-xxxlarge" style="color:#fff;"></i></div>
         <div class="w3-right">
            <h3 style="color:#fff;"><?php echo number_format($total_entregues, 0, ',', '.'); ?></h3>
         </div>
         <div class="w3-clear"></div>
         <h4 class="stat-subtitle" style="color:#E8F5E9">Entregues</h4>
      </div>
   </div>
   <div class="w3-quarter">
      <div class="w3-container w3-padding-16 stat-card bg-orange" title="Pedidos pendentes">
         <div class="w3-left"><i class="fa fa-clock-o w3-xxxlarge" style="color:#fff;"></i></div>
         <div class="w3-right">
            <h3 style="color:#fff;"><?php echo number_format($total_pendentes, 0, ',', '.'); ?></h3>
         </div>
         <div class="w3-clear"></div>
         <h4 class="stat-subtitle" style="color:#FFF3E0">Pendentes</h4>
      </div>
   </div>
   <div class="w3-quarter">
      <div class="w3-container w3-padding-16 stat-card bg-indigo" title="Percentual de pedidos pendentes">
         <div class="w3-left"><i class="fa fa-percent w3-xxxlarge" style="color:#fff;"></i></div>
         <div class="w3-right">
            <h3 style="color:#fff;"><?php echo $taxa_pedidos; ?>%</h3>
         </div>
         <div class="w3-clear"></div>
         <h4 class="stat-subtitle" style="color:#E8EAF6">Taxa de Pendentes</h4>
      </div>
   </div>
</div> -->

<!-- Lista -->
<div style="display:flex; align-items:center; justify-content:space-between; margin:8px 0 10px 0;">
   <div style="font-weight:700; color:#2f3a57; display:flex; align-items:center; gap:8px">
      <i class="fa fa-list-alt" aria-hidden="true"></i>
      Listagem de Pedidos
   </div>
</div>


<!-- Pedidos Comcluidos -->


   <summary style="font-weight:700; font-size:16px; cursor:pointer; display:flex; align-items:center; gap:8px;">
      <i class="fa fa-plus-square" aria-hidden="true"></i> Pedidos Concluídos
   </summary>
   <div style="margin-top:16px;">
      <?php if (isset($pedidos4) && count($pedidos4) > 0): ?>
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
                     <th class="td-tight"><i class="fa fa-pencil" title="Editar" aria-hidden="true"></i> Editar</th>
                     <th class="td-tight"><i class="fa fa-trash" title="Excluir" aria-hidden="true"></i> Excluir</th>
                     <th class="td-tight"><i class="fa fa-refresh" title="Reativar" aria-hidden="true"></i> Atualizar Pedido!</th>
                  </tr>
               </thead>
               <tbody>
                  <?php foreach ($pedidos4 as $pedido): ?>
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
                           <a class="w3-button action-btn btn-edit" href="/backend/pedido/editar/<?php echo $id; ?>" title="Editar pedido #<?php echo $id; ?>">
                              <i class="fa fa-pencil" aria-hidden="true"></i> Editar
                           </a>
                        </td>
                        <td class="td-tight">
                           <a class="w3-button action-btn btn-delete"
                              href="/backend/pedido/excluir/<?php echo $id; ?>"
                              onclick="return confirm('Confirma a exclusão deste pedido?');"
                              title="Excluir pedido #<?php echo $id; ?>">
                              <i class="fa fa-trash" aria-hidden="true"></i> Excluir
                           </a>
                        </td>
                     <td class="td-tight"><select name="" id="pedido-Status" onchange="alterarStatus(this.value, <?php echo $pedido['pedido_id']; ?>)">
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
         <div id="id01" class="modal">
            <div class="modal-content">
               <button class="close" title="Fechar Modal">&times;</button>
               <div id="itemsPedidos"></div>
            </div>
         </div>

         <!-- Paginação -->

         
        <div class="paginacao-controls" style="display:flex; justify-content:space-between; align-items:center; margin-top:20px;">
    <div class="page-selector" style="display:flex; align-items:center;">
        <div class="page-nav">
            <?php if ($paginacao['pagina_atual'] > 1): ?>
                <a href="/backend/pedidos/tipopedidos/concluidos/<?= $paginacao['pagina_atual'] - 1 ?>">Anterior</a>
            <?php endif; ?>
            <span style="margin:0 10px;">Página <?= $paginacao['pagina_atual'] ?> de <?= $paginacao['ultima_pagina'] ?></span>
            <?php if ($paginacao['pagina_atual'] < $paginacao['ultima_pagina']): ?>
                <a href="/backend/pedidos/tipopedidos/concluidos/<?= $paginacao['pagina_atual'] + 1 ?>">Próximo</a>
            <?php endif; ?>
        </div>
    </div>
</div>
      <?php else: ?>
         <div class="w3-panel w3-pale-blue w3-leftbar w3-border-blue" style="border-radius:8px;">
            <p style="margin:8px 0;"><i class="fa fa-info-circle"></i> Nenhum pedido Concluido.</p>
         </div>
      <?php endif; ?>
   </div>










<script>
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
        `;}




            valorTotal = Number(item.valor_total);
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
      });
   });

   // Fechar modal
   document.querySelectorAll('.modal .close').forEach(btn => {
      btn.onclick = function() {
         btn.closest('.modal').style.display = "none";
      };
   });

   window.onclick = function(event) {
      const modal = document.getElementById('id01');
      if (event.target === modal) {
         modal.style.display = "none";
      }
   };






   function alterarStatus(status, idPedido) {


      const data = JSON.stringify({
         status: status,
         idPedido: idPedido
      });

      const xhr = new XMLHttpRequest();
      xhr.withCredentials = true;

      xhr.addEventListener('readystatechange', function() {

         if (this.readyState === this.DONE) {
            location.reload()
         }
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
            alert()
            xhr.send(data);
            Swal.fire({
               title: "Atualizado!",
               text: "Seu pedido foi atualizado.",
               icon: "success"
            });
         }
      });

   }

   function alert() {
      let timerInterval;
      Swal.fire({
         title: "Pedido Sendo Processado!",
         html: "Vai ser processado em <b></b> milisecundos!",
         timer: 4000,
         timerProgressBar: true,
         didOpen: () => {
            Swal.showLoading();
            const timer = Swal.getPopup().querySelector("b");
            timerInterval = setInterval(() => {
               timer.textContent = `${Swal.getTimerLeft()}`;
            }, 100);
         },
         willClose: () => {
            clearInterval(timerInterval);
         }
      }).then((result) => {
         /* Read more about handling dismissals below */
         if (result.dismiss === Swal.DismissReason.timer) {
            console.log("I was closed by the timer");
         }
      });
   }
   //  const statusPedido = document.getElementById('pedido-Status').addEventListener("change",(e)=> {
   //    const idPedido = document.getElementById("pedido-id-")
   //    const status = e.target.value
   //    console.log(status)

   //  } )
</script>