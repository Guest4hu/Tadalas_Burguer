<!-- Header -->
<header class="w3-container" style="padding-top:22px">
    <h5><b><i class="fa fa-dashboard"></i> Status dos Funcionários</b></h5>
</header>

 <div class="w3-row-padding w3-margin-bottom">
     <div class="w3-quarter">
         <div class="w3-container w3-blue w3-padding-16">
             <div class="w3-left"><i class="fa fa-users w3-xxxlarge" style="color: white;"></i></div>
             <div class="w3-right">
                 <h3><?php echo $total_; ?></h3>
             </div>
             <div class="w3-clear"></div>
             <h4>Total de Status de Funcionários</h4>
         </div>
     </div>
     <div class="w3-quarter">
         <div class="w3-container w3-green w3-padding-16">
             <div class="w3-left"><i class="fa fa-user-circle-o w3-xxxlarge" style="color: green;"></i></div>
             <div class="w3-right">
                 <h3><?php echo $total_ativos; ?></h3>
             </div>
             <div class="w3-clear"></div>
             <h4>Status de Funcionários Ativos</h4>
         </div>
     </div>
     <div class="w3-quarter">
         <div class="w3-container w3-orange w3-padding-16">
             <div class="w3-left"><i class="fa fa-user-times w3-xxxlarge" style="color: red;"></i></div>
             <div class="w3-right">
                 <h3><?php echo $total_inativos; ?></h3>
             </div>
             <div class="w3-clear"></div>
             <h4>Status de Funcionários Inativos</h4>
         </div>
     </div>
     <div class="w3-quarter">
     </div>
 </div>
 
<div>Listar Status Funcionário</div>
<?php if (isset($statusFuncionarios) && count($statusFuncionarios) > 0): ?>
    <table border="1" cellpadding="5" cellspacing="0" class="w3-table w3-striped w3-white">
        <thead>
            <tr>
                <th>ID</th>
                <th>Status</th>
                <th>Editar</th>
                <th>Excluir</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($statusFuncionarios as $funcionario): ?>
                <tr>
                    <td><?= htmlspecialchars($funcionario['id']) ?></td>
                    <td><?= htmlspecialchars($funcionario['descricao']) ?></td>
                    <td><a href="/backend/statusFuncionario/editar/<?= htmlspecialchars($funcionario['id']) ?>">Editar</a></td>
                    <td><a href="/backend/statusFuncionario/excluir/<?= htmlspecialchars($funcionario['id']) ?>">Excluir</a></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginacao-controls" style="display:flex; justify-content:space-between; align-items:center; margin-top:20px;">
        <div class="page-selector" style="display:flex; align-items:center;">
            <div class="page-nav">
                <?php if ($paginacao['pagina_atual'] > 1): ?>
                    <a href="/backend/statusFuncionario/listar/<?= $paginacao['pagina_atual'] - 1 ?>">Anterior</a>
                <?php endif; ?>
                <span style="margin:0 10px;">Página <?= $paginacao['pagina_atual'] ?> de <?= $paginacao['ultima_pagina'] ?></span>
                <?php if ($paginacao['pagina_atual'] < $paginacao['ultima_pagina']): ?>
                    <a href="/backend/statusFuncionario/listar/<?= $paginacao['pagina_atual'] + 1 ?>">Próximo</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php else: ?>
    <div>Nenhum status de funcionário encontrado.</div>
<?php endif ?>
