<?php include __DIR__ . '/../partials/header.php'; ?>

<style>
    /* Page-specific styles for usuario/index */
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

    .page-header-left {
        display: flex;
        align-items: center;
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

    .page-title i {
        color: var(--accent-red);
    }

    .page-subtitle {
        color: var(--text-secondary);
        font-size: 0.875rem;
        font-weight: 400;
    }

    /* Stats Grid */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
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
    }

    .stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 4px;
        background: linear-gradient(90deg, var(--accent-red), var(--accent-gold));
    }

    .stat-card:hover {
        transform: translateY(-4px);
        box-shadow: var(--shadow-lg);
        border-color: var(--accent-red);
    }

    .stat-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 1rem;
    }

    .stat-icon {
        width: 56px;
        height: 56px;
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

    .section-title i {
        color: var(--accent-gold);
    }

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

    .btn-primary::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 0;
        height: 0;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.2);
        transform: translate(-50%, -50%);
        transition: width 0.6s, height 0.6s;
    }

    .btn-primary:hover::before {
        width: 300px;
        height: 300px;
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
    }

    .table-wrapper {
        overflow-x: auto;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

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

    thead th i {
        margin-right: 0.5rem;
        color: var(--accent-gold);
    }

    tbody tr {
        border-bottom: 1px solid var(--border-color);
        transition: all 0.3s ease;
    }

    tbody tr:hover {
        background: rgba(229, 57, 53, 0.05);
        transform: scale(1.001);
    }

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

    .badge-admin {
        background: rgba(229, 57, 53, 0.15);
        color: var(--accent-red);
        border: 1px solid rgba(229, 57, 53, 0.3);
    }

    .badge-gerente {
        background: rgba(255, 193, 7, 0.15);
        color: #FFC107;
        border: 1px solid rgba(255, 193, 7, 0.3);
    }

    .badge-cliente {
        background: rgba(33, 150, 243, 0.15);
        color: #2196F3;
        border: 1px solid rgba(33, 150, 243, 0.3);
    }

    .badge-ativo {
        background: rgba(76, 175, 80, 0.15);
        color: #4CAF50;
        border: 1px solid rgba(76, 175, 80, 0.3);
    }

    /* Action Buttons */
    .action-buttons {
        display: flex;
        gap: 0.5rem;
    }

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

    .pagination-controls {
        display: flex;
        gap: 0.75rem;
    }

    /* Email and Phone Links */
    .link-email, .link-phone {
        color: var(--text-secondary);
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        transition: color 0.3s ease;
    }

    .link-email:hover {
        color: #2196F3;
    }

    .link-phone:hover {
        color: #4CAF50;
    }

    /* Password Display */
    .password-hidden {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        color: var(--text-muted);
    }

    /* Animations */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .stat-card {
        animation: fadeInUp 0.6s ease-out backwards;
    }

    .stat-card:nth-child(1) { animation-delay: 0.1s; }
    .stat-card:nth-child(2) { animation-delay: 0.2s; }
    .stat-card:nth-child(3) { animation-delay: 0.3s; }
    .stat-card:nth-child(4) { animation-delay: 0.4s; }

    .table-card {
        animation: fadeInUp 0.6s ease-out 0.5s backwards;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .page-header {
            flex-direction: column;
            align-items: flex-start;
        }

        .stats-grid {
            grid-template-columns: 1fr;
        }

        .section-header {
            flex-direction: column;
            align-items: flex-start;
        }

        .table-wrapper {
            overflow-x: auto;
        }

        .pagination {
            flex-direction: column;
        }
    }
</style>

<!-- Page Header -->
<header class="page-header">
    <div class="page-header-left">
        <div>
            <h1 class="page-title">
                <i class="fa-solid fa-users"></i>
                Painel de Clientes
            </h1>
            <p class="page-subtitle">Visão geral e gerenciamento dos clientes do sistema</p>
        </div>
    </div>
    <div class="page-header-actions">
        <a href="/backend/relatorios" class="btn btn-secondary">
            <i class="fa-solid fa-chart-line"></i>
            Relatórios
        </a>
    </div>
</header>

<!-- Stats Grid -->
<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-header">
            <div>
                <div class="stat-value"><?= $total_usuarios ?? 0 ?></div>
                <div class="stat-label">Total de Usuários</div>
            </div>
            <div class="stat-icon">
                <i class="fa-solid fa-users"></i>
            </div>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-header">
            <div>
                <div class="stat-value"><?= $total_ativos ?? 0 ?></div>
                <div class="stat-label">Clientes Ativos</div>
            </div>
            <div class="stat-icon">
                <i class="fa-solid fa-user-check"></i>
            </div>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-header">
            <div>
                <div class="stat-value"><?= $total_inativos ?? 0 ?></div>
                <div class="stat-label">Clientes Inativos</div>
            </div>
            <div class="stat-icon">
                <i class="fa-solid fa-user-slash"></i>
            </div>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-header">
            <div>
                <div class="stat-value">
                    <?php 
                        $taxa = ($total_usuarios > 0) ? round(($total_ativos / $total_usuarios) * 100) : 0;
                        echo $taxa . '%';
                    ?>
                </div>
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
        <i class="fa-solid fa-address-book"></i>
        Listagem de Clientes
    </div>
    <a href="/backend/cliente/criar" class="btn btn-primary">
        <i class="fa-solid fa-plus-circle"></i>
        Criar Usuário
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
                    <th><i class="fa-solid fa-lock"></i> Senha</th>
                    <th><i class="fa-solid fa-phone"></i> Telefone</th>
                    <th><i class="fa-solid fa-id-badge"></i> Tipo</th>
                    <th><i class="fa-solid fa-info-circle"></i> Status</th>
                    <th><i class="fa-solid fa-cog"></i> Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($usuarios) && is_array($usuarios)): ?>
                    <?php foreach ($usuarios as $usuario): ?>
                        <tr>
                            <td><?= htmlspecialchars($usuario['usuario_id'] ?? '') ?></td>
                            <td>
                                <i class="fa-solid fa-user" style="color: var(--text-muted); margin-right: 0.5rem;"></i>
                                <?= htmlspecialchars($usuario['nome'] ?? '') ?>
                            </td>
                            <td>
                                <a href="mailto:<?= htmlspecialchars($usuario['email'] ?? '') ?>" class="link-email">
                                    <i class="fa-solid fa-envelope"></i>
                                    <?= htmlspecialchars($usuario['email'] ?? '') ?>
                                </a>
                            </td>
                            <td>
                                <span class="password-hidden">
                                    <i class="fa-solid fa-lock"></i>
                                    ••••••••
                                </span>
                            </td>
                            <td>
                                <?php if (!empty($usuario['telefone'])): ?>
                                    <a href="tel:<?= htmlspecialchars($usuario['telefone'] ?? '') ?>" class="link-phone">
                                        <i class="fa-solid fa-phone"></i>
                                        <?= htmlspecialchars($usuario['telefone'] ?? '') ?>
                                    </a>
                                <?php else: ?>
                                    <span style="color: var(--text-muted);">-</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php 
                                    $tipo = strtolower($usuario['descricao'] ?? 'cliente');
                                    $badgeClass = 'badge-cliente';
                                    $icon = 'fa-user';
                                    
                                    if (stripos($tipo, 'admin') !== false) {
                                        $badgeClass = 'badge-admin';
                                        $icon = 'fa-user-shield';
                                    } elseif (stripos($tipo, 'gerente') !== false) {
                                        $badgeClass = 'badge-gerente';
                                        $icon = 'fa-user-tie';
                                    }
                                ?>
                                <span class="badge <?= $badgeClass ?>">
                                    <i class="fa-solid <?= $icon ?>"></i>
                                    <?= htmlspecialchars($usuario['descricao'] ?? 'Cliente') ?>
                                </span>
                            </td>
                            <td>
                                <span class="badge badge-ativo">
                                    <i class="fa-solid fa-check-circle"></i>
                                    Ativo
                                </span>
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <a href="/backend/cliente/editar/<?= htmlspecialchars($usuario['usuario_id'] ?? '') ?>" class="btn-action btn-edit">
                                        <i class="fa-solid fa-pen"></i>
                                        Editar
                                    </a>
                                    <a href="/backend/cliente/excluir/<?= htmlspecialchars($usuario['usuario_id'] ?? '') ?>" 
                                       class="btn-action btn-delete"
                                       onclick="return confirm('Confirma a exclusão deste usuário?');">
                                        <i class="fa-solid fa-trash"></i>
                                        Excluir
                                    </a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="8" style="text-align: center; padding: 3rem; color: var(--text-secondary);">
                            <i class="fa-solid fa-users" style="font-size: 2rem; display: block; margin-bottom: 1rem; color: var(--accent-red);"></i>
                            Nenhum usuário encontrado
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="pagination">
        <div class="pagination-info">
            <?php if (isset($paginacao)): ?>
                Mostrando <?= $paginacao['de'] ?? 0 ?> a <?= $paginacao['para'] ?? 0 ?> de <?= $paginacao['total'] ?? 0 ?> registros
            <?php else: ?>
                Mostrando <?= count($usuarios ?? []) ?> registro(s)
            <?php endif; ?>
        </div>
        <div class="pagination-controls">
            <?php if (isset($paginacao)): ?>
                <?php 
                    $paginaAtual = $paginacao['pagina_atual'] ?? 1;
                    $ultimaPagina = $paginacao['ultima_pagina'] ?? 1;
                ?>
                <a href="?pagina=<?= max(1, $paginaAtual - 1) ?>" 
                   class="btn btn-secondary" 
                   <?= ($paginaAtual <= 1) ? 'style="opacity: 0.5; pointer-events: none;"' : '' ?>>
                    <i class="fa-solid fa-chevron-left"></i>
                    Anterior
                </a>
                <a href="?pagina=<?= min($ultimaPagina, $paginaAtual + 1) ?>" 
                   class="btn btn-secondary"
                   <?= ($paginaAtual >= $ultimaPagina) ? 'style="opacity: 0.5; pointer-events: none;"' : '' ?>>
                    Próximo
                    <i class="fa-solid fa-chevron-right"></i>
                </a>
            <?php else: ?>
                <button class="btn btn-secondary" style="opacity: 0.5; pointer-events: none;">
                    <i class="fa-solid fa-chevron-left"></i>
                    Anterior
                </button>
                <button class="btn btn-secondary" style="opacity: 0.5; pointer-events: none;">
                    Próximo
                    <i class="fa-solid fa-chevron-right"></i>
                </button>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../partials/footer.php'; ?>