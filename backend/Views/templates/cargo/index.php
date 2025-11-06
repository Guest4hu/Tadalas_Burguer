<!-- Estilos refinados para visual e acessibilidade -->
<style>
    /* Cartões de métricas */
    .stat-card { border-radius: 10px; box-shadow: 0 6px 16px rgba(0,0,0,.12); position: relative; overflow: hidden; }
    .stat-card .w3-left { opacity: .9 }
    .stat-card h3 { margin: 0; font-weight: 700; letter-spacing: .5px }
    .stat-subtitle { margin: 6px 0 0; font-weight: 600 }

    .bg-red     { background: linear-gradient(135deg, #C62828 0%, #EF5350 100%) }
    .bg-blue    { background: linear-gradient(135deg, #1976D2 0%, #42A5F5 100%) }
    .bg-teal    { background: linear-gradient(135deg, #00897B 0%, #4DB6AC 100%) }
    .bg-orange  { background: linear-gradient(135deg, #EF6C00 0%, #FFA726 100%) }

    /* Tabela */
    .card-table { border-radius: 10px; overflow: hidden; box-shadow: 0 6px 16px rgba(0,0,0,.08); }
    .table-head { background: #f7f9fc; border-bottom: 1px solid #e6ebf1 }
    .table-head th { font-weight: 700; color: #2f3a57; white-space: nowrap }
    .table-row:hover { background: #f9fbff }
    .td-tight { white-space: nowrap }
    .badge { font-size: 12px; padding: 4px 10px; border-radius: 999px; font-weight: 700; display: inline-flex; align-items: center; gap: 6px }
    .badge i { font-size: 12px }
    .badge-blue { background: #E3F2FD; color: #1565C0 }
    .badge-orange { background: #FFF3E0; color: #EF6C00 }
    .badge-teal { background: #E0F2F1; color: #00897B }
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
    $total        = isset($total)        ? (int)$total        : 0;
    $total_ativos = isset($total_ativos) ? (int)$total_ativos : 0;
    $total_inativos = isset($total_inativos) ? (int)$total_inativos : 0;
    $taxa_ativacao = $total > 0 ? round(($total_ativos / $total) * 100) : 0;

    // Badge e ícone para status
    $cargoStatusMeta = function ($ativo) {
        if ($ativo) {
            return ['badge' => 'badge-teal', 'icon' => 'fa-check-circle', 'text' => 'Ativo'];
        }
        return ['badge' => 'badge-orange', 'icon' => 'fa-times-circle', 'text' => 'Inativo'];
    };
?>

<!-- Header -->
<header class="w3-container" style="padding:22px 0 12px 0;">
    <h5 style="margin:0; display:flex; align-items:center; gap:10px; color:#2f3a57">
        <i class="fa fa-briefcase" aria-hidden="true"></i>
        Painel de Cargos
    </h5>
    <div style="color:#6b7a99; font-size:13px; margin-top:6px">Visão geral e gerenciamento dos cargos do sistema</div>
</header>

<!-- Cards de métricas -->
<div class="w3-row-padding w3-margin-bottom">
    <div class="w3-quarter">
        <div class="w3-container w3-padding-16 stat-card bg-red" title="Total de cargos cadastrados">
            <div class="w3-left"><i class="fa fa-briefcase w3-xxxlarge" style="color:#fff;"></i></div>
            <div class="w3-right"><h3 style="color:#fff;"><?php echo number_format($total, 0, ',', '.'); ?></h3></div>
            <div class="w3-clear"></div>
            <h4 class="stat-subtitle" style="color:#FFEBEE">Total de Cargos</h4>
        </div>
    </div>
    <div class="w3-quarter">
        <div class="w3-container w3-padding-16 stat-card bg-blue" title="Cargos ativos">
            <div class="w3-left"><i class="fa fa-check-circle w3-xxxlarge" style="color:#fff;"></i></div>
            <div class="w3-right"><h3 style="color:#fff;"><?php echo number_format($total_ativos, 0, ',', '.'); ?></h3></div>
            <div class="w3-clear"></div>
            <h4 class="stat-subtitle" style="color:#E3F2FD">Cargos Ativos</h4>
        </div>
    </div>
    <div class="w3-quarter">
        <div class="w3-container w3-padding-16 stat-card bg-teal" title="Cargos inativos">
            <div class="w3-left"><i class="fa fa-times-circle w3-xxxlarge" style="color:#fff;"></i></div>
            <div class="w3-right"><h3 style="color:#fff;"><?php echo number_format($total_inativos, 0, ',', '.'); ?></h3></div>
            <div class="w3-clear"></div>
            <h4 class="stat-subtitle" style="color:#E0F2F1">Cargos Inativos</h4>
        </div>
    </div>
    <div class="w3-quarter">
        <div class="w3-container w3-padding-16 stat-card bg-orange" title="Percentual de cargos ativos">
            <div class="w3-left"><i class="fa fa-percent w3-xxxlarge" style="color:#fff;"></i></div>
            <div class="w3-right"><h3 style="color:#fff;"><?php echo $taxa_ativacao; ?>%</h3></div>
            <div class="w3-clear"></div>
            <h4 class="stat-subtitle" style="color:#FFF3E0">Taxa de Ativação</h4>
        </div>
    </div>
</div>

<!-- Lista -->
<div style="display:flex; align-items:center; justify-content:space-between; margin:8px 0 10px 0;">
    <div style="font-weight:700; color:#2f3a57; display:flex; align-items:center; gap:8px">
        <i class="fa fa-list-alt" aria-hidden="true"></i>
        Listagem de Cargos
    </div>
</div>
<div style="display:flex; justify-content:flex-end; margin-bottom:10px;">
    <a href="/backend/cargo/criar" class="w3-button bg-blue w3-text-white" style="padding:8px 12px; border-radius:8px;">
        <i class="fa fa-plus"></i> Criar Cargo
    </a>
</div>
<?php if (isset($cargos) && is_array($cargos) && count($cargos) > 0): ?>
    <div class="w3-responsive card-table">
        <table class="w3-table w3-striped w3-white">
            <thead class="table-head">
                <tr>
                    <th class="td-tight"><i class="fa fa-hashtag" title="ID" aria-hidden="true"></i> ID</th>
                    <th><i class="fa fa-briefcase" title="Cargo" aria-hidden="true"></i> Cargo</th>
                    <th class="td-tight"><i class="fa fa-info-circle" title="Status" aria-hidden="true"></i> Status</th>
                    <th class="td-tight"><i class="fa fa-pencil" title="Editar" aria-hidden="true"></i> Editar</th>
                    <th class="td-tight"><i class="fa fa-trash" title="Excluir" aria-hidden="true"></i> Excluir</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($cargos as $cargo): ?>
                    <?php
                        $id = htmlspecialchars($cargo['id']);
                        $descricao = htmlspecialchars($cargo['cargo_descricao']);
                        $ativo = isset($cargo['ativo']) ? (bool)$cargo['ativo'] : true; // Ajuste conforme seu dataset
                        $statusMeta = $cargoStatusMeta($ativo);
                    ?>
                    <tr class="table-row">
                        <td class="td-tight"><?php echo $id; ?></td>
                        <td>
                            <i class="fa fa-briefcase" style="color:#34495e;" aria-hidden="true"></i>
                            <span><?php echo $descricao !== '' ? $descricao : '<span style="color:#9aa7bd">—</span>'; ?></span>
                        </td>
                        <td class="td-tight">
                            <span class="badge <?php echo $statusMeta['badge']; ?>">
                                <i class="fa <?php echo $statusMeta['icon']; ?>" aria-hidden="true"></i>
                                <?php echo htmlspecialchars($statusMeta['text']); ?>
                            </span>
                        </td>
                        <td class="td-tight">
                            <a class="w3-button action-btn btn-edit" href="/backend/cargo/editar/<?php echo $id; ?>" title="Editar cargo <?php echo $descricao !== '' ? $descricao : $id; ?>">
                                <i class="fa fa-pencil" aria-hidden="true"></i> Editar
                            </a>
                        </td>
                      <td class="td-tight">
                           <button class="w3-button action-btn btn-delete" data-id="<?php echo $id; ?>" id="botaoExcluir" onclick="SoftDelete(<?php echo htmlspecialchars($id); ?>)">EXCLUIR</button>
                        </td>
                    </tr>
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
                    <a class="w3-button w3-light-gray" href="/backend/cargo/listar/<?php echo (int)$paginacao['pagina_atual'] - 1; ?>">
                        <i class="fa fa-chevron-left"></i> Anterior
                    </a>
                <?php else: ?>
                    <span class="w3-button w3-light-gray w3-disabled"><i class="fa fa-chevron-left"></i> Anterior</span>
                <?php endif; ?>

                <span style="margin:0 10px; color:#2f3a57; font-weight:600;">
                    Página <?php echo (int)$paginacao['pagina_atual']; ?> de <?php echo (int)$paginacao['ultima_pagina']; ?>
                </span>

                <?php if ((int)$paginacao['pagina_atual'] < (int)$paginacao['ultima_pagina']): ?>
                    <a class="w3-button w3-light-gray" href="/backend/cargo/listar/<?php echo (int)$paginacao['pagina_atual'] + 1; ?>">
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
        <p style="margin:8px 0;"><i class="fa fa-info-circle"></i> Nenhum cargo encontrado.</p>
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

      xhr.open('POST', '/backend/cargo/deletar');
      xhr.setRequestHeader('Content-Type', 'application/json');
      console.log(data)

      Swal.fire({
         title: "Você tem certeza?",
         text: "Você não poderá reverter isso!",
         icon: "warning",
         showCancelButton: true,
         confirmButtonColor: "#3085d6",
         cancelButtonColor: "#d33",
         confirmButtonText: "Sim, Deletar Cargo!"
      }).then((result) => {
         if (result.isConfirmed) {
            if (this.readyState === this.DONE) {
             xhr.send(data);
            Swal.fire({
               title: "Deletado!",
               text: "Seu cargo está sendo deletado.",
               icon: "success"
            });
             location.reload()
         }
         }
      });
   }

</script>