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
      float: left;
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


<nav class="nav_botoes">
   <ul>
      <li>
         <button class="tablink" onclick="openPage('Novos', this, 'red')">
            <i class="fa fa-plus-square" aria-hidden="true"></i> Novos
         </button>
      </li>
      <li>
         <button class="tablink" onclick="openPage('Em_Preparo', this, 'green')" id="defaultOpen">
            <i class="fa fa-fire" aria-hidden="true"></i> Em Preparo
         </button>
      </li>
      <li>
         <button class="tablink" onclick="openPage('Saiu_Para_Entrega', this, 'blue')">
            <i class="fa fa-truck" aria-hidden="true"></i> Saiu Para Entrega
         </button>
      </li>
      <li>
         <button class="tablink" onclick="openPage('Concluidos', this, 'orange')">
            <i class="fa fa-check-circle" aria-hidden="true"></i> Concluídos
         </button>
      </li>
      <li>
         <button class="tablink" onclick="openPage('Cancelados', this, 'orange')">
            <i class="fa fa-ban" aria-hidden="true"></i> Cancelados
         </button>
      </li>
      </li></button></li>
   </ul>
</nav>







<div id="Novos" class="tabcontent">
   <h3>Pedidos Novos</h3>
   <summary style="font-weight:700; font-size:16px; cursor:pointer; display:flex; align-items:center; gap:8px;">
      <i class="fa fa-plus-square" aria-hidden="true"></i> Pedidos Novos
   </summary>
   <div style="margin-top:16px;">
      <?php if (isset($pedidos) && count($pedidos) > 0): ?>
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
                  <?php foreach ($pedidos as $pedido): ?>
                     <?php
                     $id = htmlspecialchars($pedido['pedido_id']);
                     $nome = htmlspecialchars($pedido['nome']);
                     $statusMeta = htmlspecialchars($pedido['descricao']);
                     $data = htmlspecialchars($pedido['criado_em']);
                     $tipoPedido = htmlspecialchars($pedido['descricao_tipo']);
                     $status = htmlspecialchars($pedido['status_pedido_id']);
                     ?>
                     <tr class="table-row">
                        <td class="td-tight" data-id="<?php echo $id; ?>" id="pedido-id-<?php echo $id; ?>"><?php echo $id; ?></td>
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
                           <a class="w3-button action-btn btn-edit" href="/backend/pedidos/editar/<?php echo $id; ?>" title="Editar pedido #<?php echo $id; ?>">
                              <i class="fa fa-pencil" aria-hidden="true"></i> Editar
                           </a>
                        </td>
                        <td class="td-tight">
                           <button class="w3-button action-btn btn-delete" data-id="<?php echo $id; ?>" id="botaoExcluir" onclick="SoftDelete(<?php echo htmlspecialchars($id); ?>)">EXCLUIR</button>
                        </td>
                        <td class="td-tight">
                           <select name="" id="pedido-Status" class="select_status" onchange="alterarStatus(<?php echo $pedido['pedido_id']; ?>)">
                              <option value="NULL">ESCOLHA AQUI</option>
                              
                              
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
         <!-- Paginação substituída por âncora "Veja mais" -->
         <div class="paginacao-controls" style="display:flex; justify-content:flex-end; align-items:center; margin-top:16px;">
            <a class="w3-button w3-blue" href="/backend/pedidos/tipopedidos/novo/1" style="border-radius:8px; font-weight:600;">
               <i class="fa fa-eye"></i> Veja mais
            </a>
         </div>
      <?php else: ?>
         <div class="w3-panel w3-pale-blue w3-leftbar w3-border-blue" style="border-radius:8px;">
            <p style="margin:8px 0;"><i class="fa fa-info-circle"></i> Nenhum pedido encontrado.</p>
         </div>
      <?php endif; ?>
   </div>
</div>

<div id="Em_Preparo" class="tabcontent">

   <h3>Pedidos Em preparo</h3>

   <summary style="font-weight:700; font-size:16px; cursor:pointer; display:flex; align-items:center; gap:8px;">
      <i class="fa fa-plus-square" aria-hidden="true"></i> Pedidos Em Preparo
   </summary>
   <div style="margin-top:16px;">
      <?php if (isset($pedidos2) && count($pedidos2) > 0): ?>
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
                  <?php foreach ($pedidos2 as $pedido): ?>
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
                           <button class="w3-button action-btn btn-delete" data-id="<?php echo $id; ?>" id="botaoExcluir" onclick="SoftDelete(<?php echo htmlspecialchars($id); ?>)">EXCLUIR</button>
                        </td>
                        <td class="td-tight"><select name="" id="pedido-Status" class="select_status" onchange="alterarStatus(this.value, <?php echo $pedido['pedido_id']; ?>)">
                           <option value="NULL">ESCOLHA AQUI</option>
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

         <div class="paginacao-controls" style="display:flex; justify-content:flex-end; align-items:center; margin-top:16px;">
            <a class="w3-button w3-blue" href="/backend/pedidos/tipopedidos/preparo/1" style="border-radius:8px; font-weight:600;">
               <i class="fa fa-eye"></i> Veja mais
            </a>
         </div>
      <?php else: ?>
         <div class="w3-panel w3-pale-blue w3-leftbar w3-border-blue" style="border-radius:8px;">
            <p style="margin:8px 0;"><i class="fa fa-info-circle"></i> Nenhum pedido em Preparo.</p>
         </div>
      <?php endif; ?>
   </div>
</div>

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
                     <th class="td-tight"><i class="fa fa-pencil" title="Editar" aria-hidden="true"></i> Editar</th>
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
                           <a class="w3-button action-btn btn-edit" href="/backend/pedido/editar/<?php echo $id; ?>" title="Editar pedido #<?php echo $id; ?>">
                              <i class="fa fa-pencil" aria-hidden="true"></i> Editar
                           </a>
                        </td>
                        <td class="td-tight">
                           <button class="w3-button action-btn btn-delete" data-id="<?php echo $id; ?>" id="botaoExcluir" onclick="SoftDelete(<?php echo htmlspecialchars($id); ?>)">EXCLUIR</button>
                        </td>
                        <td class="td-tight"><select name="" id="pedido-Status" class="select_status" onchange="alterarStatus(this.value, <?php echo $pedido['pedido_id']; ?>)">
                           <option value="NULL">ESCOLHA AQUI</option>
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

<div id="Concluidos" class="tabcontent">
   <h3>Pedidos Concluídos</h3>
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
                           <button class="w3-button action-btn btn-delete" data-id="<?php echo $id; ?>" id="botaoExcluir" onclick="SoftDelete(<?php echo htmlspecialchars($id); ?>)">EXCLUIR</button>
                        </td>
                        <td class="td-tight"><select name="" id="pedido-Status" class="select_status" onchange="alterarStatus(this.value, <?php echo $pedido['pedido_id']; ?>)">
                           <option value="NULL">ESCOLHA AQUI</option>
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

         <div class="paginacao-controls" style="display:flex; justify-content:flex-end; align-items:center; margin-top:16px;">
            <a class="w3-button w3-blue" href="/backend/pedidos/tipopedidos/concluidos/1" style="border-radius:8px; font-weight:600;">
               <i class="fa fa-eye"></i> Veja mais
            </a>
         </div>
      <?php else: ?>
         <div class="w3-panel w3-pale-blue w3-leftbar w3-border-blue" style="border-radius:8px;">
            <p style="margin:8px 0;"><i class="fa fa-info-circle"></i> Nenhum pedido Concluido.</p>
         </div>
      <?php endif; ?>
   </div>
</div>


<div id="Cancelados" class="tabcontent">
   <h3>Pedidos Cancelados</h3>
   <summary style="font-weight:700; font-size:16px; cursor:pointer; display:flex; align-items:center; gap:8px;">
      <i class="fa fa-plus-square" aria-hidden="true"></i> Pedidos Cancelados
   </summary>
   <div style="margin-top:16px;">
      <?php if (isset($pedidos5) && count($pedidos5) > 0): ?>
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
                  <?php foreach ($pedidos5 as $pedido): ?>
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
                           <button class="w3-button action-btn btn-delete" data-id="<?php echo $id; ?>" id="botaoExcluir" onclick="SoftDelete(<?php echo htmlspecialchars($id); ?>)">EXCLUIR</button>
                        </td>
                        <td class="td-tight"><select name="" id="pedido-Status" class="select_status" onchange="alterarStatus(this.value, <?php echo $pedido['pedido_id']; ?>)">
                           <option value="NULL">ESCOLHA AQUI</option>
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

         <div class="paginacao-controls" style="display:flex; justify-content:flex-end; align-items:center; margin-top:16px;">
            <a class="w3-button w3-blue" href="/backend/pedidos/tipopedidos/cancelados/1" style="border-radius:8px; font-weight:600;">
               <i class="fa fa-eye"></i> Veja mais
            </a>
         </div>
      <?php else: ?>
         <div class="w3-panel w3-pale-blue w3-leftbar w3-border-blue" style="border-radius:8px;">
            <p style="margin:8px 0;"><i class="fa fa-info-circle"></i> Nenhum pedido Cancelado.</p>
         </div>
      <?php endif; ?>
   </div>
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
        `;
            }




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