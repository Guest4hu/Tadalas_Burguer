<!-- Header -->
<header class="w3-container" style="padding-top:22px">
    <h5><b><i class="fa fa-dashboard"></i> Tipo de Usuário - Dashboard</b></h5>
</header>

<div class="w3-row-padding w3-margin-bottom">
    <!-- Os cards podem ser adaptados ou removidos conforme necessidade -->
</div>

<div>Listar Tipos de Usuário</div>
<?php if (isset($tiposUsuario) && count($tiposUsuario) > 0): ?>
    <table border="1" cellpadding="5" cellspacing="0" class="w3-table w3-striped w3-white">
        <thead>
            <tr>
                <th>ID</th>
                <th>Descrição</th>
                <th>Editar</th>
                <th>Excluir</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($tiposUsuario as $tipo): ?>
                <tr>
                    <td><?= htmlspecialchars($tipo['id']) ?></td>
                    <td><?= htmlspecialchars($tipo['descricao']) ?></td>
                    <td><a href="/backend/tipoUsuario/editar/<?= htmlspecialchars($tipo['id']) ?>">Editar</a></td>
                    <td><a href="/backend/tipoUsuario/excluir/<?= htmlspecialchars($tipo['id']) ?>">Excluir</a></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginacao-controls" style="display:flex; justify-content:space-between; align-items:center; margin-top:20px;">
        <div class="page-selector" style="display:flex; align-items:center;">
            <div class="page-nav">
                <?php if ($paginacao['pagina_atual'] > 1): ?>
                    <a href="/backend/tipoUsuario/listar/<?= $paginacao['pagina_atual'] - 1 ?>">Anterior</a>
                <?php endif; ?>
                <span style="margin:0 10px;">Página <?= $paginacao['pagina_atual'] ?> de <?= $paginacao['ultima_pagina'] ?></span>
                <?php if ($paginacao['pagina_atual'] < $paginacao['ultima_pagina']): ?>
                    <a href="/backend/tipoUsuario/listar/<?= $paginacao['pagina_atual'] + 1 ?>">Próximo</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php else: ?>
    <div>Nenhum tipo de usuário encontrado.</div>
<?php endif ?>
