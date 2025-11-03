<?php
// Estilos finos para visual e acessibilidade
?>
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
$total_agendamentos = isset($total) ? (int)$total : 0;
$total_ativos       = isset($total_ativos) ? (int)$total_ativos : 0;
$total_inativos     = isset($total_inativos) ? (int)$total_inativos : 0;
$taxa_ativacao      = $total_agendamentos > 0 ? round(($total_ativos / $total_agendamentos) * 100) : 0;

// Helpers
$toLower = function ($v): string {
    return function_exists('mb_strtolower') ? mb_strtolower((string)$v, 'UTF-8') : strtolower((string)$v);
};
$statusMeta = function ($statusRaw) use ($toLower): array {
    $s = trim($toLower($statusRaw));
    if (in_array($s, ['ativo','confirmado','active','confirmed'], true)) {
        return ['icon' => 'fa-calendar-check-o', 'text' => 'Ativo', 'badge' => 'badge-blue'];
    }
    if (in_array($s, ['pendente','aguardando','pending'], true)) {
        return ['icon' => 'fa-clock-o', 'text' => 'Pendente', 'badge' => 'badge-amber'];
    }
    if (in_array($s, ['cancelado','inativo','cancelled','inactive'], true)) {
        return ['icon' => 'fa-calendar-times-o', 'text' => 'Inativo', 'badge' => 'badge-red'];
    }
    return ['icon' => 'fa-minus-circle', 'text' => 'Indefinido', 'badge' => 'badge-gray'];
};
?>

<!-- Header -->
<header class="w3-container" style="padding:22px 0 12px 0;">
    <h5 style="margin:0; display:flex; align-items:center; gap:10px; color:#2f3a57">
        <i class="fa fa-calendar-check-o" aria-hidden="true"></i>
        Painel de Agendamentos
    </h5>
    <div style="color:#6b7a99; font-size:13px; margin-top:6px">Visão geral e gerenciamento dos agendamentos de clientes</div>
</header>

<!-- Cards de métricas -->
<div class="w3-row-padding w3-margin-bottom">
    <div class="w3-quarter">
        <div class="w3-container w3-padding-16 stat-card bg-blue" title="Total de agendamentos">
            <div class="w3-left"><i class="fa fa-calendar w3-xxxlarge" style="color:#fff;"></i></div>
            <div class="w3-right"><h3 style="color:#fff;"><?php echo number_format($total_agendamentos, 0, ',', '.'); ?></h3></div>
            <div class="w3-clear"></div>
            <h4 class="stat-subtitle" style="color:#E3F2FD">Total de Agendamentos</h4>
        </div>
    </div>
    <div class="w3-quarter">
        <div class="w3-container w3-padding-16 stat-card bg-green" title="Agendamentos ativos">
            <div class="w3-left"><i class="fa fa-calendar-check-o w3-xxxlarge" style="color:#fff;"></i></div>
            <div class="w3-right"><h3 style="color:#fff;"><?php echo number_format($total_ativos, 0, ',', '.'); ?></h3></div>
            <div class="w3-clear"></div>
            <h4 class="stat-subtitle" style="color:#E8F5E9">Agendamentos Ativos</h4>
        </div>
    </div>
    <div class="w3-quarter">
        <div class="w3-container w3-padding-16 stat-card bg-orange" title="Agendamentos inativos/cancelados">
            <div class="w3-left"><i class="fa fa-calendar-times-o w3-xxxlarge" style="color:#fff;"></i></div>
            <div class="w3-right"><h3 style="color:#fff;"><?php echo number_format($total_inativos, 0, ',', '.'); ?></h3></div>
            <div class="w3-clear"></div>
            <h4 class="stat-subtitle" style="color:#FFF3E0">Agendamentos Inativos</h4>
        </div>
    </div>
    <div class="w3-quarter">
        <div class="w3-container w3-padding-16 stat-card bg-indigo" title="Percentual de agendamentos ativos">
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
        Listagem de Agendamentos
    </div>
</div>

<?php if (isset($agendamentos) && is_array($agendamentos) && count($agendamentos) > 0): ?>
    <div class="w3-responsive card-table">
        <table class="w3-table w3-striped w3-white">
            <thead class="table-head">
                <tr>
                    <th class="td-tight"><i class="fa fa-hashtag" title="ID" aria-hidden="true"></i> ID</th>
                    <th class="td-tight"><i class="fa fa-user" title="Cliente ID" aria-hidden="true"></i> Cliente ID</th>
                    <th><i class="fa fa-user-circle" title="Nome" aria-hidden="true"></i> Nome</th>
                    <th class="td-tight"><i class="fa fa-phone" title="Telefone" aria-hidden="true"></i> Telefone</th>
                    <th class="td-tight"><i class="fa fa-clock-o" title="Início" aria-hidden="true"></i> Início</th>
                    <th class="td-tight"><i class="fa fa-cutlery" title="Mesa" aria-hidden="true"></i> Mesa</th>
                    <th class="td-tight"><i class="fa fa-info-circle" title="Status" aria-hidden="true"></i> Status</th>
                    <th class="td-tight"><i class="fa fa-pencil" title="Editar" aria-hidden="true"></i> Editar</th>
                    <th class="td-tight"><i class="fa fa-trash" title="Excluir" aria-hidden="true"></i> Excluir</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($agendamentos as $agendamento): ?>
                    <?php
                        $id        = htmlspecialchars($agendamento['agendamento_id']);
                        $usuarioId = htmlspecialchars($agendamento['usuario_id']);
                        $nome      = htmlspecialchars($agendamento['nome']);
                        $telefone  = htmlspecialchars($agendamento['telefone']);
                        $inicio    = htmlspecialchars($agendamento['data_hora_inicio']);
                        $mesaId    = htmlspecialchars($agendamento['mesa_id']);
                        $statusRaw = isset($agendamento['status']) ? $agendamento['status'] : '';
                        $st        = $statusMeta($statusRaw);
                    ?>
                    <tr class="table-row">
                        <td class="td-tight"><?php echo $id; ?></td>
                        <td class="td-tight"><?php echo $usuarioId; ?></td>
                        <td>
                            <i class="fa fa-user-circle" style="color:#34495e;" aria-hidden="true"></i>
                            <span><?php echo $nome !== '' ? $nome : '<span style="color:#9aa7bd">—</span>'; ?></span>
                        </td>
                        <td class="td-tight">
                            <?php if ($telefone !== ''): ?>
                                <a href="tel:<?php echo htmlspecialchars(preg_replace('/\D+/', '', $telefone)); ?>" class="w3-text-green" title="Ligar para <?php echo $telefone; ?>">
                                    <i class="fa fa-phone" aria-hidden="true"></i> <?php echo $telefone; ?>
                                </a>
                            <?php else: ?>
                                <span style="color:#9aa7bd"><i class="fa fa-phone-square"></i> —</span>
                            <?php endif; ?>
                        </td>
                        <td class="td-tight">
                            <i class="fa fa-clock-o" aria-hidden="true"></i>
                            <span><?php echo $inicio !== '' ? $inicio : '<span style="color:#9aa7bd">—</span>'; ?></span>
                        </td>
                        <td class="td-tight">
                            <i class="fa fa-cutlery" aria-hidden="true"></i>
                            <span><?php echo $mesaId !== '' ? $mesaId : '<span style="color:#9aa7bd">—</span>'; ?></span>
                        </td>
                        <td class="td-tight">
                            <span class="badge <?php echo $st['badge']; ?>">
                                <i class="fa <?php echo $st['icon']; ?>" aria-hidden="true"></i>
                                <?php echo htmlspecialchars($st['text']); ?>
                            </span>
                        </td>
                        <td class="td-tight">
                            <a class="w3-button action-btn btn-edit" href="/backend/agendamento/editar/<?php echo $id; ?>" title="Editar agendamento #<?php echo $id; ?>">
                                <i class="fa fa-pencil" aria-hidden="true"></i> Editar
                            </a>
                        </td>
                       <td class="td-tight">
                           <button class="w3-button action-btn btn-delete" data-id="<?php echo $id; ?>" id="botaoExcluir" onclick="SoftDelete(<?php echo htmlspecialchars($id); ?>)">EXCLUIR</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <?php if (isset($paginacao) && is_array($paginacao)): ?>
        <div class="paginacao-controls" style="display:flex; justify-content:space-between; align-items:center; margin-top:16px;">
            <div class="page-selector pager">
                <?php $pagAtual = (int)$paginacao['pagina_atual']; $ultima = (int)$paginacao['ultima_pagina']; ?>
                <?php if ($pagAtual > 1): ?>
                    <a class="w3-button w3-light-gray" href="/backend/agendamento/listar/<?php echo $pagAtual - 1; ?>">
                        <i class="fa fa-chevron-left"></i> Anterior
                    </a>
                <?php else: ?>
                    <span class="w3-button w3-light-gray w3-disabled"><i class="fa fa-chevron-left"></i> Anterior</span>
                <?php endif; ?>

                <span style="margin:0 10px; color:#2f3a57; font-weight:600;">
                    Página <?php echo $pagAtual; ?> de <?php echo $ultima; ?>
                </span>

                <?php if ($pagAtual < $ultima): ?>
                    <a class="w3-button w3-light-gray" href="/backend/agendamento/listar/<?php echo $pagAtual + 1; ?>">
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
        <p style="margin:8px 0;"><i class="fa fa-info-circle"></i> Nenhum agendamento encontrado.</p>
    </div>
<?php endif; ?>


<script>
     function SoftDelete(id) {
      const data = JSON.stringify({
         id: id
      });

      const xhr = new XMLHttpRequest();
      xhr.withCredentials = true;

      xhr.addEventListener('readystatechange', function() {
      });

      xhr.open('POST', '/backend/agendamento/deletar');
      xhr.setRequestHeader('Content-Type', 'application/json');
      console.log(data)

      Swal.fire({
         title: "Você tem certeza?",
         text: "Você não poderá reverter isso!",
         icon: "warning",
         showCancelButton: true,
         confirmButtonColor: "#3085d6",
         cancelButtonColor: "#d33",
         confirmButtonText: "Sim, Deletar Agendamento!"
      }).then((result) => {
         if (result.isConfirmed) {
            if (this.readyState === this.DONE) {
             xhr.send(data);
            Swal.fire({
               title: "Deletado!",
               text: "Seu agendamento está sendo deletado.",
               icon: "success"
            });
               location.reload()
         }
         }
      });
   }

</script>