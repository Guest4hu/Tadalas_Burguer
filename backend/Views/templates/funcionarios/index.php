<style>
    .page-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 2.5rem;
        padding-bottom: 1.5rem;
        border-bottom: 1px solid var(--border-color);
        flex-wrap: wrap;
        gap: 1rem;
    }
    .page-title {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        font-size: 1.75rem;
        font-weight: 700;
        margin-bottom: 0.25rem;
    }
    .page-title i { color: var(--accent-red); }
    .page-subtitle {
        color: var(--text-secondary);
        font-size: 0.875rem;
        font-weight: 400;
    }

    /* Stats Grid */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2.5rem;
    }
    .stat-card {
        background: var(--gradient-card);
        border-radius: 16px;
        padding: 1.75rem;
        box-shadow: var(--shadow-md);
        border: 1px solid var(--border-color);
        position: relative;
        overflow: hidden;
        transition: all 0.3s ease;
        animation: fadeInUp 0.6s ease-out backwards;
    }
    .stat-card::before {
        content: '';
        position: absolute;
        top: 0; left: 0;
        width: 100%; height: 4px;
        background: linear-gradient(90deg, var(--accent-red), var(--accent-gold));
    }
    .stat-card:hover {
        transform: translateY(-4px);
        box-shadow: var(--shadow-lg);
        border-color: var(--accent-red);
    }
    .stat-card:nth-child(1) { animation-delay: 0.1s; }
    .stat-card:nth-child(2) { animation-delay: 0.2s; }
    .stat-card:nth-child(3) { animation-delay: 0.3s; }
    .stat-card:nth-child(4) { animation-delay: 0.4s; }
    .stat-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 1rem;
    }
    .stat-icon {
        width: 56px; height: 56px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        background: var(--accent-red-light);
        color: var(--accent-red);
    }
    .stat-value {
        font-size: 2.5rem;
        font-weight: 800;
        line-height: 1;
        margin-bottom: 0.5rem;
    }
    .stat-label {
        color: var(--text-secondary);
        font-size: 0.875rem;
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    /* Section Header */
    .section-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.5rem;
        flex-wrap: wrap;
        gap: 1rem;
    }
    .section-title {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        font-size: 1.25rem;
        font-weight: 700;
    }
    .section-title i { color: var(--accent-gold); }

    /* Buttons */
    .btn {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.75rem 1.5rem;
        border-radius: 10px;
        font-weight: 600;
        font-size: 0.9375rem;
        text-decoration: none;
        border: none;
        cursor: pointer;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }
    .btn-primary {
        background: var(--accent-red);
        color: var(--text-primary);
        box-shadow: 0 4px 16px rgba(229, 57, 53, 0.3);
    }
    .btn-primary:hover {
        background: var(--accent-red-hover);
        box-shadow: 0 6px 24px rgba(229, 57, 53, 0.5);
        transform: translateY(-2px);
    }
    .btn-secondary {
        background: var(--bg-card);
        color: var(--text-primary);
        border: 1px solid var(--border-color);
    }
    .btn-secondary:hover {
        background: var(--bg-card-hover);
        border-color: var(--accent-red);
    }

    /* Table Card */
    .table-card {
        background: var(--gradient-card);
        border-radius: 16px;
        box-shadow: var(--shadow-md);
        border: 1px solid var(--border-color);
        overflow: hidden;
        animation: fadeInUp 0.6s ease-out 0.5s backwards;
    }
    .table-wrapper { overflow-x: auto; }
    table { width: 100%; border-collapse: collapse; }
    thead {
        background: rgba(229, 57, 53, 0.08);
        border-bottom: 2px solid var(--accent-red);
    }
    thead th {
        padding: 1.25rem 1rem;
        text-align: left;
        font-weight: 700;
        font-size: 0.875rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: var(--text-primary);
        white-space: nowrap;
    }
    thead th i { margin-right: 0.5rem; color: var(--accent-gold); }
    tbody tr {
        border-bottom: 1px solid var(--border-color);
        transition: all 0.3s ease;
    }
    tbody tr:hover { background: rgba(229, 57, 53, 0.05); }
    tbody td {
        padding: 1.25rem 1rem;
        color: var(--text-secondary);
        font-size: 0.9375rem;
    }
    tbody td:first-child {
        font-weight: 700;
        color: var(--text-primary);
    }

    /* Badge */
    .badge {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.5rem 1rem;
        border-radius: 50px;
        font-size: 0.8125rem;
        font-weight: 600;
        white-space: nowrap;
    }
    .badge-ativo {
        background: rgba(76, 175, 80, 0.15);
        color: #4CAF50;
        border: 1px solid rgba(76, 175, 80, 0.3);
    }
    .badge-inativo {
        background: rgba(229, 57, 53, 0.15);
        color: var(--accent-red);
        border: 1px solid rgba(229, 57, 53, 0.3);
    }
    .badge-outro {
        background: rgba(255, 193, 7, 0.15);
        color: var(--accent-gold);
        border: 1px solid rgba(255, 193, 7, 0.3);
    }

    /* Salary */
    .salary-tag {
        color: #4CAF50;
        font-weight: 700;
    }

    /* Email link */
    .email-link {
        color: #2196F3;
        text-decoration: none;
        transition: color 0.2s;
    }
    .email-link:hover {
        color: #64B5F6;
        text-decoration: underline;
    }

    /* Action Buttons */
    .action-buttons { display: flex; gap: 0.5rem; }
    .btn-action {
        padding: 0.5rem 1rem;
        border-radius: 8px;
        font-size: 0.8125rem;
        font-weight: 600;
        border: none;
        cursor: pointer;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        text-decoration: none;
    }
    .btn-edit {
        background: rgba(33, 150, 243, 0.15);
        color: #2196F3;
        border: 1px solid rgba(33, 150, 243, 0.3);
    }
    .btn-edit:hover {
        background: rgba(33, 150, 243, 0.25);
        transform: translateY(-1px);
    }
    .btn-delete {
        background: rgba(229, 57, 53, 0.15);
        color: var(--accent-red);
        border: 1px solid rgba(229, 57, 53, 0.3);
    }
    .btn-delete:hover {
        background: rgba(229, 57, 53, 0.25);
        transform: translateY(-1px);
    }

    /* Pagination */
    .pagination {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 1.5rem;
        border-top: 1px solid var(--border-color);
        flex-wrap: wrap;
        gap: 1rem;
    }
    .pagination-info {
        color: var(--text-secondary);
        font-weight: 600;
    }
    .pagination-controls { display: flex; gap: 0.75rem; }

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 3rem;
        color: var(--text-secondary);
    }
    .empty-state i {
        font-size: 2rem;
        display: block;
        margin-bottom: 1rem;
        color: var(--accent-red);
    }

    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    @media (max-width: 768px) {
        .page-header { flex-direction: column; align-items: flex-start; }
        .stats-grid { grid-template-columns: 1fr; }
        .section-header { flex-direction: column; align-items: flex-start; }
        .pagination { flex-direction: column; }
    }
</style>

<?php
// Métricas seguras

use App\Tadala\Models\Funcionarios;

$total_funcionarios = isset($total_) ? (int)$total_ : (isset($total_funcionarios) ? (int)$total_funcionarios : 0);
$total_ativos       = isset($total_ativos) ? (int)$total_ativos : 0;
$total_inativos     = isset($total_inativos) ? (int)$total_inativos : 0;
$taxa_ativacao      = $total_funcionarios > 0 ? round(($total_ativos / $total_funcionarios) * 100) : 0;

// Helpers de ícones/estilo por contexto
$cargoIcon = function (?string $cargo): string {
    $c = mb_strtolower((string)$cargo, 'UTF-8');
    if (strpos($c, 'gerente') !== false) return 'fa-briefcase';
    if (strpos($c, 'cozin') !== false) return 'fa-cutlery';
    if (strpos($c, 'atend') !== false) return 'fa-headphones';
    if (strpos($c, 'entreg') !== false) return 'fa-motorcycle';
    if (strpos($c, 'caixa') !== false) return 'fa-calculator';
    if (strpos($c, 'rh') !== false || strpos($c, 'recur') !== false) return 'fa-users';
    if (strpos($c, 'limp') !== false) return 'fa-paint-brush';
    return 'fa-id-badge';
};
$statusMeta = function (?string $status): array {
    $s = mb_strtolower(trim((string)$status), 'UTF-8');
    if (in_array($s, ['ativo','act','active','ativado','em atividade'])) {
        return ['icon' => 'fa-check-circle', 'text' => 'Ativo', 'badge' => 'badge-ativo'];
    }
    if (in_array($s, ['inativo','inact','inactive','desativado','afastado'])) {
        return ['icon' => 'fa-times-circle', 'text' => 'Inativo', 'badge' => 'badge-inativo'];
    }
    return ['icon' => 'fa-info-circle', 'text' => (string)$status, 'badge' => 'badge-outro'];
};
$formatMoney = function ($v): string {
    $n = is_numeric($v) ? (float)$v : 0.0;
    return 'R$ ' . number_format($n, 2, ',', '.');
};
?>

<!-- Page Header -->
<header class="page-header">
    <div>
        <h1 class="page-title">
            <i class="fa-solid fa-address-book"></i>
            Painel de Funcionários
        </h1>
        <p class="page-subtitle">Visão geral e gerenciamento dos colaboradores</p>
    </div>
</header>

<!-- Stats Grid -->
<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-header">
            <div>
                <div class="stat-value"><?= $total_funcionarios ?></div>
                <div class="stat-label">Total de Funcionários</div>
            </div>
            <div class="stat-icon">
                <i class="fa-solid fa-address-book"></i>
            </div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-header">
            <div>
                <div class="stat-value"><?= $total_ativos ?></div>
                <div class="stat-label">Funcionários Ativos</div>
            </div>
            <div class="stat-icon">
                <i class="fa-solid fa-check-circle"></i>
            </div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-header">
            <div>
                <div class="stat-value"><?= $total_inativos ?></div>
                <div class="stat-label">Funcionários Inativos</div>
            </div>
            <div class="stat-icon">
                <i class="fa-solid fa-ban"></i>
            </div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-header">
            <div>
                <div class="stat-value"><?= $taxa_ativacao ?>%</div>
                <div class="stat-label">Taxa de Ativação</div>
            </div>
            <div class="stat-icon">
                <i class="fa-solid fa-chart-pie"></i>
            </div>
        </div>
    </div>
</div>

<!-- Table Section -->
<div class="section-header">
    <div class="section-title">
        <i class="fa-solid fa-list"></i>
        Listagem de Funcionários
    </div>
    <a href="/backend/funcionarios/criar" class="btn btn-primary">
        <i class="fa-solid fa-plus-circle"></i>
        Criar Funcionário
    </a>
</div>

<div class="table-card">
    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th><i class="fa-solid fa-hashtag"></i> ID</th>
                    <th><i class="fa-solid fa-user"></i> Nome</th>
                    <th><i class="fa-solid fa-envelope"></i> Email</th>
                    <th><i class="fa-solid fa-briefcase"></i> Cargo</th>
                    <th><i class="fa-solid fa-info-circle"></i> Status</th>
                    <th><i class="fa-solid fa-dollar-sign"></i> Salário</th>
                    <th><i class="fa-solid fa-cog"></i> Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php if (isset($funcionarios) && is_array($funcionarios) && count($funcionarios) > 0): ?>
                    <?php foreach ($funcionarios as $funcionario): ?>
                        <?php
                            $userID    = intval($funcionario['usuario_id'] ?? 0);
                            $id        = htmlspecialchars($funcionario['funcionario_id']);
                            $nome      = htmlspecialchars($funcionario['nome']);
                            $email     = htmlspecialchars($funcionario['email']);
                            $cargoDesc = htmlspecialchars($funcionario['cargo_descricao']);
                            $statusRaw = $funcionario['descricao'] ?? '';
                            $statusM   = $statusMeta($statusRaw);
                            $salary    = $formatMoney($funcionario['salario'] ?? 0);
                            $cargoIco  = $cargoIcon($funcionario['cargo_descricao'] ?? '');
                        ?>
                        <tr>
                            <td><?= $id ?></td>
                            <td>
                                <i class="fa-solid fa-user-circle" style="color: var(--text-muted); margin-right: 0.5rem;"></i>
                                <?= $nome ?>
                            </td>
                            <td>
                                <a href="mailto:<?= $email ?>" class="email-link" title="Enviar email para <?= $nome ?>">
                                    <?= $email ?>
                                </a>
                            </td>
                            <td>
                                <i class="fa <?= $cargoIco ?>" style="color: var(--accent-gold); margin-right: 0.5rem;"></i>
                                <?= $cargoDesc ?>
                            </td>
                            <td>
                                <span class="badge <?= $statusM['badge'] ?>">
                                    <i class="fa-solid <?= $statusM['icon'] ?>"></i>
                                    <?= htmlspecialchars($statusM['text']) ?>
                                </span>
                            </td>
                            <td>
                                <span class="salary-tag"><?= $salary ?></span>
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <a href="/backend/funcionarios/editar/<?= $id ?>" class="btn-action btn-edit" title="Editar <?= $nome ?>">
                                        <i class="fa-solid fa-pen"></i> Editar
                                    </a>
                                    <button class="btn-action btn-delete" data-funcid="<?= $id ?>" data-userid="<?= $userID ?>" title="Excluir <?= $nome ?>">
                                        <i class="fa-solid fa-trash"></i> Excluir
                                    </button>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" class="empty-state">
                            <i class="fa-solid fa-address-book"></i>
                            Nenhum funcionário encontrado
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="pagination">
        <div class="pagination-info">
            <?php if (isset($paginacao) && is_array($paginacao)): ?>
                Página <?= (int)$paginacao['pagina_atual'] ?> de <?= (int)$paginacao['ultima_pagina'] ?>
            <?php else: ?>
                Mostrando <?= count($funcionarios ?? []) ?> registro(s)
            <?php endif; ?>
        </div>
        <div class="pagination-controls">
            <?php if (isset($paginacao) && is_array($paginacao)): ?>
                <?php $pagAtual = (int)$paginacao['pagina_atual']; $ultima = (int)$paginacao['ultima_pagina']; ?>
                <a href="/backend/funcionarios/listar/<?= max(1, $pagAtual - 1) ?>"
                   class="btn btn-secondary"
                   <?= ($pagAtual <= 1) ? 'style="opacity: 0.5; pointer-events: none;"' : '' ?>>
                    <i class="fa-solid fa-chevron-left"></i> Anterior
                </a>
                <a href="/backend/funcionarios/listar/<?= min($ultima, $pagAtual + 1) ?>"
                   class="btn btn-secondary"
                   <?= ($pagAtual >= $ultima) ? 'style="opacity: 0.5; pointer-events: none;"' : '' ?>>
                    Próximo <i class="fa-solid fa-chevron-right"></i>
                </a>
            <?php else: ?>
                <button class="btn btn-secondary" style="opacity: 0.5; pointer-events: none;">
                    <i class="fa-solid fa-chevron-left"></i> Anterior
                </button>
                <button class="btn btn-secondary" style="opacity: 0.5; pointer-events: none;">
                    Próximo <i class="fa-solid fa-chevron-right"></i>
                </button>
            <?php endif; ?>
        </div>
    </div>
</div>

<script type="module" src="/backend/Views/public/js/funcionarios/funcionariosIndex/funcionariosIndex.js"></script>