<!-- Header -->
<header class="w3-container" style="padding-top:22px">
    <h5><b><i class="fa fa-dashboard"></i> Dashboard de Itens do Pedido</b></h5>
</header>

<div class="w3-row-padding w3-margin-bottom">
    <!-- Seus cards de dashboard podem ser mantidos ou adaptados conforme necessário -->
</div>

<div>Listar Itens do Pedido</div>
<?php if (isset($itensPedidos) && count($itensPedidos) > 0): ?>
    <table border="1" cellpadding="5" cellspacing="0" class="w3-table w3-striped w3-white">
        <thead>
            <tr>
                <th>ID</th>
                <th>ID do Pedido</th>
                <th>ID do Produto</th>
                <th>Quantidade</th>
                <th>Preço</th>
                <th>Editar</th>
                <th>Excluir</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($itensPedidos as $item): ?>
                <tr>
                    <td><?= htmlspecialchars($item['item_pedido_id']) ?></td>
                    <td><?= htmlspecialchars($item['pedido_id']) ?></td>
                    <td><?= htmlspecialchars($item['produto_id']) ?></td>
                    <td><?= htmlspecialchars($item['quantidade']) ?></td>
                    <td><?= htmlspecialchars($item['preco']) ?></td>
                    <td><a href="/backend/itensPedidos/editar/<?= htmlspecialchars($item['item_pedido_id']) ?>">Editar</a></td>
                    <td><a href="/backend/itensPedidos/excluir/<?= htmlspecialchars($item['item_pedido_id']) ?>">Excluir</a></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginacao-controls" style="display:flex; justify-content:space-between; align-items:center; margin-top:20px;">
        <div class="page-selector" style="display:flex; align-items:center;">
            <div class="page-nav">
                <?php if ($paginacao['pagina_atual'] > 1): ?>
                    <a href="/backend/itensPedidos/listar/<?= $paginacao['pagina_atual'] - 1 ?>">Anterior</a>
                <?php endif; ?>
                <span style="margin:0 10px;">Página <?= $paginacao['pagina_atual'] ?> de <?= $paginacao['ultima_pagina'] ?></span>
                <?php if ($paginacao['pagina_atual'] < $paginacao['ultima_pagina']): ?>
                    <a href="/backend/itensPedidos/listar/<?= $paginacao['pagina_atual'] + 1 ?>">Próximo</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php else: ?>
    <div>Nenhum item de pedido encontrado.</div>
<?php endif ?>
