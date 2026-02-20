<style>
    /* ── KPI Cards ── */
    .kpi-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2.5rem;
    }
    .kpi-card {
        background: var(--gradient-card);
        border: 1px solid var(--border-color);
        border-radius: 16px;
        padding: 1.75rem 1.5rem;
        display: flex;
        align-items: center;
        gap: 1.25rem;
        box-shadow: var(--shadow-md);
        transition: all 0.3s ease;
        animation: fadeInUp 0.5s ease-out backwards;
    }
    .kpi-card:hover {
        transform: translateY(-4px);
        box-shadow: var(--shadow-lg);
        border-color: var(--accent-red);
    }
    .kpi-icon {
        width: 56px;
        height: 56px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.375rem;
        flex-shrink: 0;
    }
    .kpi-icon.red   { background: rgba(229,57,53,0.15); color: var(--accent-red); }
    .kpi-icon.gold  { background: rgba(255,215,0,0.12); color: var(--accent-gold); }
    .kpi-icon.blue  { background: rgba(33,150,243,0.15); color: #2196F3; }
    .kpi-icon.green { background: rgba(76,175,80,0.15);  color: #4CAF50; }
    .kpi-icon.purple{ background: rgba(156,39,176,0.15); color: #9C27B0; }
    .kpi-body { flex: 1; min-width: 0; }
    .kpi-value {
        font-size: 1.875rem;
        font-weight: 800;
        line-height: 1;
        margin-bottom: 0.375rem;
    }
    .kpi-label {
        color: var(--text-secondary);
        font-size: 0.875rem;
        font-weight: 500;
    }
    .kpi-delta {
        font-size: 0.75rem;
        font-weight: 600;
        margin-top: 0.375rem;
        display: flex;
        align-items: center;
        gap: 0.25rem;
    }
    .kpi-delta.up   { color: #4CAF50; }
    .kpi-delta.down { color: var(--accent-red); }

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
    .page-title i { color: var(--accent-red); }
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
    .section-title i { color: var(--accent-gold); }

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
        box-shadow: 0 4px 16px rgba(229,57,53,0.3);
    }
    .btn-primary:hover {
        background: var(--accent-red-hover);
        transform: translateY(-2px);
        box-shadow: 0 6px 24px rgba(229,57,53,0.5);
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
        background: rgba(229,57,53,0.15);
        color: var(--accent-red);
        border: 1px solid rgba(229,57,53,0.3);
    }
    .btn-danger:hover {
        background: rgba(229,57,53,0.25);
        transform: translateY(-1px);
    }

    /* ── Two-column layout ── */
    .two-col {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    /* ── Card ── */
    .card {
        background: var(--gradient-card);
        border: 1px solid var(--border-color);
        border-radius: 16px;
        box-shadow: var(--shadow-md);
        overflow: hidden;
        animation: fadeInUp 0.6s ease-out 0.2s backwards;
    }
    .card-body { padding: 1.5rem; }

    /* ── Welcome Banner ── */
    .welcome-banner {
        background: linear-gradient(135deg, rgba(229,57,53,0.15) 0%, rgba(255,215,0,0.08) 100%);
        border: 1px solid rgba(229,57,53,0.3);
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
    .welcome-text p { color: var(--text-secondary); font-size: 0.9375rem; }
    .welcome-text .user-type {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        background: rgba(255,215,0,0.1);
        color: var(--accent-gold);
        border: 1px solid rgba(255,215,0,0.25);
        border-radius: 50px;
        padding: 0.3rem 0.85rem;
        font-size: 0.8125rem;
        font-weight: 600;
        margin-top: 0.5rem;
    }

    /* ── Activity List ── */
    .activity-list { list-style: none; padding: 0; margin: 0; }
    .activity-item {
        display: flex;
        align-items: flex-start;
        gap: 1rem;
        padding: 1rem 0;
        border-bottom: 1px solid var(--border-color);
        transition: background 0.2s;
    }
    .activity-item:last-child { border-bottom: none; padding-bottom: 0; }
    .activity-dot {
        width: 36px;
        height: 36px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.875rem;
        flex-shrink: 0;
        margin-top: 0.1rem;
    }
    .activity-info { flex: 1; min-width: 0; }
    .activity-info strong { display: block; font-size: 0.9375rem; margin-bottom: 0.2rem; }
    .activity-info span { color: var(--text-secondary); font-size: 0.8125rem; }
    .activity-time {
        color: var(--text-muted);
        font-size: 0.75rem;
        white-space: nowrap;
    }

    /* ── Quick-access shortcuts ── */
    .shortcuts-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(130px, 1fr));
        gap: 1rem;
        margin-bottom: 2rem;
    }
    .shortcut {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 0.625rem;
        padding: 1.25rem 0.75rem;
        background: var(--gradient-card);
        border: 1px solid var(--border-color);
        border-radius: 14px;
        text-decoration: none;
        color: var(--text-primary);
        font-size: 0.875rem;
        font-weight: 600;
        transition: all 0.3s ease;
        text-align: center;
        box-shadow: var(--shadow-sm);
    }
    .shortcut i { font-size: 1.5rem; color: var(--accent-red); }
    .shortcut:hover {
        transform: translateY(-4px);
        border-color: var(--accent-red);
        box-shadow: var(--shadow-md);
        color: var(--text-primary);
    }

    /* ── Status indicator ── */
    .status-dot {
        display: inline-block;
        width: 8px;
        height: 8px;
        border-radius: 50%;
        margin-right: 0.4rem;
    }
    .status-dot.online { background: #4CAF50; box-shadow: 0 0 6px #4CAF50; }
    .status-dot.offline { background: var(--accent-red); }

    /* ── Animations ── */
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(20px); }
        to   { opacity: 1; transform: translateY(0); }
    }
    .kpi-card:nth-child(1) { animation-delay: 0.05s; }
    .kpi-card:nth-child(2) { animation-delay: 0.10s; }
    .kpi-card:nth-child(3) { animation-delay: 0.15s; }
    .kpi-card:nth-child(4) { animation-delay: 0.20s; }
    .kpi-card:nth-child(5) { animation-delay: 0.25s; }

    /* ── Responsive ── */
    @media (max-width: 992px) {
        .two-col { grid-template-columns: 1fr; }
    }
    @media (max-width: 600px) {
        .kpi-value { font-size: 1.5rem; }
        .welcome-banner { flex-direction: column; }
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
        <?= date('l, d \d\e F \d\e Y') ?>
    </div>
</header>

<!-- ════════════════════════════════════════════
     WELCOME BANNER
════════════════════════════════════════════ -->
<div class="welcome-banner">
    <div class="welcome-text">
        <h2>Bem-vindo de volta, <?= htmlspecialchars($nomeUsuario) ?>! 👋</h2>
        <p>Aqui está um resumo do que está acontecendo hoje na Tadallas Burguer.</p>
        <div class="user-type">
            <i class="fa-solid fa-shield-halved"></i>
            <?= htmlspecialchars($tipo) ?>
        </div>
    </div>
    <a href="/backend/logout" class="btn btn-danger">
        <i class="fa-solid fa-right-from-bracket"></i>
        Sair do Sistema
    </a>
</div>

<!-- ════════════════════════════════════════════
     KPI CARDS
════════════════════════════════════════════ -->
<div class="kpi-grid">
    <div class="kpi-card">
        <div class="kpi-icon red"><i class="fa-solid fa-shopping-basket"></i></div>
        <div class="kpi-body">
            <div class="kpi-value"><?= isset($totalPedidosHoje) ? (int)$totalPedidosHoje : '—' ?></div>
            <div class="kpi-label">Pedidos Hoje</div>
            <div class="kpi-delta up"><i class="fa-solid fa-arrow-trend-up"></i> +12% vs ontem</div>
        </div>
    </div>

    <div class="kpi-card">
        <div class="kpi-icon green"><i class="fa-solid fa-money-bill-wave"></i></div>
        <div class="kpi-body">
            <div class="kpi-value">R$ <?= isset($faturamentoHoje) ? number_format($faturamentoHoje, 2, ',', '.') : '—' ?></div>
            <div class="kpi-label">Faturamento Hoje</div>
            <div class="kpi-delta up"><i class="fa-solid fa-arrow-trend-up"></i> +8% vs ontem</div>
        </div>
    </div>

    <div class="kpi-card">
        <div class="kpi-icon blue"><i class="fa-solid fa-users"></i></div>
        <div class="kpi-body">
            <div class="kpi-value"><?= isset($totalClientes) ? (int)$totalClientes : '—' ?></div>
            <div class="kpi-label">Clientes Cadastrados</div>
            <div class="kpi-delta up"><i class="fa-solid fa-arrow-trend-up"></i> +3 novos hoje</div>
        </div>
    </div>

    <div class="kpi-card">
        <div class="kpi-icon gold"><i class="fa-solid fa-calendar-check"></i></div>
        <div class="kpi-body">
            <div class="kpi-value"><?= isset($agendamentosHoje) ? (int)$agendamentosHoje : '—' ?></div>
            <div class="kpi-label">Agendamentos Hoje</div>
            <div class="kpi-delta down"><i class="fa-solid fa-arrow-trend-down"></i> -1 vs ontem</div>
        </div>
    </div>

    <div class="kpi-card">
        <div class="kpi-icon purple"><i class="fa-solid fa-cubes"></i></div>
        <div class="kpi-body">
            <div class="kpi-value"><?= isset($itensBaixoEstoque) ? (int)$itensBaixoEstoque : '—' ?></div>
            <div class="kpi-label">Itens com Baixo Estoque</div>
            <?php if (!empty($itensBaixoEstoque) && $itensBaixoEstoque > 0): ?>
                <div class="kpi-delta down"><i class="fa-solid fa-triangle-exclamation"></i> Atenção necessária</div>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- ════════════════════════════════════════════
     QUICK ACCESS SHORTCUTS
════════════════════════════════════════════ -->
<div class="section-header">
    <div class="section-title">
        <i class="fa-solid fa-bolt"></i>
        Acesso Rápido
    </div>
</div>
<div class="shortcuts-grid" style="margin-bottom:2.5rem;">
    <a href="/backend/pedidos" class="shortcut">
        <i class="fa-solid fa-shopping-basket"></i>
        Pedidos
    </a>
    <a href="/backend/cliente" class="shortcut">
        <i class="fa-solid fa-users"></i>
        Clientes
    </a>
    <a href="/backend/produtos" class="shortcut">
        <i class="fa-solid fa-cubes"></i>
        Produtos
    </a>
    <a href="/backend/agendamento" class="shortcut">
        <i class="fa-solid fa-calendar-plus"></i>
        Agendamentos
    </a>
    <a href="/backend/funcionarios" class="shortcut">
        <i class="fa-solid fa-address-book"></i>
        Funcionários
    </a>
    <a href="/backend/analises/vendas" class="shortcut">
        <i class="fa-solid fa-chart-line"></i>
        Análises
    </a>
    <a href="/backend/status-store" class="shortcut">
        <i class="fa-solid fa-server"></i>
        Status da Loja
    </a>
    <a href="/backend/configuracao" class="shortcut">
        <i class="fa-solid fa-gear"></i>
        Configurações
    </a>
</div>

<!-- ════════════════════════════════════════════
     TWO-COLUMN: RECENT ACTIVITY + STORE STATUS
════════════════════════════════════════════ -->
<div class="two-col">

    <!-- Recent Activity -->
    <div class="card">
        <div class="card-body">
            <div class="section-header" style="margin-bottom:1rem;">
                <div class="section-title">
                    <i class="fa-solid fa-clock-rotate-left"></i>
                    Atividade Recente
                </div>
                <a href="/backend/pedidos" class="btn btn-secondary" style="font-size:0.8125rem; padding:0.5rem 1rem;">
                    Ver tudo <i class="fa-solid fa-arrow-right"></i>
                </a>
            </div>

            <ul class="activity-list">
                <?php
                // Se $atividadesRecentes não estiver disponível, exibe placeholder
                $atividades = $atividadesRecentes ?? [
                    ['icon' => 'fa-shopping-basket', 'color' => 'red',   'text' => 'Pedido #1042 recebido',       'sub' => 'Mesa 3 · R$ 89,90',         'time' => '5 min atrás'],
                    ['icon' => 'fa-calendar-check',  'color' => 'blue',  'text' => 'Agendamento confirmado',      'sub' => 'João Silva · 19h00',        'time' => '12 min atrás'],
                    ['icon' => 'fa-user-plus',        'color' => 'green', 'text' => 'Novo cliente cadastrado',    'sub' => 'Maria Oliveira',            'time' => '34 min atrás'],
                    ['icon' => 'fa-triangle-exclamation','color'=>'gold', 'text' => 'Estoque baixo detectado',    'sub' => 'Pão de hambúrguer · 8 un.', 'time' => '1h atrás'],
                    ['icon' => 'fa-shopping-basket', 'color' => 'red',   'text' => 'Pedido #1041 concluído',      'sub' => 'Mesa 1 · R$ 52,50',         'time' => '1h 20m atrás'],
                ];
                $colorMap = [
                    'red'   => 'kpi-icon red',
                    'blue'  => 'kpi-icon blue',
                    'green' => 'kpi-icon green',
                    'gold'  => 'kpi-icon gold',
                    'purple'=> 'kpi-icon purple',
                ];
                foreach ($atividades as $a):
                    $cls = $colorMap[$a['color']] ?? 'kpi-icon red';
                ?>
                <li class="activity-item">
                    <div class="<?= $cls ?>" style="width:36px;height:36px;border-radius:10px;">
                        <i class="fa-solid <?= htmlspecialchars($a['icon']) ?>"></i>
                    </div>
                    <div class="activity-info">
                        <strong><?= htmlspecialchars($a['text']) ?></strong>
                        <span><?= htmlspecialchars($a['sub']) ?></span>
                    </div>
                    <div class="activity-time"><?= htmlspecialchars($a['time']) ?></div>
                </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>

    <!-- Store Status -->
    <div class="card">
        <div class="card-body">
            <div class="section-header" style="margin-bottom:1rem;">
                <div class="section-title">
                    <i class="fa-solid fa-server"></i>
                    Status da Loja
                </div>
                <a href="/backend/status-store" class="btn btn-secondary" style="font-size:0.8125rem; padding:0.5rem 1rem;">
                    Gerenciar <i class="fa-solid fa-arrow-right"></i>
                </a>
            </div>

            <?php
            $lojaAberta = $statusLoja ?? true;
            $statusText = $lojaAberta ? 'Aberta' : 'Fechada';
            $statusColor = $lojaAberta ? '#4CAF50' : 'var(--accent-red)';
            ?>

            <!-- Status pill -->
            <div style="
                display:flex;
                align-items:center;
                gap:1rem;
                background: <?= $lojaAberta ? 'rgba(76,175,80,0.1)' : 'rgba(229,57,53,0.1)' ?>;
                border: 1px solid <?= $lojaAberta ? 'rgba(76,175,80,0.3)' : 'rgba(229,57,53,0.3)' ?>;
                border-radius: 12px;
                padding: 1.25rem 1.5rem;
                margin-bottom: 1.5rem;
            ">
                <div style="
                    width:48px;height:48px;border-radius:12px;
                    background:<?= $lojaAberta ? 'rgba(76,175,80,0.2)' : 'rgba(229,57,53,0.2)' ?>;
                    display:flex;align-items:center;justify-content:center;
                    font-size:1.375rem;color:<?= $statusColor ?>;
                ">
                    <i class="fa-solid <?= $lojaAberta ? 'fa-store' : 'fa-store-slash' ?>"></i>
                </div>
                <div>
                    <div style="font-size:1.125rem;font-weight:700;color:<?= $statusColor ?>;">
                        Loja <?= $statusText ?>
                    </div>
                    <div style="color:var(--text-secondary);font-size:0.875rem;">
                        <?= $lojaAberta ? 'Aceitando pedidos e agendamentos' : 'Pedidos temporariamente suspensos' ?>
                    </div>
                </div>
            </div>

            <!-- Quick stats -->
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem;">
                <div style="background:rgba(255,255,255,0.04);border:1px solid var(--border-color);border-radius:12px;padding:1rem;text-align:center;">
                    <div style="font-size:1.5rem;font-weight:800;margin-bottom:0.25rem;">
                        <?= isset($pedidosEmAndamento) ? (int)$pedidosEmAndamento : '—' ?>
                    </div>
                    <div style="color:var(--text-secondary);font-size:0.8125rem;">Pedidos em andamento</div>
                </div>
                <div style="background:rgba(255,255,255,0.04);border:1px solid var(--border-color);border-radius:12px;padding:1rem;text-align:center;">
                    <div style="font-size:1.5rem;font-weight:800;margin-bottom:0.25rem;">
                        <?= isset($mesasOcupadas) ? (int)$mesasOcupadas : '—' ?>
                    </div>
                    <div style="color:var(--text-secondary);font-size:0.8125rem;">Mesas ocupadas</div>
                </div>
                <div style="background:rgba(255,255,255,0.04);border:1px solid var(--border-color);border-radius:12px;padding:1rem;text-align:center;">
                    <div style="font-size:1.5rem;font-weight:800;margin-bottom:0.25rem;">
                        <?= isset($funcionariosAtivos) ? (int)$funcionariosAtivos : '—' ?>
                    </div>
                    <div style="color:var(--text-secondary);font-size:0.8125rem;">Funcionários ativos</div>
                </div>
                <div style="background:rgba(255,255,255,0.04);border:1px solid var(--border-color);border-radius:12px;padding:1rem;text-align:center;">
                    <div style="font-size:1.5rem;font-weight:800;margin-bottom:0.25rem;">
                        <?= isset($ticketMedioHoje) ? 'R$ '.number_format($ticketMedioHoje,2,',','.') : '—' ?>
                    </div>
                    <div style="color:var(--text-secondary);font-size:0.8125rem;">Ticket médio hoje</div>
                </div>
            </div>

        </div>
    </div>

</div><!-- .two-col -->