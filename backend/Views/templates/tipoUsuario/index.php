<!-- Estilos finos para visual e acessibilidade -->
<style>
    /* Cartões de métricas */
    .stat-card { border-radius: 10px; box-shadow: 0 6px 16px rgba(0,0,0,.12); position: relative; overflow: hidden; }
    .stat-card .w3-left { opacity: .9 }
    .stat-card h3 { margin: 0; font-weight: 700; letter-spacing: .5px }
    .stat-subtitle { margin: 6px 0 0; font-weight: 600 }

    .bg-blue    { background: linear-gradient(135deg, #1976D2 0%, #42A5F5 100%) }
    .bg-green   { background: linear-gradient(135deg, #2E7D32 0%, #66BB6A 100%) }
    .bg-orange  { background: linear-gradient(135deg, #EF6C00 0%, #FFA726 100%) }
    .bg-indigo  { background: linear-gradient(135deg, #3949AB 0%, #5C6BC0 100%) }

    /* Tabela */
    .card-table { border-radius: 10px; overflow: hidden; box-shadow: 0 6px 16px rgba(0,0,0,.08); }
    .table-head { background: #f7f9fc; border-bottom: 1px solid #e6ebf1 }
    .table-head th { font-weight: 700; color: #2f3a57; white-space: nowrap }
    .table-row:hover { background: #f9fbff }
    .td-tight { white-space: nowrap }
    .badge { font-size: 12px; padding: 4px 10px; border-radius: 999px; font-weight: 700; display: inline-flex; align-items: center; gap: 6px }
    .badge i { font-size: 12px }
    .badge-blue { background: #E3F2FD; color: #1565C0 }
    .badge-red { background: #FFEBEE; color: #C62828 }
    .badge-gray { background: #ECEFF1; color: #455A64 }

    /* Ações */
    .action-btn { border-radius: 8px; padding: 6px 10px; font-weight: 600 }
    .action-btn i { margin-right: 6px }
    .btn-edit { background: #E3F2FD; color: #1565C0 }
    .btn-delete { background: #FFEBEE; color: #C62828 }
    .btn-edit:hover { background: #BBDEFB }
    .btn-delete:hover { background: #FFCDD2 }

    /* Paginação */
    .pager .w3-button { border-radius: 8px; font-weight: 600 }
    .pager .w3-button.w3-disabled { opacity: .5; cursor: not-allowed }
</style>

<?php
// ======= VARIÁVEIS DE MÉTRICAS =======
$total_usuarios = $total_TipoUsuarios ?? 0;
$total_ativos   = $total_ativos ?? 0;
$total_inativos = $total_inativos ?? 0;
$taxa_ativacao  = $total_usuarios > 0 ? round(($total_ativos / $total_usuarios) * 100) : 0;

// Função helper simples
$toLower = fn($v) => function_exists('mb_strtolower') ? mb_strtolower((string)$v, 'UTF-8') : strtolower((string)$v);

// Status formatado
$usuarioStatusMeta = function (array $u) use ($toLower): array {
    $s = $u['ativo'] ?? ($u['status'] ?? '');
    $s = $toLower(trim((string)$s));
    if (in_array($s, ['ativo', '1', 'active']))  return ['icon'=>'fa-check-circle','text'=>'Ativo','badge'=>'badge-blue'];
    if (in_array($s, ['inativo', '0', 'inactive'])) return ['icon'=>'fa-times-circle','text'=>'Inativo','badge'=>'badge-red'];
    return ['icon'=>'fa-question-circle','text'=>'Indefinido','badge'=>'badge-gray'];
};
?>

<!-- Header -->
<header class="w3-container" style="padding:22px 0 12px 0;">
    <h5 style="margin:0; display:flex; align-items:center; gap:10px; color:#2f3a57">
        <i class="fa fa-id-badge" aria-hidden="true"></i>
        Painel de Tipos de Usuário
    </h5>
    <div style="color:#6b7a99; font-size:13px; margin-top:6px">
        Visão geral e gerenciamento dos tipos de usuário
    </div>
</header>

<!-- Cards -->
<div class="w3-row-padding w3-margin-bottom">
    <div class="w3-quarter">
        <div class="w3-container w3-padding-16 stat-card bg-blue">
            <div class="w3-left"><i class="fa fa-id-badge w3-xxxlarge" style="color:#fff;"></i></div>
            <div class="w3-right"><h3 style="color:#fff;"><?= number_format($total_usuarios, 0, ',', '.') ?></h3></div>
            <div class="w3-clear"></div>
            <h4 class="stat-subtitle" style="color:#E3F2FD">Total de Tipos</h4>
        </div>
    </div>

    <div class="w3-quarter">
        <div class="w3-container w3-padding-16 stat-card bg-green">
            <div class="w3-left"><i class="fa fa-check-circle w3-xxxlarge" style="color:#fff;"></i></div>
            <div class="w3-right"><h3 style="color:#fff;"><?= number_format($total_ativos, 0, ',', '.') ?></h3></div>
            <div class="w3-clear"></div>
            <h4 class="stat-subtitle" style="color:#E8F5E9">Ativos</h4>
        </div>
    </div>

    <div class="w3-quarter">
        <div class="w3-container w3-padding-16 stat-card bg-orange">
            <div class="w3-left"><i class="fa fa-times-circle w3-xxxlarge" style="color:#fff;"></i></div>
            <div class="w3-right"><h3 style="color:#fff;"><?= number_format($total_inativos, 0, ',', '.') ?></h3></div>
            <div class="w3-clear"></div>
            <h4 class="stat-subtitle" style="color:#FFF3E0">Inativos</h4>
        </div>
    </div>

    <div class="w3-quarter">
        <div class="w3-container w3-padding-16 stat-card bg-indigo">
            <div class="w3-left"><i class="fa fa-percent w3-xxxlarge" style="color:#fff;"></i></div>
            <div class="w3-right"><h3 style="color:#fff;"><?= $taxa_ativacao ?>%</h3></div>
            <div class="w3-clear"></div>
            <h4 class="stat-subtitle" style="color:#E8EAF6">Taxa de Ativação</h4>
        </div>
    </div>
</div>

<!-- Tabela -->
<div style="display:flex; align-items:center; justify-content:space-between; margin:8px 0 10px 0;">
    <div style="font-weight:700; color:#2f3a57; display:flex; align-items:center; gap:8px">
        <i class="fa fa-list" aria-hidden="true"></i>
        Listagem de Tipos de Usuário
    </div>
</div>

<?php if (!empty($usuarios) && is_array($usuarios)): ?>
    <div class="w3-responsive card-table">
        <table class="w3-table w3-striped w3-white">
            <thead class="table-head">
                <tr>
                    <th class="td-tight"><i class="fa fa-hashtag"></i> ID</th>
                    <th><i class="fa fa-id-badge"></i> Descrição</th>
                    <th class="td-tight"><i class="fa fa-info-circle"></i> Status</th>
                    <th class="td-tight"><i class="fa fa-pencil"></i> Editar</th>
                    <th class="td-tight"><i class="fa fa-trash"></i> Excluir</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($usuarios as $usuario): ?>
                    <?php
                        $id = htmlspecialchars($usuario['tipo_usuario_id'] ?? $usuario['id'] ?? '');
                        $descricao = htmlspecialchars($usuario['descricao'] ?? '—');
                        $statusMeta = $usuarioStatusMeta($usuario);
                    ?>
                    <tr class="table-row">
                        <td class="td-tight"><?= $id ?></td>
                        <td><i class="fa fa-id-badge" style="color:#34495e;"></i> <?= $descricao ?></td>
                        <td class="td-tight">
                            <span class="badge <?= $statusMeta['badge'] ?>">
                                <i class="fa <?= $statusMeta['icon'] ?>"></i>
                                <?= $statusMeta['text'] ?>
                            </span>
                        </td>
                        <td class="td-tight">
                            <a class="w3-button action-btn btn-edit" href="tipousuario/edit/<?= $id ?>">
                                <i class="fa fa-pencil"></i> Editar
                            </a>
                        </td>
                        <td class="td-tight">
                            <a class="w3-button action-btn btn-delete"
                               href="tipoUsuario/excluir/<?= $id ?>"
                               onclick="return confirm('Confirma a exclusão deste tipo de usuário?');">
                                <i class="fa fa-trash"></i> Excluir
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Paginação -->
    <?php if (!empty($paginacao) && isset($paginacao['pagina_atual'], $paginacao['ultima_pagina'])): ?>
        <div class="paginacao-controls" style="display:flex; justify-content:space-between; align-items:center; margin-top:16px;">
            <div class="page-selector pager">
                <?php if ($paginacao['pagina_atual'] > 1): ?>
                    <a class="w3-button w3-light-gray" href="?pagina=<?= $paginacao['pagina_atual'] - 1 ?>">
                        <i class="fa fa-chevron-left"></i> Anterior
                    </a>
                <?php else: ?>
                    <span class="w3-button w3-light-gray w3-disabled"><i class="fa fa-chevron-left"></i> Anterior</span>
                <?php endif; ?>

                <span style="margin:0 10px; color:#2f3a57; font-weight:600;">
                    Página <?= $paginacao['pagina_atual'] ?> de <?= $paginacao['ultima_pagina'] ?>
                </span>

                <?php if ($paginacao['pagina_atual'] < $paginacao['ultima_pagina']): ?>
                    <a class="w3-button w3-light-gray" href="?pagina=<?= $paginacao['pagina_atual'] + 1 ?>">
                        Próximo <i class="fa fa-chevron-right"></i>
                    </a>
                <?php else: ?>
                    <span class="w3-button w3-light-gray w3-disabled">Próximo <i class="fa fa-chevron-right"></i></span>
                <?php endif; ?>
            </div>
        </div>
    <?php endif; ?>
<?php else: ?>
    <div class="w3-panel w3-pale-blue w3-leftbar w3-border-blue" style="border-radius:8px;">
        <p style="margin:8px 0;"><i class="fa fa-info-circle"></i> Nenhum tipo de usuário encontrado.</p>
    </div>
<?php endif; ?>
