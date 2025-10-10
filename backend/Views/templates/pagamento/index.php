<!-- Header -->
<header class="w3-container" style="padding-top:22px">
    <h5><b><i class="fa fa-dashboard"></i> Pagamentos</b></h5>
</header>

<div class="w3-row-padding w3-margin-bottom">
    <div class="w3-quarter">
        <div class="w3-container w3-red w3-padding-16">
            <div class="w3-left"><i class="fa fa-credit-card w3-xxxlarge"></i></div>
            <div class="w3-right">
                <h3>52</h3>
            </div>
            <div class="w3-clear"></div>
            <h4>Pagamentos Pendentes</h4>
        </div>
    </div>
    <div class="w3-quarter">
        <div class="w3-container w3-blue w3-padding-16">
            <div class="w3-left"><i class="fa fa-check w3-xxxlarge"></i></div>
            <div class="w3-right">
                <h3>99</h3>
            </div>
            <div class="w3-clear"></div>
            <h4>Pagamentos Confirmados</h4>
        </div>
    </div>
    <div class="w3-quarter">
        <div class="w3-container w3-teal w3-padding-16">
            <div class="w3-left"><i class="fa fa-money w3-xxxlarge"></i></div>
            <div class="w3-right">
                <h3>23</h3>
            </div>
            <div class="w3-clear"></div>
            <h4>Recebidos Hoje</h4>
        </div>
    </div>
    <div class="w3-quarter">
        <div class="w3-container w3-orange w3-text-white w3-padding-16">
            <div class="w3-left"><i class="fa fa-users w3-xxxlarge"></i></div>
            <div class="w3-right">
                <h3>50</h3>
            </div>
            <div class="w3-clear"></div>
            <h4>Clientes</h4>
        </div>
    </div>
</div>

<div>Listar Pagamentos</div>
<?php if (isset($pagamentos) && count($pagamentos) > 0): ?>
    <table border="1" cellpadding="5" cellspacing="0" class="w3-table w3-striped w3-white">
        <thead>
            <tr>
                <th>ID</th>
                <th>Cliente</th>
                <th>Valor</th>
                <th>Data</th>
                <th>Status</th>
                <th>Método</th>
                <th>Editar</th>
                <th>Excluir</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($pagamentos as $pagamento): ?>
                <tr>
                    <td><?= htmlspecialchars($pagamento['pagamento_id']) ?></td>
                    <td><?= htmlspecialchars($pagamento['cliente_nome']) ?></td>
                    <td><?= htmlspecialchars($pagamento['valor']) ?></td>
                    <td><?= htmlspecialchars($pagamento['data']) ?></td>
                    <td><?= htmlspecialchars($pagamento['status']) ?></td>
                    <td><?= htmlspecialchars($pagamento['metodo']) ?></td>
                    <td><a href="/backend/pagamento/editar/<?= htmlspecialchars($pagamento['pagamento_id']) ?>">Editar</a></td>
                    <td><a href="/backend/pagamento/excluir/<?= htmlspecialchars($pagamento['pagamento_id']) ?>">Excluir</a></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginacao-controls" style="display:flex; justify-content:space-between; align-items:center; margin-top:20px;">
        <div class="page-selector" style="display:flex; align-items:center;">
            <div class="page-nav">
                <?php if ($paginacao['pagina_atual'] > 1): ?>
                    <a href="/backend/pagamento/listar/<?= $paginacao['pagina_atual'] - 1 ?>">Anterior</a>
                <?php endif; ?>
                <span style="margin:0 10px;">Página <?= $paginacao['pagina_atual'] ?> de <?= $paginacao['ultima_pagina'] ?></span>
                <?php if ($paginacao['pagina_atual'] < $paginacao['ultima_pagina']): ?>
                    <a href="/backend/pagamento/listar/<?= $paginacao['pagina_atual'] + 1 ?>">Próximo</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php else: ?>
    <div>Nenhum pagamento encontrado.</div>
<?php endif ?>
