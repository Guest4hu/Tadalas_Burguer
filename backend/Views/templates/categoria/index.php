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
    .badge-amber { background: #FFF8E1; color: #EF6C00 }
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
// Métricas seguras
$total_categorias = isset($total_) ? (int)$total_ : (isset($total_categorias) ? (int)$total_categorias : 0);
$total_ativos     = isset($total_ativos) ? (int)$total_ativos : 0;
$total_inativos   = isset($total_inativos) ? (int)$total_inativos : 0;
$taxa_ativacao    = $total_categorias > 0 ? round(($total_ativos / $total_categorias) * 100) : 0;

// Helpers
$toLower = function ($v): string {
    return function_exists('mb_strtolower') ? mb_strtolower((string)$v, 'UTF-8') : strtolower((string)$v);
};
$categoriaStatusMeta  = function (array $u): array {
        return ['icon' => 'fa-check-circle', 'text' => 'Ativo', 'badge' => 'badge-blue'];
    };
?>

<!-- Header -->
<header class="w3-container" style="padding:22px 0 12px 0;">
    <h5 style="margin:0; display:flex; align-items:center; gap:10px; color:#2f3a57">
        <i class="fa fa-tags" aria-hidden="true"></i>
        Painel de Categorias
    </h5>
    <div style="color:#6b7a99; font-size:13px; margin-top:6px">Visão geral e gerenciamento das categorias de produtos</div>
</header>

<!-- Cards de métricas -->
<div class="w3-row-padding w3-margin-bottom">
    <div class="w3-quarter">
        <div class="w3-container w3-padding-16 stat-card bg-blue" title="Total de categorias cadastradas">
            <div class="w3-left"><i class="fa fa-tags w3-xxxlarge" style="color:#fff;"></i></div>
            <div class="w3-right"><h3 style="color:#fff;"><?php echo number_format($total_categorias, 0, ',', '.'); ?></h3></div>
            <div class="w3-clear"></div>
            <h4 class="stat-subtitle" style="color:#E3F2FD">Total de Categorias</h4>
        </div>
    </div>
    <div class="w3-quarter">
        <div class="w3-container w3-padding-16 stat-card bg-green" title="Categorias com status ativo">
            <div class="w3-left"><i class="fa fa-check-circle w3-xxxlarge" style="color:#fff;"></i></div>
            <div class="w3-right"><h3 style="color:#fff;"><?php echo number_format($total_ativos, 0, ',', '.'); ?></h3></div>
            <div class="w3-clear"></div>
            <h4 class="stat-subtitle" style="color:#E8F5E9">Categorias Ativas</h4>
        </div>
    </div>
    <div class="w3-quarter">
        <div class="w3-container w3-padding-16 stat-card bg-orange" title="Categorias com status inativo">
            <div class="w3-left"><i class="fa fa-times-circle w3-xxxlarge" style="color:#fff;"></i></div>
            <div class="w3-right"><h3 style="color:#fff;"><?php echo number_format($total_inativos, 0, ',', '.'); ?></h3></div>
            <div class="w3-clear"></div>
            <h4 class="stat-subtitle" style="color:#FFF3E0">Categorias Inativas</h4>
        </div>
    </div>
    <div class="w3-quarter">
        <div class="w3-container w3-padding-16 stat-card bg-indigo" title="Percentual de categorias ativas">
            <div class="w3-left"><i class="fa fa-percent w3-xxxlarge" style="color:#fff;"></i></div>
            <div class="w3-right"><h3 style="color:#fff;"><?php echo $taxa_ativacao; ?>%</h3></div>
            <div class="w3-clear"></div>
            <h4 class="stat-subtitle" style="color:#E8EAF6">Taxa de Ativação</h4>
        </div>
    </div>
</div>

<div style="display:flex; align-items:center; justify-content:space-between; margin:8px 0 10px 0;">
    <div style="font-weight:700; color:#2f3a57; display:flex; align-items:center; gap:8px">
        <i class="fa fa-list-ul" aria-hidden="true"></i>
        Listar Categorias
    </div>
</div>
<div style="display:flex; justify-content:flex-end; margin-bottom:10px;">
    <a href="/backend/categoria/criar" class="w3-button bg-blue w3-text-white" style="padding:8px 12px; border-radius:8px;">
        <i class="fa fa-plus"></i> Criar Categoria
    </a>
</div>

<?php if (isset($categorias) && is_array($categorias) && count($categorias) > 0): ?>
    <div class="w3-responsive card-table">
        <table class="w3-table w3-striped w3-white">
            <thead class="table-head">
                <tr>
                    <th class="td-tight"><i class="fa fa-hashtag" title="ID" aria-hidden="true"></i> ID</th>
                    <th><i class="fa fa-tag" title="Nome" aria-hidden="true"></i> Nome</th>
                    <th class="td-tight"><i class="fa fa-info-circle" title="Status" aria-hidden="true"></i> Status</th>
                    <th class="td-tight"><i class="fa fa-pencil" title="Editar" aria-hidden="true"></i> Editar</th>
                    <th class="td-tight"><i class="fa fa-trash" title="Excluir" aria-hidden="true"></i> Excluir</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($categorias as $categoria): ?>
                    <?php
                        $id   = htmlspecialchars($categoria['id_categoria']);
                        $nome = htmlspecialchars($categoria['nome']);
                        $st   = $categoriaStatusMeta($categoria);
                    ?>
                    <tr class="table-row">
                        <td class="td-tight"><?php echo $id; ?></td>
                        <td>
                            <i class="fa fa-tag" style="color:#34495e;" aria-hidden="true"></i>
                            <span><?php echo $nome; ?></span>
                        </td>
                        <td class="td-tight">
                            <span class="badge <?php echo $st['badge']; ?>">
                                <i class="fa <?php echo $st['icon']; ?>" aria-hidden="true"></i>
                                <?php echo htmlspecialchars($st['text']); ?>
                            </span>
                        </td>
                        <td class="td-tight">
                            <a class="w3-button action-btn btn-edit" href="/backend/categoria/editar/<?php echo $id; ?>" title="Editar categoria <?php echo $nome; ?>">
                                <i class="fa fa-pencil"></i> Editar
                            </a>
                        </td>
                        <td class="td-tight">
                            <a class="w3-button action-btn btn-delete" href="/backend/categoria/excluir/<?php echo $id; ?>"
                               title="Excluir categoria <?php echo $nome; ?>"
                               onclick="return confirm('Tem certeza que deseja excluir esta categoria?');">
                                <i class="fa fa-trash"></i> Excluir
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Paginação -->
    <?php if (isset($paginacao) && is_array($paginacao)): ?>
        <div class="paginacao-controls" style="display:flex; justify-content:space-between; align-items:center; margin-top:16px;">
            <div class="page-selector pager">
                <?php if ((int)$paginacao['pagina_atual'] > 1): ?>
                    <a class="w3-button w3-light-gray" href="/backend/categoria/listar/<?php echo (int)$paginacao['pagina_atual'] - 1; ?>">
                        <i class="fa fa-chevron-left"></i> Anterior
                    </a>
                <?php else: ?>
                    <span class="w3-button w3-light-gray w3-disabled"><i class="fa fa-chevron-left"></i> Anterior</span>
                <?php endif; ?>

                <span style="margin:0 10px; color:#2f3a57; font-weight:600;">
                    Página <?php echo (int)$paginacao['pagina_atual']; ?> de <?php echo (int)$paginacao['ultima_pagina']; ?>
                </span>

                <?php if ((int)$paginacao['pagina_atual'] < (int)$paginacao['ultima_pagina']): ?>
                    <a class="w3-button w3-light-gray" href="/backend/categoria/listar/<?php echo (int)$paginacao['pagina_atual'] + 1; ?>">
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
        <p style="margin:8px 0;"><i class="fa fa-info-circle"></i> Nenhuma categoria encontrada.</p>
    </div>
<?php endif; ?></div>