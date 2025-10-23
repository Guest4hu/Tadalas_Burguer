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
    $total_status  = isset($total_) ? (int)$total_ : 0;
    $total_ativos  = isset($total_ativos) ? (int)$total_ativos : 0;
    $total_inativos= isset($total_inativos) ? (int)$total_inativos : 0;
    $taxa_ativacao = $total_status > 0 ? round(($total_ativos / $total_status) * 100) : 0;

    // Helpers
    $toLower = function ($v): string {
        return function_exists('mb_strtolower') ? mb_strtolower((string)$v, 'UTF-8') : strtolower((string)$v);
    };

    // Meta visual do "tipo de status" (mapeia descrição -> badge + ícone + texto)
    $statusTipoMeta = function ($descricao) use ($toLower): array {
        $raw = trim((string)($descricao ?? ''));
        $d = $toLower($raw);

        if (in_array($d, ['ativo','em atividade','ativa','active','ativado'])) {
            return ['badge' => 'badge-blue',  'icon' => 'fa-check-circle',       'text' => 'Ativo'];
        }
        if (in_array($d, ['inativo','inactive','parado','desativado','inativa'])) {
            return ['badge' => 'badge-red',   'icon' => 'fa-times-circle',       'text' => 'Inativo'];
        }
        if (in_array($d, ['ferias','férias'])) {
            return ['badge' => 'badge-amber', 'icon' => 'fa-sun-o',              'text' => 'Férias'];
        }
        if (in_array($d, ['afastado','licenca','licença'])) {
            return ['badge' => 'badge-gray',  'icon' => 'fa-bed',                'text' => 'Afastado'];
        }
        if (in_array($d, ['suspenso','suspensão','suspensao'])) {
            return ['badge' => 'badge-amber', 'icon' => 'fa-exclamation-triangle','text' => 'Suspenso'];
        }
        if (in_array($d, ['demitido','desligado'])) {
            return ['badge' => 'badge-red',   'icon' => 'fa-user-times',         'text' => 'Demitido'];
        }
        if (in_array($d, ['contratado','admitido'])) {
            return ['badge' => 'badge-blue',  'icon' => 'fa-user-plus',          'text' => 'Contratado'];
        }
        if (in_array($d, ['treinamento','capacitação','capacitacao'])) {
            return ['badge' => 'badge-amber', 'icon' => 'fa-graduation-cap',     'text' => 'Treinamento'];
        }

        // Padrão
        return ['badge' => 'badge-gray', 'icon' => 'fa-tag', 'text' => ($raw !== '' ? $raw : 'Indefinido')];
    };
?>

<!-- Header -->
<header class="w3-container" style="padding:22px 0 12px 0;">
    <h5 style="margin:0; display:flex; align-items:center; gap:10px; color:#2f3a57">
        <i class="fa fa-id-badge" aria-hidden="true"></i>
        Status dos Funcionários
    </h5>
    <div style="color:#6b7a99; font-size:13px; margin-top:6px">Visão geral e gerenciamento dos status de funcionários</div>
</header>

 <div class="w3-row-padding w3-margin-bottom">
     <div class="w3-quarter">
         <div class="w3-container w3-blue w3-padding-16">
             <div class="w3-left"><i class="fa fa-users w3-xxxlarge" style="color: white;"></i></div>
             <div class="w3-right">
                 <h3><?php echo $total_; ?></h3>
             </div>
             <div class="w3-clear"></div>
             <h4>Total de Status de Funcionários</h4>
         </div>
     </div>
     <div class="w3-quarter">
         <div class="w3-container w3-green w3-padding-16">
             <div class="w3-left"><i class="fa fa-user-circle-o w3-xxxlarge" style="color: green;"></i></div>
             <div class="w3-right">
                 <h3><?php echo $total_ativos; ?></h3>
             </div>
             <div class="w3-clear"></div>
             <h4>Status de Funcionários Ativos</h4>
         </div>
     </div>
     <div class="w3-quarter">
         <div class="w3-container w3-orange w3-padding-16">
             <div class="w3-left"><i class="fa fa-user-times w3-xxxlarge" style="color: red;"></i></div>
             <div class="w3-right">
                 <h3><?php echo $total_inativos; ?></h3>
             </div>
             <div class="w3-clear"></div>
             <h4>Status de Funcionários Inativos</h4>
         </div>
     </div>
     <div class="w3-quarter">
     </div>
 </div>
 
<div>Listar Status Funcionário</div>
<?php if (isset($statusFuncionarios) && count($statusFuncionarios) > 0): ?>
    <table border="1" cellpadding="5" cellspacing="0" class="w3-table w3-striped w3-white">
        <thead>
            <tr>
                <th>ID</th>
                <th>Status</th>
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

                <span style="margin:0 10px; color:#2f3a57; font-weight:600;">
                    Página <?php echo $pagAtual; ?> de <?php echo $pagUlt; ?>
                </span>

                <?php if ($pagAtual < $pagUlt): ?>
                    <a class="w3-button w3-light-gray" href="/backend/statusFuncionario/listar/<?php echo $next; ?>">
                        Próximo <i class="fa fa-chevron-right"></i>
                    </a>
                <?php else: ?>
                    <span class="w3-button w3-light-gray w3-disabled">Próximo <i class="fa fa-chevron-right"></i></span>
                <?php endif; ?>
            </div>
        </div>
<?php else: ?>
    <div class="w3-panel w3-pale-blue w3-leftbar w3-border-blue" style="border-radius:8px;">
        <p style="margin:8px 0;">
            <i class="fa fa-info-circle" aria-hidden="true"></i>
            Nenhum status de funcionário encontrado.
        </p>
    </div>
<?php endif; ?></div>
