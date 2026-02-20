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
        background: rgba(255, 152, 0, 0.15);
        color: #FF9800;
        border: 1px solid rgba(255, 152, 0, 0.3);
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

    /* Animations */
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .table-card { animation: fadeInUp 0.6s ease-out 0.3s backwards; }

    @media (max-width: 768px) {
        .page-header { flex-direction: column; align-items: flex-start; }
        .section-header { flex-direction: column; align-items: flex-start; }
        .pagination { flex-direction: column; }
    }
</style>

<?php
    $total        = isset($total)        ? (int)$total        : 0;
    $total_ativos = isset($total_ativos) ? (int)$total_ativos : 0;
    $total_inativos = isset($total_inativos) ? (int)$total_inativos : 0;
?>

<!-- Page Header -->
<header class="page-header">
    <div>
        <h1 class="page-title">
            <i class="fa-solid fa-briefcase"></i>
            Painel de Cargos
        </h1>
        <p class="page-subtitle">Visão geral e gerenciamento dos cargos do sistema</p>
    </div>
</header>

<!-- Table Section -->
<div class="section-header">
    <div class="section-title">
        <i class="fa-solid fa-list"></i>
        Listagem de Cargos
    </div>
    <a href="/backend/cargo/criar" class="btn btn-primary">
        <i class="fa-solid fa-plus-circle"></i>
        Criar Cargo
    </a>
</div>

<div class="table-card">
    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th><i class="fa-solid fa-hashtag"></i> ID</th>
                    <th><i class="fa-solid fa-briefcase"></i> Cargo</th>
                    <th><i class="fa-solid fa-info-circle"></i> Status</th>
                    <th><i class="fa-solid fa-cog"></i> Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php if (isset($cargos) && is_array($cargos) && count($cargos) > 0): ?>
                    <?php foreach ($cargos as $cargo): ?>
                        <?php
                            $id = htmlspecialchars($cargo['id']);
                            $descricao = htmlspecialchars($cargo['cargo_descricao']);
                            $ativo = isset($cargo['ativo']) ? (bool)$cargo['ativo'] : true;
                        ?>
                        <tr>
                            <td><?php echo $id; ?></td>
                            <td>
                                <i class="fa-solid fa-briefcase" style="color: var(--text-muted); margin-right: 0.5rem;"></i>
                                <?php echo $descricao !== '' ? $descricao : '<span style="color: var(--text-muted);">—</span>'; ?>
                            </td>
                            <td>
                                <?php if ($ativo): ?>
                                    <span class="badge badge-ativo">
                                        <i class="fa-solid fa-check-circle"></i> Ativo
                                    </span>
                                <?php else: ?>
                                    <span class="badge badge-inativo">
                                        <i class="fa-solid fa-times-circle"></i> Inativo
                                    </span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn-action btn-delete" onclick="SoftDelete(<?php echo htmlspecialchars($id); ?>)">
                                        <i class="fa-solid fa-trash"></i> Excluir
                                    </button>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4" class="empty-state">
                            <i class="fa-solid fa-briefcase"></i>
                            Nenhum cargo encontrado
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
                Página <?php echo (int)$paginacao['pagina_atual']; ?> de <?php echo (int)$paginacao['ultima_pagina']; ?>
            <?php else: ?>
                Mostrando <?php echo count($cargos ?? []); ?> registro(s)
            <?php endif; ?>
        </div>
        <div class="pagination-controls">
            <?php if (isset($paginacao) && is_array($paginacao)): ?>
                <?php $pagAtual = (int)$paginacao['pagina_atual']; $ultima = (int)$paginacao['ultima_pagina']; ?>
                <a href="/backend/cargo/listar/<?php echo max(1, $pagAtual - 1); ?>" 
                   class="btn btn-secondary"
                   <?= ($pagAtual <= 1) ? 'style="opacity: 0.5; pointer-events: none;"' : '' ?>>
                    <i class="fa-solid fa-chevron-left"></i> Anterior
                </a>
                <a href="/backend/cargo/listar/<?php echo min($ultima, $pagAtual + 1); ?>" 
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

<script>
    function SoftDelete(id) {
        const data = JSON.stringify({ id: id });
        const xhr = new XMLHttpRequest();
        xhr.withCredentials = true;
        xhr.addEventListener('readystatechange', function() {});
        xhr.open('POST', '/backend/cargo/deletar');
        xhr.setRequestHeader('Content-Type', 'application/json');

        Swal.fire({
            title: "Você tem certeza?",
            text: "Você não poderá reverter isso!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#E53935",
            cancelButtonColor: "#555",
            confirmButtonText: "Sim, Deletar Cargo!",
            background: '#242424',
            color: '#fff'
        }).then((result) => {
            if (result.isConfirmed) {
                xhr.send(data);
                Swal.fire({
                    title: "Deletado!",
                    text: "Seu cargo está sendo deletado.",
                    icon: "success",
                    background: '#242424',
                    color: '#fff'
                });
                location.reload();
            }
        });
    }
</script>