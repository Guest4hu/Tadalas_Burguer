<?php
use App\Tadala\Core\StatusLoja;

$statusAtual = StatusLoja::getStatus();
$isOpen = $statusAtual === 'aberto';
?>


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

    /* Status Card */
    .status-card {
        max-width: 600px;
        margin: 0 auto;
        background: var(--gradient-card);
        border-radius: 16px;
        box-shadow: var(--shadow-md);
        border: 1px solid var(--border-color);
        overflow: hidden;
        animation: fadeInUp 0.6s ease-out backwards;
    }
    .status-card-header {
        padding: 2rem 2rem 0;
        text-align: center;
    }
    .status-icon-wrapper {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        margin: 0 auto 1.5rem;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 3rem;
        transition: all 0.5s ease;
        position: relative;
    }
    .status-icon-wrapper.open {
        background: rgba(76, 175, 80, 0.15);
        border: 3px solid rgba(76, 175, 80, 0.4);
        color: #4CAF50;
        box-shadow: 0 0 40px rgba(76, 175, 80, 0.2);
    }
    .status-icon-wrapper.closed {
        background: rgba(229, 57, 53, 0.15);
        border: 3px solid rgba(229, 57, 53, 0.4);
        color: var(--accent-red);
        box-shadow: 0 0 40px rgba(229, 57, 53, 0.2);
    }
    .status-icon-wrapper::after {
        content: '';
        position: absolute;
        inset: -6px;
        border-radius: 50%;
        border: 2px dashed;
        opacity: 0.3;
        animation: rotateBorder 20s linear infinite;
    }
    .status-icon-wrapper.open::after { border-color: #4CAF50; }
    .status-icon-wrapper.closed::after { border-color: var(--accent-red); }

    @keyframes rotateBorder {
        to { transform: rotate(360deg); }
    }

    .status-label {
        font-size: 1.5rem;
        font-weight: 800;
        margin-bottom: 0.5rem;
    }
    .status-label.open { color: #4CAF50; }
    .status-label.closed { color: var(--accent-red); }

    .status-description {
        color: var(--text-secondary);
        font-size: 0.9375rem;
        margin-bottom: 1.5rem;
        line-height: 1.6;
    }

    /* Toggle Section */
    .status-card-body {
        padding: 0 2rem 2rem;
        text-align: center;
    }
    .status-divider {
        height: 1px;
        background: linear-gradient(90deg, transparent, var(--border-color), transparent);
        margin: 1.5rem 0;
    }

    /* Toggle Switch */
    .toggle-container {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 1.5rem;
        margin: 1.5rem 0;
    }
    .toggle-label {
        font-weight: 600;
        font-size: 1rem;
        color: var(--text-secondary);
        min-width: 80px;
    }
    .toggle-label.active { color: var(--text-primary); }

    .toggle-switch {
        position: relative;
        width: 80px;
        height: 40px;
        cursor: pointer;
    }
    .toggle-switch input { opacity: 0; width: 0; height: 0; }
    .toggle-slider {
        position: absolute;
        inset: 0;
        background: rgba(229, 57, 53, 0.3);
        border: 2px solid rgba(229, 57, 53, 0.5);
        border-radius: 40px;
        transition: all 0.4s ease;
    }
    .toggle-slider::before {
        content: '';
        position: absolute;
        width: 32px;
        height: 32px;
        left: 2px;
        top: 2px;
        background: var(--accent-red);
        border-radius: 50%;
        transition: all 0.4s ease;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.3);
    }
    .toggle-switch input:checked + .toggle-slider {
        background: rgba(76, 175, 80, 0.3);
        border-color: rgba(76, 175, 80, 0.5);
    }
    .toggle-switch input:checked + .toggle-slider::before {
        transform: translateX(40px);
        background: #4CAF50;
    }

    /* Button */
    .btn-toggle {
        display: inline-flex;
        align-items: center;
        gap: 0.75rem;
        padding: 1rem 2.5rem;
        border-radius: 12px;
        font-weight: 700;
        font-size: 1rem;
        border: none;
        cursor: pointer;
        transition: all 0.3s ease;
        margin-top: 1rem;
    }
    .btn-toggle.open-action {
        background: #4CAF50;
        color: #fff;
        box-shadow: 0 4px 16px rgba(76, 175, 80, 0.3);
    }
    .btn-toggle.open-action:hover {
        background: #388E3C;
        box-shadow: 0 6px 24px rgba(76, 175, 80, 0.5);
        transform: translateY(-2px);
    }
    .btn-toggle.close-action {
        background: var(--accent-red);
        color: #fff;
        box-shadow: 0 4px 16px rgba(229, 57, 53, 0.3);
    }
    .btn-toggle.close-action:hover {
        background: var(--accent-red-hover);
        box-shadow: 0 6px 24px rgba(229, 57, 53, 0.5);
        transform: translateY(-2px);
    }

    /* Info Cards */
    .info-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1rem;
        margin-top: 1.5rem;
    }
    .info-item {
        background: var(--bg-secondary);
        border: 1px solid var(--border-color);
        border-radius: 12px;
        padding: 1rem;
        text-align: center;
    }
    .info-item i {
        font-size: 1.25rem;
        color: var(--accent-gold);
        margin-bottom: 0.5rem;
        display: block;
    }
    .info-item .info-label {
        font-size: 0.75rem;
        color: var(--text-muted);
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 0.25rem;
    }
    .info-item .info-value {
        font-size: 0.9375rem;
        font-weight: 600;
        color: var(--text-primary);
    }

    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    @media (max-width: 768px) {
        .status-card { margin: 0 1rem; }
        .info-grid { grid-template-columns: 1fr; }
    }
</style>

<!-- Page Header -->
<header class="page-header">
    <div>
        <h1 class="page-title">
            <i class="fa-solid fa-store"></i>
            Status da Loja
        </h1>
        <p class="page-subtitle">Controle a abertura e fechamento da loja para os clientes</p>
    </div>
</header>

<!-- Status Card -->
<div class="status-card">
    <div class="status-card-header">
        <div class="status-icon-wrapper <?= $isOpen ? 'open' : 'closed' ?>" id="statusIcon">
            <i class="fa-solid <?= $isOpen ? 'fa-door-open' : 'fa-door-closed' ?>" id="statusIconI"></i>
        </div>
        <div class="status-label <?= $isOpen ? 'open' : 'closed' ?>" id="statusLabel">
            <?= $isOpen ? 'Loja Aberta' : 'Loja Fechada' ?>
        </div>
        <p class="status-description" id="statusDesc">
            <?= $isOpen 
                ? 'A loja está aberta e os clientes podem acessar o cardápio e realizar pedidos normalmente.'
                : 'A loja está fechada. Os clientes verão um aviso informando que não é possível fazer pedidos no momento.'
            ?>
        </p>
    </div>

    <div class="status-card-body">
        <div class="status-divider"></div>

        <div class="toggle-container">
            <span class="toggle-label <?= !$isOpen ? 'active' : '' ?>" id="labelFechado">Fechada</span>
            <label class="toggle-switch">
                <input type="checkbox" id="toggleStatus" <?= $isOpen ? 'checked' : '' ?>>
                <span class="toggle-slider"></span>
            </label>
            <span class="toggle-label <?= $isOpen ? 'active' : '' ?>" id="labelAberto">Aberta</span>
        </div>

        <button type="button" class="btn-toggle <?= $isOpen ? 'close-action' : 'open-action' ?>" id="btnToggle" onclick="toggleStoreStatus()">
            <i class="fa-solid <?= $isOpen ? 'fa-lock' : 'fa-lock-open' ?>"></i>
            <span><?= $isOpen ? 'Fechar Loja' : 'Abrir Loja' ?></span>
        </button>

        <div class="info-grid">
            <div class="info-item">
                <i class="fa-solid fa-clock"></i>
                <div class="info-label">Último Atualização</div>
                <div class="info-value"><?= date('d/m/Y H:i') ?></div>
            </div>
            <div class="info-item">
                <i class="fa-solid fa-signal"></i>
                <div class="info-label">Status Atual</div>
                <div class="info-value" id="infoStatus"><?= $isOpen ? '🟢 Online' : '🔴 Offline' ?></div>
            </div>
        </div>
    </div>
</div>

<script>
function toggleStoreStatus() {
    const btn = document.getElementById('btnToggle');
    btn.disabled = true;
    btn.style.opacity = '0.6';

    fetch('/backend/api/status/toggle', { method: 'POST' })
        .then(r => r.json())
        .then(data => {
            const isOpen = data.status === 'aberto';

            // Icon wrapper
            const iconWrap = document.getElementById('statusIcon');
            iconWrap.className = 'status-icon-wrapper ' + (isOpen ? 'open' : 'closed');

            // Icon inside
            const iconI = document.getElementById('statusIconI');
            iconI.className = 'fa-solid ' + (isOpen ? 'fa-door-open' : 'fa-door-closed');

            // Label
            const label = document.getElementById('statusLabel');
            label.className = 'status-label ' + (isOpen ? 'open' : 'closed');
            label.textContent = isOpen ? 'Loja Aberta' : 'Loja Fechada';

            // Description
            document.getElementById('statusDesc').textContent = isOpen
                ? 'A loja está aberta e os clientes podem acessar o cardápio e realizar pedidos normalmente.'
                : 'A loja está fechada. Os clientes verão um aviso informando que não é possível fazer pedidos no momento.';

            // Toggle checkbox
            document.getElementById('toggleStatus').checked = isOpen;

            // Labels
            document.getElementById('labelFechado').className = 'toggle-label ' + (!isOpen ? 'active' : '');
            document.getElementById('labelAberto').className = 'toggle-label ' + (isOpen ? 'active' : '');

            // Button
            btn.className = 'btn-toggle ' + (isOpen ? 'close-action' : 'open-action');
            btn.innerHTML = '<i class="fa-solid ' + (isOpen ? 'fa-lock' : 'fa-lock-open') + '"></i><span>' + (isOpen ? 'Fechar Loja' : 'Abrir Loja') + '</span>';

            // Info
            document.getElementById('infoStatus').textContent = isOpen ? '🟢 Online' : '🔴 Offline';

            btn.disabled = false;
            btn.style.opacity = '1';

            Swal.fire({
                icon: 'success',
                title: isOpen ? 'Loja Aberta!' : 'Loja Fechada!',
                text: isOpen
                    ? 'Os clientes agora podem acessar o cardápio.'
                    : 'Os clientes verão que a loja está fechada.',
                timer: 2500,
                showConfirmButton: false,
                background: '#242424',
                color: '#fff'
            });
        })
        .catch(() => {
            btn.disabled = false;
            btn.style.opacity = '1';
            Swal.fire({
                icon: 'error',
                title: 'Erro',
                text: 'Não foi possível alterar o status da loja.',
                background: '#242424',
                color: '#fff'
            });
        });
}

// Sync toggle switch with button
document.getElementById('toggleStatus').addEventListener('change', function() {
    toggleStoreStatus();
});
</script>
