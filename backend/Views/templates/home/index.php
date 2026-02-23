<?php
    $formatter = new IntlDateFormatter(
            'pt_BR',
            IntlDateFormatter::FULL,
            IntlDateFormatter::NONE,
            'America/Sao_Paulo',
            IntlDateFormatter::GREGORIAN
        );
    $data = $formatter->format(new DateTime());


?>

<style>

    /* ── Page Header ── */
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

    .page-title i {
        color: var(--accent-red);
    }

    .page-subtitle {
        color: var(--text-secondary);
        font-size: 0.875rem;
    }

    /* ── Section Header ── */
    .section-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.25rem;
        flex-wrap: wrap;
        gap: 0.75rem;
    }

    .section-title {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        font-size: 1.125rem;
        font-weight: 700;
    }

    .section-title i {
        color: var(--accent-gold);
    }

    /* ── Buttons ── */
    .btn {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.625rem 1.25rem;
        border-radius: 10px;
        font-weight: 600;
        font-size: 0.875rem;
        text-decoration: none;
        border: none;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .btn-primary {
        background: var(--accent-red);
        color: #fff;
        box-shadow: 0 4px 16px rgba(229, 57, 53, 0.3);
    }

    .btn-primary:hover {
        background: var(--accent-red-hover);
        transform: translateY(-2px);
        box-shadow: 0 6px 24px rgba(229, 57, 53, 0.5);
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

    .btn-danger {
        background: rgba(229, 57, 53, 0.15);
        color: var(--accent-red);
        border: 1px solid rgba(229, 57, 53, 0.3);
    }

    .btn-danger:hover {
        background: rgba(229, 57, 53, 0.25);
        transform: translateY(-1px);
    }



    /* ── Welcome Banner ── */
    .welcome-banner {
        background: linear-gradient(135deg, rgba(229, 57, 53, 0.15) 0%, rgba(255, 215, 0, 0.08) 100%);
        border: 1px solid rgba(229, 57, 53, 0.3);
        border-radius: 16px;
        padding: 1.75rem 2rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 2.5rem;
        flex-wrap: wrap;
        gap: 1.25rem;
        animation: fadeInUp 0.5s ease-out backwards;
    }

    .welcome-text h2 {
        font-size: 1.5rem;
        font-weight: 700;
        margin-bottom: 0.375rem;
    }

    .welcome-text p {
        color: var(--text-secondary);
        font-size: 0.9375rem;
    }

    .welcome-text .user-type {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        background: rgba(255, 215, 0, 0.1);
        color: var(--accent-gold);
        border: 1px solid rgba(255, 215, 0, 0.25);
        border-radius: 50px;
        padding: 0.3rem 0.85rem;
        font-size: 0.8125rem;
        font-weight: 600;
        margin-top: 0.5rem;
    }


    /* ── Animations ── */
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


    /* ── Responsive ── */

    @media (max-width: 600px) {
        .welcome-banner {
            flex-direction: column;
        }
    }
</style>

<!-- ════════════════════════════════════════════
     PAGE HEADER
════════════════════════════════════════════ -->
<header class="page-header">
    <div>
        <h1 class="page-title">
            <i class="fa-solid fa-gauge-high"></i>
            Meu Painel
        </h1>
        <p class="page-subtitle">Visão geral da operação da loja</p>
    </div>
    <div style="display:flex; align-items:center; gap:0.75rem; color:var(--text-secondary); font-size:0.875rem;">
        <i class="fa-solid fa-calendar-days" style="color:var(--accent-gold);"></i>
        <?= $data ?>
    </div>
</header>

<!-- ════════════════════════════════════════════
     WELCOME BANNER
════════════════════════════════════════════ -->
<div class="welcome-banner">
    <div class="welcome-text">
        <h2>Bem-vindo de volta, <?= htmlspecialchars($nome) ?>! 👋</h2>
        <!--     -->
        <div class="user-type">
            <i class="fa-solid fa-shield-halved"></i>
            <?= htmlspecialchars($tipo_nome) ?>
        </div>
    </div>
    <a href="/backend/logout" class="btn btn-danger">
        <i class="fa-solid fa-right-from-bracket"></i>
        Sair do Sistema
    </a>
</div>



