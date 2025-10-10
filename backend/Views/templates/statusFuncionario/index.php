<!-- Header -->
<header class="w3-container" style="padding-top:22px">
    <h5><b><i class="fa fa-dashboard"></i> Status dos Funcionários</b></h5>
</header>

<div class="w3-row-padding w3-margin-bottom">
    <div class="w3-quarter">
        <div class="w3-container w3-red w3-padding-16">
            <div class="w3-left"><i class="fa fa-user-times w3-xxxlarge"></i></div>
            <div class="w3-right">
                <h3><?= isset($totalInativos) ? $totalInativos : 0 ?></h3>
            </div>
            <div class="w3-clear"></div>
            <h4>Inativos</h4>
        </div>
    </div>
    <div class="w3-quarter">
        <div class="w3-container w3-blue w3-padding-16">
            <div class="w3-left"><i class="fa fa-user-check w3-xxxlarge"></i></div>
            <div class="w3-right">
                <h3><?= isset($totalAtivos) ? $totalAtivos : 0 ?></h3>
            </div>
            <div class="w3-clear"></div>
            <h4>Ativos</h4>
        </div>
    </div>
    <div class="w3-quarter">
        <div class="w3-container w3-teal w3-padding-16">
            <div class="w3-left"><i class="fa fa-user-clock w3-xxxlarge"></i></div>
            <div class="w3-right">
                <h3><?= isset($totalEmFerias) ? $totalEmFerias : 0 ?></h3>
            </div>
            <div class="w3-clear"></div>
            <h4>Em Férias</h4>
        </div>
    </div>
    <div class="w3-quarter">
        <div class="w3-container w3-orange w3-text-white w3-padding-16">
            <div class="w3-left"><i class="fa fa-users w3-xxxlarge"></i></div>
            <div class="w3-right">
                <h3><?= isset($totalFuncionarios) ? $totalFuncionarios : 0 ?></h3>
            </div>
            <div class="w3-clear"></div>
            <h4>Total Funcionários</h4>
        </div>
    </div>
</div>

<div>Listar Status Funcionário</div>
<?php if (isset($statusFuncionarios) && count($statusFuncionarios) > 0): ?>
    <table border="1" cellpadding="5" cellspacing="0" class="w3-table w3-striped w3-white">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
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
