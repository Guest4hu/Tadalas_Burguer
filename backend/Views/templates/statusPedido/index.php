<div>Listar Status do Pedido</div>
<?php if (isset($statusPedidos) && count($statusPedidos) > 0): ?>
    <table border="1" cellpadding="5" cellspacing="0" class="w3-table w3-striped w3-white">
        <thead>
            <tr>
                <th>ID</th>
                <th>Status</th>
                <th>Descrição</th>
                <th>Editar</th>
                <th>Excluir</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($statusPedidos as $status): ?>
                <tr>
                    <td><?= htmlspecialchars($status['id']) ?></td>
                    <td><?= htmlspecialchars($status['nome']) ?></td>
                    <td><?= htmlspecialchars($status['descricao']) ?></td>
                    <td><a href="/backend/statusPedido/editar/<?= htmlspecialchars($status['id']) ?>">Editar</a></td>
                    <td><a href="/backend/statusPedido/excluir/<?= htmlspecialchars($status['id']) ?>">Excluir</a></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginacao-controls" style="display:flex; justify-content:space-between; align-items:center; margin-top:20px;">
        <div class="page-selector" style="display:flex; align-items:center;">
            <div class="page-nav">
                <?php if ($paginacao['pagina_atual'] > 1): ?>
                    <a href="/backend/statusPedido/listar/<?= $paginacao['pagina_atual'] - 1 ?>">Anterior</a>
                <?php endif; ?>
                <span style="margin:0 10px;">Página <?= $paginacao['pagina_atual'] ?> de <?= $paginacao['ultima_pagina'] ?></span>
                <?php if ($paginacao['pagina_atual'] < $paginacao['ultima_pagina']): ?>
                    <a href="/backend/statusPedido/listar/<?= $paginacao['pagina_atual'] + 1 ?>">Próximo</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php else: ?>
    <div>Nenhum status de pedido encontrado.</div>
<?php endif ?>
