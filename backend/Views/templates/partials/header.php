<?php

use App\Tadala\Core\Flash;

// Contexto atual
$uriPath   = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH);
$userName      = isset($_SESSION['nome']) && is_string($_SESSION['nome']) ? $_SESSION['nome'] : 'Usuário';
$userTipoId       = isset($_SESSION['tipo_usuario_id']) ? $_SESSION['tipo_usuario_id'] : '';
$tipo_nome       = isset($_SESSION['tipo_usuario_nome']) ? $_SESSION['tipo_usuario_nome'] : '';

/**
 *    NÍVEIS DE ACESSO
 *    1 = Apenas administrador
 *    2 = Administrador e funcionário
 */

$menu = [
    1     =>  [2,  ['href'  =>  '/backend/home',            'label' => 'Home',            'icon' => 'fa-home']],
    2     =>  [2,  ['href'  =>  '/backend/cliente',         'label' => 'Clientes',        'icon' => 'fa-users']],
    3     =>  [1,  ['href'  =>  '/backend/cargo',           'label' => 'Cargos',          'icon' => 'fa-briefcase']],
    //4     =>  [ 2,  [ 'href'  =>  '/backend/agendamento',     'label' => 'Agendamentos',    'icon' => 'fa-calendar'       ] ],
    5     =>  [1,  ['href'  =>  '/backend/categoria',       'label' => 'Categorias',      'icon' => 'fa-tags']],
    6     =>  [1,  ['href'  =>  '/backend/funcionarios',    'label' => 'Funcionários',    'icon' => 'fa-address-book']],
    7     =>  [2,  ['href'  =>  '/backend/produtos',        'label' => 'Produtos',        'icon' => 'fa-cubes']],
    //8     =>  [ 1,  [ 'href'  =>  '/backend/promocoes',       'label' => 'Promoções',       'icon' => 'fa-bullhorn'       ] ],
    9     =>  [2,  ['href'   =>  '/backend/pedidos',         'label' => 'Pedidos',         'icon' => 'fa-shopping-basket']],
    10    =>  [1,  ['href'   =>  '/backend/status-store',    'label' => 'Status da loja',  'icon' => 'fa-server']],
];

// $menudrop = [
//   [ 'href' => '/backend/analises/pedidos', 'label' => 'Análises de Pedidos', 'icon' => 'fa-shopping-basket' ],
//   [ 'href' => '/backend/analises/produtos', 'label' => 'Análises de Estoque', 'icon' => 'fa-cubes' ],
//   [ 'href' => '/backend/analises/vendas', 'label' => 'Análises de Vendas', 'icon' => 'fa-money' ],
// ];

// Helpers
$e = fn($v) => htmlspecialchars((string)$v, ENT_QUOTES, 'UTF-8');
$isActive = function (string $current, string $href): bool {
    if ($href === '/') return $current === '/';
    return strpos($current, $href) === 0;
};

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tadallas - Painel Administrativo</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            /* Tadallas Brand Colors */
            --bg-primary: #0a0a0a;
            --bg-secondary: #1a1a1a;
            --bg-card: #242424;
            --bg-card-hover: #2a2a2a;

            --accent-red: #E53935;
            --accent-red-hover: #C62828;
            --accent-red-light: rgba(229, 57, 53, 0.1);

            --accent-gold: #FFD700;
            --accent-gold-dark: #FFA000;

            --text-primary: #ffffff;
            --text-secondary: #b0b0b0;
            --text-muted: #6b6b6b;

            --border-color: rgba(255, 255, 255, 0.1);
            --shadow-sm: 0 2px 8px rgba(0, 0, 0, 0.3);
            --shadow-md: 0 4px 16px rgba(0, 0, 0, 0.4);
            --shadow-lg: 0 8px 32px rgba(0, 0, 0, 0.5);

            --gradient-primary: linear-gradient(135deg, #0a0a0a 0%, #1a0f0f 50%, #2a1515 100%);
            --gradient-card: linear-gradient(135deg, #242424 0%, #2a2020 100%);

            --sidebar-width: 280px;
            --topbar-height: 70px;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: var(--gradient-primary);
            color: var(--text-primary);
            min-height: 100vh;
            position: relative;
            overflow-x: hidden;
        }

        /* Background Pattern */
        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image:
                radial-gradient(circle at 20% 20%, rgba(229, 57, 53, 0.05) 0%, transparent 50%),
                radial-gradient(circle at 80% 80%, rgba(255, 215, 0, 0.03) 0%, transparent 50%);
            pointer-events: none;
            z-index: 0;
        }

        /* Topbar */
        .topbar {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            height: var(--topbar-height);
            background: linear-gradient(135deg, #1a1a1a 0%, #2a1515 100%);
            border-bottom: 2px solid var(--accent-red);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 2rem;
            z-index: 1000;
            box-shadow: var(--shadow-lg);
        }

        .topbar-left {
            display: flex;
            align-items: center;
            gap: 1.5rem;
        }

        .menu-toggle {
            display: none;
            background: none;
            border: none;
            color: var(--text-primary);
            font-size: 1.5rem;
            cursor: pointer;
            padding: 0.5rem;
            transition: color 0.3s ease;
        }

        .menu-toggle:hover {
            color: var(--accent-red);
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            font-size: 1.5rem;
            font-weight: 800;
            color: var(--text-primary);
            text-decoration: none;
            transition: transform 0.3s ease;
        }

        .brand:hover {
            transform: scale(1.05);
        }

        .brand-icon {
            font-size: 2rem;
            filter: drop-shadow(0 0 8px rgba(255, 215, 0, 0.5));
        }

        /* Sidebar */
        .sidebar {
            position: fixed;
            top: var(--topbar-height);
            left: 0;
            width: var(--sidebar-width);
            height: calc(100vh - var(--topbar-height));
            background: var(--gradient-card);
            border-right: 1px solid var(--border-color);
            overflow-y: auto;
            overflow-x: hidden;
            z-index: 999;
            transition: transform 0.3s ease;
            box-shadow: var(--shadow-md);
        }

        .sidebar::-webkit-scrollbar {
            width: 6px;
        }

        .sidebar::-webkit-scrollbar-track {
            background: var(--bg-secondary);
        }

        .sidebar::-webkit-scrollbar-thumb {
            background: var(--accent-red);
            border-radius: 3px;
        }

        /* User Profile Card */
        .user-profile {
            padding: 2rem 1.5rem;
            border-bottom: 1px solid var(--border-color);
            background: rgba(229, 57, 53, 0.05);
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1rem;
        }

        .user-avatar {
            width: 56px;
            height: 56px;
            border-radius: 50%;
            border: 3px solid var(--accent-red);
            box-shadow: 0 0 16px rgba(229, 57, 53, 0.3);
        }

        .user-details h3 {
            font-size: 1rem;
            font-weight: 700;
            margin-bottom: 0.25rem;
            color: var(--text-primary);
        }

        .user-details p {
            font-size: 0.8125rem;
            color: var(--text-secondary);
        }

        .user-actions {
            display: flex;
            gap: 0.5rem;
        }

        .user-action-btn {
            flex: 1;
            padding: 0.5rem;
            background: var(--bg-card);
            border: 1px solid var(--border-color);
            border-radius: 8px;
            color: var(--text-secondary);
            text-decoration: none;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            font-size: 0.875rem;
            transition: all 0.3s ease;
        }

        .user-action-btn:hover {
            background: var(--accent-red);
            color: var(--text-primary);
            border-color: var(--accent-red);
            transform: translateY(-2px);
        }

        /* Menu Section */
        .menu-section {
            padding: 1.5rem 0;
        }

        .menu-section-title {
            padding: 0 1.5rem;
            margin-bottom: 1rem;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: var(--text-muted);
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .menu-item {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 0.875rem 1.5rem;
            color: var(--text-secondary);
            text-decoration: none;
            transition: all 0.3s ease;
            position: relative;
            font-weight: 500;
        }

        .menu-item::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            width: 4px;
            background: var(--accent-red);
            transform: scaleY(0);
            transition: transform 0.3s ease;
        }

        .menu-item:hover,
        .menu-item.active {
            background: rgba(229, 57, 53, 0.1);
            color: var(--text-primary);
        }

        .menu-item:hover::before,
        .menu-item.active::before {
            transform: scaleY(1);
        }

        .menu-item i {
            width: 20px;
            text-align: center;
            font-size: 1.125rem;
        }

        .menu-item.active {
            font-weight: 700;
            color: var(--accent-red);
        }

        /* Dropdown Menu */
        .menu-dropdown {
            margin-top: 0.5rem;
        }

        .dropdown-toggle {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
            padding: 0.875rem 1.5rem;
            color: var(--text-secondary);
            background: none;
            border: none;
            width: 100%;
            text-align: left;
            cursor: pointer;
            transition: all 0.3s ease;
            font-family: inherit;
            font-size: 1rem;
            font-weight: 500;
        }

        .dropdown-toggle:hover {
            background: rgba(229, 57, 53, 0.1);
            color: var(--text-primary);
        }

        .dropdown-toggle-left {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .dropdown-toggle i:first-child {
            width: 20px;
            text-align: center;
            font-size: 1.125rem;
        }

        .dropdown-arrow {
            transition: transform 0.3s ease;
        }

        .dropdown-toggle.active .dropdown-arrow {
            transform: rotate(180deg);
        }

        .dropdown-content {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease;
            background: rgba(0, 0, 0, 0.2);
        }

        .dropdown-content.show {
            max-height: 500px;
        }

        .dropdown-item {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 0.75rem 1.5rem 0.75rem 3.5rem;
            color: var(--text-secondary);
            text-decoration: none;
            transition: all 0.3s ease;
            font-size: 0.9375rem;
        }

        .dropdown-item:hover {
            background: rgba(229, 57, 53, 0.1);
            color: var(--text-primary);
            padding-left: 4rem;
        }

        /* Main Content */
        .main-content {
            margin-left: var(--sidebar-width);
            margin-top: var(--topbar-height);
            min-height: calc(100vh - var(--topbar-height));
            position: relative;
            z-index: 1;
        }

        .content-wrapper {
            padding: 2rem;
        }

        /* Flash Messages */
        .flash-messages {
            margin-bottom: 2rem;
        }

        .flash-message {
            padding: 1rem 1.5rem;
            border-radius: 12px;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            animation: slideInDown 0.4s ease-out;
            box-shadow: var(--shadow-md);
        }

        @keyframes slideInDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .flash-message.success {
            background: linear-gradient(135deg, rgba(76, 175, 80, 0.2), rgba(76, 175, 80, 0.1));
            border: 1px solid rgba(76, 175, 80, 0.3);
            color: #4CAF50;
        }

        .flash-message.error {
            background: linear-gradient(135deg, rgba(229, 57, 53, 0.2), rgba(229, 57, 53, 0.1));
            border: 1px solid rgba(229, 57, 53, 0.3);
            color: var(--accent-red);
        }

        .flash-message.warning {
            background: linear-gradient(135deg, rgba(255, 193, 7, 0.2), rgba(255, 193, 7, 0.1));
            border: 1px solid rgba(255, 193, 7, 0.3);
            color: #FFC107;
        }

        .flash-message.info {
            background: linear-gradient(135deg, rgba(33, 150, 243, 0.2), rgba(33, 150, 243, 0.1));
            border: 1px solid rgba(33, 150, 243, 0.3);
            color: #2196F3;
        }

        .flash-message-content {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .flash-close {
            background: none;
            border: none;
            color: inherit;
            font-size: 1.5rem;
            cursor: pointer;
            padding: 0.25rem;
            opacity: 0.7;
            transition: opacity 0.3s ease;
        }

        .flash-close:hover {
            opacity: 1;
        }

        /* Mobile Responsive */
        @media (max-width: 992px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.show {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
            }

            .menu-toggle {
                display: block;
            }

            .topbar {
                padding: 0 1rem;
            }

            .content-wrapper {
                padding: 1rem;
            }
        }

        /* Overlay for mobile */
        .sidebar-overlay {
            display: none;
            position: fixed;
            top: var(--topbar-height);
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.7);
            z-index: 998;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .sidebar-overlay.show {
            display: block;
            opacity: 1;
        }


        /* ── Flash Toast ──────────────────────────────── */
        .toast {
            position: fixed;
            top: 6rem;
            right: 1.25rem;
            z-index: 9999;
            display: flex;
            align-items: flex-start;
            gap: 0.75rem;
            padding: 1rem 1.25rem;
            border-radius: var(--radius-md);
            border: 1px solid transparent;
            max-width: 380px;
            width: calc(100% - 2.5rem);
            box-shadow: var(--shadow-lg);
            animation: toastIn 0.35s cubic-bezier(0.22, 1, 0.36, 1) both;
            font-size: 0.9375rem;
            line-height: 1.4;
        }

        @keyframes toastIn {
            from {
                opacity: 0;
                transform: translateX(30px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes toastOut {
            from {
                opacity: 1;
                transform: translateX(0);
            }

            to {
                opacity: 0;
                transform: translateX(30px);
            }
        }

        .toast.hide {
            animation: toastOut 0.3s cubic-bezier(0.4, 0, 1, 1) forwards;
        }

        .toast--error {
            background: #1f1010;
            border-color: rgba(229, 57, 53, 0.45);
            color: #ffcdd2;
        }

        .toast--success {
            background: #0e1f12;
            border-color: rgba(67, 160, 71, 0.45);
            color: #c8e6c9;
        }

        .toast__icon {
            flex-shrink: 0;
            width: 20px;
            height: 20px;
            margin-top: 1px;
            fill: currentColor;
        }

        .toast--error .toast__icon {
            color: #ef5350;
        }

        .toast--success .toast__icon {
            color: #66bb6a;
        }

        .toast__body {
            flex: 1;
        }

        .toast__close {
            flex-shrink: 0;
            background: none;
            border: none;
            cursor: pointer;
            padding: 0;
            color: inherit;
            opacity: 0.5;
            transition: opacity 0.2s;
            display: flex;
            align-items: center;
        }

        .toast__close:hover {
            opacity: 1;
        }

        .toast__close svg {
            width: 16px;
            height: 16px;
            fill: currentColor;
        }
    </style>
</head>

<body>
    <!-- Topbar -->
    <header class="topbar">
        <div class="topbar-left">
            <button class="menu-toggle" onclick="toggleSidebar()" aria-label="Abrir menu">
                <i class="fa-solid fa-bars"></i>
            </button>
            <a href="/backend" class="brand">
                <span class="brand-icon">🍔</span>
                <span>Tadallas</span>
            </a>
        </div>
    </header>

    <!-- Sidebar -->
    <nav class="sidebar" id="sidebar">
        <!-- User Profile -->
        <div class="user-profile">
            <div class="user-info">
                <img
                    class="user-avatar"
                    alt="Avatar"
                    src="https://ui-avatars.com/api/?name=<?= urlencode($userName) ?>&background=E53935&color=fff&size=112&bold=true">
                <div class="user-details">
                    <h3><?= $e($userName) ?></h3>
                    <p>Bem-vindo(a) de volta</p>
                </div>
            </div>
            <!-- <div class="user-actions">
                <a href="/backend/configuracao" class="user-action-btn" title="Configurações">
                    <i class="fa-solid fa-gear"></i>
                    <span>Configurações</span>
                </a>
            </div> -->
        </div>

        <!-- Menu Section -->
        <div class="menu-section">
            <div class="menu-section-title">
                <i class="fa-solid fa-gauge"></i>
                Dashboard
            </div>

            <?php
            foreach ($menu as $option):
                $accessLevel  = $option[0];
                $item         = $option[1];

                if ($accessLevel >= $userTipoId):
                    $active = $isActive($uriPath, $item['href']);
                    $classes = 'menu-item';
                    if ($active) $classes .= ' active';
            ?>
                    <a href="<?= $e($item['href']) ?>" class="<?= $e($classes) ?>">
                        <i class="fa-solid <?= $e($item['icon']) ?>"></i>
                        <span><?= $e($item['label']) ?></span>
                    </a>
            <?php
                endif;
            endforeach;
            ?>

            <!-- Dropdown Menu -->
            <!-- <div class="menu-dropdown">
                <button class="dropdown-toggle" onclick="toggleDropdown(this)">
                    <div class="dropdown-toggle-left">
                        <i class="fa-solid fa-chart-line"></i>
                        <span>Análises</span>
                    </div>
                    <i class="fa-solid fa-chevron-down dropdown-arrow"></i>
                </button>
                <div class="dropdown-content">
                    <php //foreach ($menudrop as $item): ?>
                        <a href="<= $e($item['href']) ?>" class="dropdown-item">
                            <i class="fa-solid <= // $e($item['icon']) ?>"></i>
                            <span><= // $e($item['label']) ?></span>
                        </a>
                    <php endforeach ?>
                </div>
            </div> -->
        </div>
    </nav>

    <!-- Sidebar Overlay (Mobile) -->
    <div class="sidebar-overlay" id="sidebarOverlay" onclick="toggleSidebar()"></div>

    <!-- Main Content -->
    <main class="main-content">
        <div class="content-wrapper">
            <?php
            $mensagem = Flash::getAll();
            // var_dump($mensagem);
            // exit;
            if (isset($mensagem) && !empty($mensagem['message'])):
                $flashType    = htmlspecialchars($mensagem['type']    ?? 'info', ENT_QUOTES);
                $flashMessage = htmlspecialchars($mensagem['message'] ?? '',      ENT_QUOTES);
            ?>
                <div class="toast toast--<?php echo $flashType; ?>" id="flash-toast" role="alert" aria-live="assertive">
                    <?php if ($flashType === 'error'): ?>
                        <svg class="toast__icon" viewBox="0 0 24 24" aria-hidden="true">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z" />
                        </svg>
                    <?php else: ?>
                        <svg class="toast__icon" viewBox="0 0 24 24" aria-hidden="true">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 14.5v-9l6 4.5-6 4.5z" />
                            <path d="M10 16.5v-9l6 4.5-6 4.5z" style="display:none" />
                            <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z" />
                        </svg>
                    <?php endif; ?>
                    <span class="toast__body"><?php echo $flashMessage; ?></span>
                    <button class="toast__close" aria-label="Fechar notificação" onclick="dismissToast()">
                        <svg viewBox="0 0 24 24" aria-hidden="true">
                            <path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z" />
                        </svg>
                    </button>
                </div>
            <?php endif; ?>

            <!-- Page content continues here -->
            <script>
                function toggleSidebar() {
                    const sidebar = document.getElementById('sidebar');
                    const overlay = document.getElementById('sidebarOverlay');
                    sidebar.classList.toggle('show');
                    overlay.classList.toggle('show');
                }

                function toggleDropdown(button) {
                    button.classList.toggle('active');
                    const content = button.nextElementSibling;
                    content.classList.toggle('show');
                }

                // ── Flash Toast ──
                function dismissToast() {
                    const toast = document.getElementById('flash-toast');
                    if (!toast) return;
                    toast.classList.add('hide');
                    toast.addEventListener('animationend', () => toast.remove(), {
                        once: true
                    });
                }

                (function() {
                    const toast = document.getElementById('flash-toast');
                    if (toast) setTimeout(dismissToast, 5000);
                })();
            </script>