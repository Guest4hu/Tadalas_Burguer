<!-- ====== ESTILO ====== -->
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Painel Administrativo</title>
    <link rel="stylesheet" href="/backend/assets/css/style.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>

<style>
    .stat-card {
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0,0,0,.1);
        color: #fff;
        position: relative;
        overflow: hidden;
    }
    .stat-card i {
        opacity: 0.9;
    }
    .stat-card h3 {
        font-weight: 700;
        margin: 0;
    }
    .stat-subtitle {
        margin: 4px 0 0;
        font-weight: 600;
        opacity: 0.9;
    }

    .bg-blue    { background: linear-gradient(135deg,#1976D2,#42A5F5); }
    .bg-green   { background: linear-gradient(135deg,#2E7D32,#66BB6A); }
    .bg-orange  { background: linear-gradient(135deg,#EF6C00,#FFA726); }
    .bg-purple  { background: linear-gradient(135deg,#6A1B9A,#BA68C8); }

    .table-container {
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 6px 16px rgba(0,0,0,.08);
    }
    thead {
        background: #f9fafc;
    }
    thead th {
        font-weight: 700;
        color: #2f3a57;
        white-space: nowrap;
    }
    tbody tr:hover {
        background: #f3f6ff;
    }
    .badge {
        padding: 5px 10px;
        border-radius: 30px;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-size: 13px;
    }
    .badge-blue { background: #E3F2FD; color: #1565C0; }
    .badge-red { background: #FFEBEE; color: #C62828; }

    .action-btn {
        border-radius: 6px;
        padding: 6px 10px;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }
    .btn-view { background: #E8EAF6; color: #283593; }
    .btn-edit { background: #E3F2FD; color: #1565C0; }
    .btn-delete { background: #FFEBEE; color: #C62828; }

    .btn-view:hover { background: #C5CAE9; }
    .btn-edit:hover { background: #BBDEFB; }
    .btn-delete:hover { background: #FFCDD2; }

    .heading-bar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin: 15px 0 10px;
    }
    .heading-bar h4 {
        margin: 0;
        font-weight: 700;
        color: #2f3a57;
        display: flex;
        align-items: center;
        gap: 8px;
    }
</style>

<?php
$total_enderecos = $total_Enderecos ?? 0;
$total_ativos = $total_ativos ?? 0;
$total_inativos = $total_inativos ?? 0;
$taxa_ativacao = $total_enderecos > 0 ? round(($total_ativos / $total_enderecos) * 100) : 0;

$enderecoStatus = function ($e) {
    if (!empty($e['excluido_em'])) {
        return ['texto' => 'Inativo', 'classe' => 'badge-red', 'icone' => 'fa-solid fa-xmark-circle'];
    }
    return ['texto' => 'Ativo', 'classe' => 'badge-blue', 'icone' => 'fa-solid fa-check-circle'];
};
?>

<!-- ====== CABEÇALHO ====== -->
<header class="w3-container" style="padding:22px 0 12px 0;">
    <h5 style="margin:0; display:flex; align-items:center; gap:10px; color:#2f3a57">
        <i class="fa-solid fa-map-location-dot"></i> Gerenciamento de Endereços
    </h5>
    <div style="color:#6b7a99; font-size:13px; margin-top:6px">
        Acompanhe, edite e mantenha todos os endereços cadastrados no sistema
    </div>
</header>

<!-- ====== MÉTRICAS ====== -->
<div class="w3-row-padding w3-margin-bottom">
    <div class="w3-quarter">
        <div class="w3-container w3-padding-16 stat-card bg-blue">
            <div class="w3-left"><i class="fa-solid fa-map-location-dot w3-xxxlarge"></i></div>
            <div class="w3-right"><h3><?= $total_enderecos ?></h3></div>
            <div class="w3-clear"></div>
            <span class="stat-subtitle">Total de Endereços</span>
        </div>
    </div>

    <div class="w3-quarter">
        <div class="w3-container w3-padding-16 stat-card bg-green">
            <div class="w3-left"><i class="fa-solid fa-house-user w3-xxxlarge"></i></div>
            <div class="w3-right"><h3><?= $total_ativos ?></h3></div>
            <div class="w3-clear"></div>
            <span class="stat-subtitle">Ativos</span>
        </div>
    </div>

    <div class="w3-quarter">
        <div class="w3-container w3-padding-16 stat-card bg-orange">
            <div class="w3-left"><i class="fa-solid fa-ban w3-xxxlarge"></i></div>
            <div class="w3-right"><h3><?= $total_inativos ?></h3></div>
            <div class="w3-clear"></div>
            <span class="stat-subtitle">Inativos</span>
        </div>
    </div>

    <div class="w3-quarter">
        <div class="w3-container w3-padding-16 stat-card bg-purple">
            <div class="w3-left"><i class="fa-solid fa-percent w3-xxxlarge"></i></div>
            <div class="w3-right"><h3><?= $taxa_ativacao ?>%</h3></div>
            <div class="w3-clear"></div>
            <span class="stat-subtitle">Taxa de Ativação</span>
        </div>
    </div>
</div>

<!-- ====== LISTAGEM ====== -->
<div class="heading-bar">
    <h4><i class="fa-solid fa-list"></i> Listagem de Endereços</h4>
    <a href="endereco/criar/" class="w3-button w3-blue w3-round">
        <i class="fa-solid fa-plus"></i> Novo Endereço
    </a>
</div>

<?php if (!empty($enderecos)): ?>
<div class="w3-responsive table-container">
    <table class="w3-table w3-striped w3-white">
        <thead>
            <tr>
                <th><i class="fa-solid fa-hashtag"></i> ID</th>
                <th><i class="fa-solid fa-user"></i> Usuário</th>
                <th><i class="fa-solid fa-road"></i> Rua</th>
                <th><i class="fa-solid fa-building"></i> Nº</th>
                <th><i class="fa-solid fa-map"></i> Bairro</th>
                <th><i class="fa-solid fa-city"></i> Cidade</th>
                <th><i class="fa-solid fa-flag"></i> Estado</th>
                <th><i class="fa-solid fa-envelope"></i> CEP</th>
                <th><i class="fa-solid fa-signal"></i> Status</th>
                <th><i class="fa-solid fa-gear"></i> Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($enderecos as $e): ?>
                <?php
                $status = $enderecoStatus($e);
                $id = htmlspecialchars($e['endereco_id'] ?? $e['id'] ?? '');
                ?>
                <tr>
                    <td><?= $id ?></td>
                    <td><?= htmlspecialchars($e['usuario_id'] ?? '—') ?></td>
                    <td><?= htmlspecialchars($e['rua'] ?? '—') ?></td>
                    <td><?= htmlspecialchars($e['numero'] ?? '—') ?></td>
                    <td><?= htmlspecialchars($e['bairro'] ?? '—') ?></td>
                    <td><?= htmlspecialchars($e['cidade'] ?? '—') ?></td>
                    <td><?= htmlspecialchars($e['estado'] ?? '—') ?></td>
                    <td><?= htmlspecialchars($e['cep'] ?? '—') ?></td>
                    <td>
                        <span class="badge <?= $status['classe'] ?>">
                            <i class="<?= $status['icone'] ?>"></i> <?= $status['texto'] ?>
                        </span>
                    </td>
                    <td>
                        <a href="/backend/endereco/mostrar/<?= $id ?>" class="action-btn btn-view">
                            <i class="fa-solid fa-eye"></i> Ver
                        </a>
                        <a href="/backend/endereco/editar/<?= $id ?>" class="action-btn btn-edit">
                            <i class="fa-solid fa-pen-to-square"></i> Editar
                        </a>
                        <a href="/backend/endereco/deletar/<?= $id ?>" class="action-btn btn-delete"
                           onclick="return confirm('Deseja realmente excluir este endereço?');">
                            <i class="fa-solid fa-trash"></i> Excluir
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php else: ?>
    <div class="w3-panel w3-pale-blue w3-leftbar w3-border-blue" style="border-radius:8px;">
        <p><i class="fa-solid fa-info-circle"></i> Nenhum endereço encontrado.</p>
    </div>
<?php endif; ?>
