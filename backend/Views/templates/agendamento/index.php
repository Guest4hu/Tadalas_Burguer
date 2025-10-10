<!-- Header -->
<header class="w3-container" style="padding-top:22px">
    <h5><b><i class="fa fa-dashboard"></i> Dashboard de Agendamentos</b></h5>
</header>

<div class="w3-row-padding w3-margin-bottom">
    <div class="w3-quarter">
        <div class="w3-container w3-red w3-padding-16">
            <div class="w3-left"><i class="fa fa-calendar w3-xxxlarge"></i></div>
            <div class="w3-right">
                <h3>52</h3>
            </div>
            <div class="w3-clear"></div>
            <h4>Agendamentos</h4>
        </div>
    </div>
    <div class="w3-quarter">
        <div class="w3-container w3-blue w3-padding-16">
            <div class="w3-left"><i class="fa fa-check w3-xxxlarge"></i></div>
            <div class="w3-right">
                <h3>40</h3>
            </div>
            <div class="w3-clear"></div>
            <h4>Confirmados</h4>
        </div>
    </div>
    <div class="w3-quarter">
        <div class="w3-container w3-teal w3-padding-16">
            <div class="w3-left"><i class="fa fa-clock-o w3-xxxlarge"></i></div>
            <div class="w3-right">
                <h3>8</h3>
            </div>
            <div class="w3-clear"></div>
            <h4>Pendentes</h4>
        </div>
    </div>
    <div class="w3-quarter">
        <div class="w3-container w3-orange w3-text-white w3-padding-16">
            <div class="w3-left"><i class="fa fa-times w3-xxxlarge"></i></div>
            <div class="w3-right">
                <h3>4</h3>
            </div>
            <div class="w3-clear"></div>
            <h4>Cancelados</h4>
        </div>
    </div>
</div>

<div>Listar Agendamentos</div>
<?php if (isset($agendamentos) && count($agendamentos) > 0): ?>
    <table border="1" cellpadding="5" cellspacing="0" class="w3-table w3-striped w3-white">
        <thead>
            <tr>
                <th>ID</th>
                <th>Cliente</th>
                <th>Data</th>
                <th>Hora</th>
                <th>Serviço</th>
                <th>Status</th>
                <th>Editar</th>
                <th>Excluir</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($agendamentos as $agendamento): ?>
                <tr>
                    <td><?= htmlspecialchars($agendamento['agendamento_id']) ?></td>
                    <td><?= htmlspecialchars($agendamento['cliente']) ?></td>
                    <td><?= htmlspecialchars($agendamento['data']) ?></td>
                    <td><?= htmlspecialchars($agendamento['hora']) ?></td>
                    <td><?= htmlspecialchars($agendamento['servico']) ?></td>
                    <td><?= htmlspecialchars($agendamento['status']) ?></td>
                    <td><a href="/backend/agendamento/editar/<?= htmlspecialchars($agendamento['agendamento_id']) ?>">Editar</a></td>
                    <td><a href="/backend/agendamento/excluir/<?= htmlspecialchars($agendamento['agendamento_id']) ?>">Excluir</a></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginacao-controls" style="display:flex; justify-content:space-between; align-items:center; margin-top:20px;">
        <div class="page-selector" style="display:flex; align-items:center;">
            <div class="page-nav">
                <?php if ($paginacao['pagina_atual'] > 1): ?>
                    <a href="/backend/agendamento/listar/<?= $paginacao['pagina_atual'] - 1 ?>">Anterior</a>
                <?php endif; ?>
                <span style="margin:0 10px;">Página <?= $paginacao['pagina_atual'] ?> de <?= $paginacao['ultima_pagina'] ?></span>
                <?php if ($paginacao['pagina_atual'] < $paginacao['ultima_pagina']): ?>
                    <a href="/backend/agendamento/listar/<?= $paginacao['pagina_atual'] + 1 ?>">Próximo</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php else: ?>
    <div>Nenhum agendamento encontrado.</div>
<?php endif ?>
