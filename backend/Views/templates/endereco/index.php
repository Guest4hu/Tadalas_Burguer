<!-- Header -->
<header class="w3-container" style="padding-top:22px">
    <h5><b><i class="fa fa-dashboard"></i> Dashboard de Endereços</b></h5>
</header>

<div class="w3-row-padding w3-margin-bottom">
    <div class="w3-quarter">
        <div class="w3-container w3-red w3-padding-16">
            <div class="w3-left"><i class="fa fa-map-marker w3-xxxlarge"></i></div>
            <div class="w3-right">
                <h3><?= isset($total_enderecos) ? $total_enderecos : 0 ?></h3>
            </div>
            <div class="w3-clear"></div>
            <h4>Endereços</h4>
        </div>
    </div>
    <!-- Outros cards podem ser adaptados conforme necessário -->
</div>

<div>Listar Endereços</div>
<?php if (isset($enderecos) && count($enderecos) > 0): ?>
    <table border="1" cellpadding="5" cellspacing="0" class="w3-table w3-striped w3-white">
        <thead>
            <tr>
                <th>ID</th>
                <th>Rua</th>
                <th>Número</th>
                <th>Bairro</th>
                <th>Cidade</th>
                <th>Estado</th>
                <th>CEP</th>
                <th>Editar</th>
                <th>Excluir</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($enderecos as $endereco): ?>
                <tr>
                    <td><?= htmlspecialchars($endereco['endereco_id']) ?></td>
                    <td><?= htmlspecialchars($endereco['rua']) ?></td>
                    <td><?= htmlspecialchars($endereco['numero']) ?></td>
                    <td><?= htmlspecialchars($endereco['bairro']) ?></td>
                    <td><?= htmlspecialchars($endereco['cidade']) ?></td>
                    <td><?= htmlspecialchars($endereco['estado']) ?></td>
                    <td><?= htmlspecialchars($endereco['cep']) ?></td>
                    <td><a href="/backend/endereco/editar/<?= htmlspecialchars($endereco['endereco_id']) ?>">Editar</a></td>
                    <td><a href="/backend/endereco/excluir/<?= htmlspecialchars($endereco['endereco_id']) ?>">Excluir</a></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginacao-controls" style="display:flex; justify-content:space-between; align-items:center; margin-top:20px;">
        <div class="page-selector" style="display:flex; align-items:center;">
            <div class="page-nav">
                <?php if ($paginacao['pagina_atual'] > 1): ?>
                    <a href="/backend/endereco/listar/<?= $paginacao['pagina_atual'] - 1 ?>">Anterior</a>
                <?php endif; ?>
                <span style="margin:0 10px;">Página <?= $paginacao['pagina_atual'] ?> de <?= $paginacao['ultima_pagina'] ?></span>
                <?php if ($paginacao['pagina_atual'] < $paginacao['ultima_pagina']): ?>
                    <a href="/backend/endereco/listar/<?= $paginacao['pagina_atual'] + 1 ?>">Próximo</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php else: ?>
    <div>Nenhum endereço encontrado.</div>
<?php endif ?>
