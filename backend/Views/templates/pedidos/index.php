 <!-- Header -->
 <header class="w3-container" style="padding-top:22px">
    <h5><b><i class="fa fa-dashboard"></i> Meu Painel de Pedidos</b></h5>
 </header>

 <div class="w3-row-padding w3-margin-bottom">
    <div class="w3-quarter">
        <div class="w3-container w3-red w3-padding-16">
           <div class="w3-left"><i class="fa fa-shopping-cart w3-xxxlarge"></i></div>
           <div class="w3-right">
              <h3><?= isset($total_pedidos) ? $total_pedidos : 0 ?></h3>
           </div>
           <div class="w3-clear"></div>
           <h4>Pedidos</h4>
        </div>
    </div>
    <div class="w3-quarter">
        <div class="w3-container w3-blue w3-padding-16">
           <div class="w3-left"><i class="fa fa-check w3-xxxlarge"></i></div>
           <div class="w3-right">
              <h3><?= isset($pedidos_entregues) ? $pedidos_entregues : 0 ?></h3>
           </div>
           <div class="w3-clear"></div>
           <h4>Entregues</h4>
        </div>
    </div>
    <div class="w3-quarter">
        <div class="w3-container w3-teal w3-padding-16">
           <div class="w3-left"><i class="fa fa-clock-o w3-xxxlarge"></i></div>
           <div class="w3-right">
              <h3><?= isset($pedidos_pendentes) ? $pedidos_pendentes : 0 ?></h3>
           </div>
           <div class="w3-clear"></div>
           <h4>Pendentes</h4>
        </div>
    </div>
    <div class="w3-quarter">
        <div class="w3-container w3-orange w3-text-white w3-padding-16">
           <div class="w3-left"><i class="fa fa-times w3-xxxlarge"></i></div>
           <div class="w3-right">
              <h3><?= isset($pedidos_cancelados) ? $pedidos_cancelados : 0 ?></h3>
           </div>
           <div class="w3-clear"></div>
           <h4>Cancelados</h4>
        </div>
    </div>
 </div>

 <div>Listar Pedidos</div>
 <?php if (isset($pedidos) && count($pedidos) > 0): ?>
    <table border="1" cellpadding="5" cellspacing="0" class="w3-table w3-striped w3-white">
        <thead>
           <tr>
              <th>ID</th>
              <th>Cliente</th>
              <th>Data</th>
              <th>Status</th>
              <th>Valor Total</th>
              <th>Editar</th>
              <th>Excluir</th>
           </tr>
        </thead>
        <tbody>
           <?php foreach ($pedidos as $pedido): ?>
              <tr>
                 <td><?= htmlspecialchars($pedido['pedido_id']) ?></td>
                 <td><?= htmlspecialchars($pedido['cliente_nome']) ?></td>
                 <td><?= htmlspecialchars($pedido['data']) ?></td>
                 <td><?= htmlspecialchars($pedido['status']) ?></td>
                 <td><?= htmlspecialchars($pedido['valor_total']) ?></td>
                 <td><a href="/backend/pedido/editar/<?= htmlspecialchars($pedido['pedido_id']) ?>">Editar</a></td>
                 <td><a href="/backend/pedido/excluir/<?= htmlspecialchars($pedido['pedido_id']) ?>">Excluir</a></td>
              </tr>
           <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginacao-controls" style="display:flex; justify-content:space-between; align-items:center; margin-top:20px;">
        <div class="page-selector" style="display:flex; align-items:center;">
           <div class="page-nav">
              <?php if ($paginacao['pagina_atual'] > 1): ?>
                 <a href="/backend/pedido/listar/<?= $paginacao['pagina_atual'] - 1 ?>">Anterior</a>
              <?php endif; ?>
              <span style="margin:0 10px;">Página <?= $paginacao['pagina_atual'] ?> de <?= $paginacao['ultima_pagina'] ?></span>
              <?php if ($paginacao['pagina_atual'] < $paginacao['ultima_pagina']): ?>
                 <a href="/backend/pedido/listar/<?= $paginacao['pagina_atual'] + 1 ?>">Próximo</a>
              <?php endif; ?>
           </div>
        </div>
    </div>
 <?php else: ?>
    <div>Nenhum pedido encontrado.</div>
 <?php endif ?>
