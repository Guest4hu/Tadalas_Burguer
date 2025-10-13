 <!-- Header -->
 <header class="w3-container" style="padding-top:22px">
    <h5><b><i class="fa fa-dashboard"></i> My Dashboard</b></h5>
 </header>

 <div class="w3-row-padding w3-margin-bottom">
     <div class="w3-quarter">
         <div class="w3-container w3-blue w3-padding-16">
             <div class="w3-left"><i class="fa fa-users w3-xxxlarge" style="color: white;"></i></div>
             <div class="w3-right">
                 <h3><?php echo $total_; ?></h3>
             </div>
             <div class="w3-clear"></div>
             <h4>Total de  Promoções</h4>
         </div>
     </div>
     <div class="w3-quarter">
         <div class="w3-container w3-green w3-padding-16">
             <div class="w3-left"><i class="fa fa-user-circle-o w3-xxxlarge" style="color: green;"></i></div>
             <div class="w3-right">
                 <h3><?php echo $total_ativos; ?></h3>
             </div>
             <div class="w3-clear"></div>
             <h4>Promoções Ativas</h4>
         </div>
     </div>
     <div class="w3-quarter">
         <div class="w3-container w3-orange w3-padding-16">
             <div class="w3-left"><i class="fa fa-user-times w3-xxxlarge" style="color: red;"></i></div>
             <div class="w3-right">
                 <h3><?php echo $total_inativos; ?></h3>
             </div>
             <div class="w3-clear"></div>
             <h4>Promoções Inativas</h4>
         </div>
     </div>
     <div class="w3-quarter">
     </div>
 </div>

 <div>Listar Promoções</div>
 <?php if (isset($promocoes) && count($promocoes) > 0): ?>
    <table border="1" cellpadding="5" cellspacing="0" class="w3-table w3-striped w3-white">
        <thead>
           <tr>
              <th>ID</th>
              <th>Nome</th>
              <th>Descrição</th>
              <th>Valor</th>
              <th>Data de Início</th>
              <th>Data de Fim</th>
              <th>Editar</th>
              <th>Excluir</th>
           </tr>
        </thead>
        <tbody>
           <?php foreach ($promocoes as $promocao): ?>
              <tr>
                 <td><?= htmlspecialchars($promocao['promocao_id']) ?></td>
                 <td><?= htmlspecialchars($promocao['nome']) ?></td>
                 <td><?= htmlspecialchars($promocao['descricao']) ?></td>
                 <td><?= htmlspecialchars($promocao['valor']) ?></td>
                 <td><?= htmlspecialchars($promocao['data_inicio']) ?></td>
                 <td><?= htmlspecialchars($promocao['data_fim']) ?></td>
                 <td><a href="/backend/promocao/editar/<?= htmlspecialchars($promocao['promocao_id']) ?>">Editar</a></td>
                 <td><a href="/backend/promocao/excluir/<?= htmlspecialchars($promocao['promocao_id']) ?>">Excluir</a></td>
              </tr>
           <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginacao-controls" style="display:flex; justify-content:space-between; align-items:center; margin-top:20px;">
        <div class="page-selector" style="display:flex; align-items:center;">
           <div class="page-nav">
              <?php if ($paginacao['pagina_atual'] > 1): ?>
                 <a href="/backend/promocao/listar/<?= $paginacao['pagina_atual'] - 1 ?>">Anterior</a>
              <?php endif; ?>
              <span style="margin:0 10px;">Página <?= $paginacao['pagina_atual'] ?> de <?= $paginacao['ultima_pagina'] ?></span>
              <?php if ($paginacao['pagina_atual'] < $paginacao['ultima_pagina']): ?>
                 <a href="/backend/promocao/listar/<?= $paginacao['pagina_atual'] + 1 ?>">Próximo</a>
              <?php endif; ?>
           </div>
        </div>
    </div>
 <?php else: ?>
    <div>Nenhuma promoção encontrada.</div>
 <?php endif ?>
