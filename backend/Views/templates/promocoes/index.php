<!-- Estilos finos para visual e acessibilidade -->
<style>
    .stat-card { border-radius: 10px; box-shadow: 0 6px 16px rgba(0,0,0,.12); position: relative; overflow: hidden; }
    .stat-card .w3-left { opacity: .9 }
    .stat-card h3 { margin: 0; font-weight: 700; letter-spacing: .5px }
    .stat-subtitle { margin: 6px 0 0; font-weight: 600 }
    .bg-blue    { background: linear-gradient(135deg, #1976D2 0%, #42A5F5 100%) }
    .bg-green   { background: linear-gradient(135deg, #2E7D32 0%, #66BB6A 100%) }
    .bg-orange  { background: linear-gradient(135deg, #EF6C00 0%, #FFA726 100%) }
    .bg-indigo  { background: linear-gradient(135deg, #3949AB 0%, #5C6BC0 100%) }
    .card-table { border-radius: 10px; overflow: hidden; box-shadow: 0 6px 16px rgba(0,0,0,.08); }
    .table-head { background: #f7f9fc; border-bottom: 1px solid #e6ebf1 }
    .table-head th { font-weight: 700; color: #2f3a57; white-space: nowrap }
    .table-row:hover { background: #f9fbff }
    .td-tight { white-space: nowrap }
    .badge { font-size: 12px; padding: 4px 10px; border-radius: 999px; font-weight: 700; display: inline-flex; align-items: center; gap: 6px }
    .badge-blue { background: #E3F2FD; color: #1565C0 }
    .badge-green { background: #E8F5E9; color: #2E7D32 }
    .badge-red { background: #FFEBEE; color: #C62828 }
    .badge-gray { background: #ECEFF1; color: #455A64 }
    .action-btn { border-radius: 8px; padding: 6px 10px; font-weight: 600 }
    .action-btn i { margin-right: 6px }
    .btn-edit { background: #E3F2FD; color: #1565C0 }
    .btn-delete { background: #FFEBEE; color: #C62828 }
    .btn-edit:hover { background: #BBDEFB }
    .btn-delete:hover { background: #FFCDD2 }
    .pager .w3-button { border-radius: 8px; font-weight: 600 }
    .pager .w3-button.w3-disabled { opacity: .5; cursor: not-allowed }
</style>

<!-- Header -->
<header class="w3-container" style="padding:22px 0 12px 0;">
    <h5 style="margin:0; display:flex; align-items:center; gap:10px; color:#2f3a57">
        <i class="fa fa-tags" aria-hidden="true"></i>
        Painel de Promoções
    </h5>
    <div style="color:#6b7a99; font-size:13px; margin-top:6px">Visão geral e gerenciamento das promoções do sistema</div>
</header>

<!-- Cards de métricas Comentadas -->



<!-- <div class="w3-row-padding w3-margin-bottom">
    <div class="w3-quarter">
        <div class="w3-container w3-padding-16 stat-card bg-blue" title="Total de promoções cadastradas">
            <div class="w3-left"><i class="fa fa-tags w3-xxxlarge" style="color:#fff;"></i></div>
            <div class="w3-right"><h3 style="color:#fff;"><?php echo number_format($total_, 0, ',', '.'); ?></h3></div>
            <div class="w3-clear"></div>
            <h4 class="stat-subtitle" style="color:#E3F2FD">Total de Promoções</h4>
        </div>
    </div>
    <div class="w3-quarter">
        <div class="w3-container w3-padding-16 stat-card bg-green" title="Promoções ativas">
            <div class="w3-left"><i class="fa fa-check-circle w3-xxxlarge" style="color:#fff;"></i></div>
            <div class="w3-right"><h3 style="color:#fff;"><?php echo number_format($total_ativos, 0, ',', '.'); ?></h3></div>
            <div class="w3-clear"></div>
            <h4 class="stat-subtitle" style="color:#E8F5E9">Promoções Ativas</h4>
        </div>
    </div>
    <div class="w3-quarter">
        <div class="w3-container w3-padding-16 stat-card bg-orange" title="Promoções inativas">
            <div class="w3-left"><i class="fa fa-times-circle w3-xxxlarge" style="color:#fff;"></i></div>
            <div class="w3-right"><h3 style="color:#fff;"><?php echo number_format($total_inativos, 0, ',', '.'); ?></h3></div>
            <div class="w3-clear"></div>
            <h4 class="stat-subtitle" style="color:#FFF3E0">Promoções Inativas</h4>
        </div>
    </div>
    <div class="w3-quarter"></div>
</div> -->

<!-- Lista -->
<div style="display:flex; align-items:center; justify-content:space-between; margin:8px 0 10px 0;">
    <div style="font-weight:700; color:#2f3a57; display:flex; align-items:center; gap:8px">
        <i class="fa fa-list-alt" aria-hidden="true"></i>
        Listagem de Promoções
    </div>
</div>

<?php if (isset($promocoes) && count($promocoes) > 0): ?>
    <div class="w3-responsive card-table">
        <table class="w3-table w3-striped w3-white">
            <thead class="table-head">
                <tr>
                    <th class="td-tight"><i class="fa fa-hashtag" title="ID"></i> ID</th>
                    <th><i class="fa fa-tag" title="Nome"></i> Nome</th>
                    <th><i class="fa fa-info-circle" title="Descrição"></i> Descrição</th>
                    <th class="td-tight"><i class="fa fa-money" title="Valor"></i> Valor</th>
                    <th class="td-tight"><i class="fa fa-calendar" title="Data de Início"></i> Início</th>
                    <th class="td-tight"><i class="fa fa-calendar" title="Data de Fim"></i> Fim</th>
                    <th class="td-tight"><i class="fa fa-pencil" title="Editar"></i> Editar</th>
                    <th class="td-tight"><i class="fa fa-trash" title="Excluir"></i> Excluir</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($promocoes as $promocao): ?>
                    <tr class="table-row">
                        <td class="td-tight"><?= htmlspecialchars($promocao['promocao_id']) ?></td>
                        <td><?= htmlspecialchars($promocao['nome']) ?></td>
                        <td><?= htmlspecialchars($promocao['descricao']) ?></td>
                        <td class="td-tight"><?= htmlspecialchars($promocao['valor']) ?></td>
                        <td class="td-tight"><?= htmlspecialchars($promocao['data_inicio']) ?></td>
                        <td class="td-tight"><?= htmlspecialchars($promocao['data_fim']) ?></td>
                        <td class="td-tight">
                            <a class="w3-button action-btn btn-edit" href="/backend/promocao/editar/<?= htmlspecialchars($promocao['promocao_id']) ?>" title="Editar promoção">
                                <i class="fa fa-pencil"></i> Editar
                            </a>
                        </td>
                        <td class="td-tight">
                            <a class="w3-button action-btn btn-delete"
                               href="/backend/promocao/excluir/<?= htmlspecialchars($promocao['promocao_id']) ?>"
                               onclick="return confirm('Confirma a exclusão desta promoção?');"
                               title="Excluir promoção">
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
                    <a class="w3-button w3-light-gray" href="/backend/promocao/listar/<?php echo (int)$paginacao['pagina_atual'] - 1; ?>">
                        <i class="fa fa-chevron-left"></i> Anterior
                    </a>
                <?php else: ?>
                    <span class="w3-button w3-light-gray w3-disabled"><i class="fa fa-chevron-left"></i> Anterior</span>
                <?php endif; ?>

                <span style="margin:0 10px; color:#2f3a57; font-weight:600;">
                    Página <?php echo (int)$paginacao['pagina_atual']; ?> de <?php echo (int)$paginacao['ultima_pagina']; ?>
                </span>

                <?php if ((int)$paginacao['pagina_atual'] < (int)$paginacao['ultima_pagina']): ?>
                    <a class="w3-button w3-light-gray" href="/backend/promocao/listar/<?php echo (int)$paginacao['pagina_atual'] + 1; ?>">
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
        <p style="margin:8px 0;"><i class="fa fa-info-circle"></i> Nenhuma promoção encontrada.</p>
    </div>
<?php endif; ?>
