<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrinho - Tadallas</title>
    <link rel="stylesheet" href="assets/css/style.css" />
    <style>
        :root {
            --bg: #121212;
            --card: #1c1c1c;
            --text: #f5f5f5;
            --muted: #cfcfcf;
            --accent: #e63946;
            --accent-strong: #d62839;
            --border: #2a2a2a;
            --success: #22c55e;
            --warning: #ffd60a;
        }
        * { box-sizing: border-box; }
        body { 
            background: var(--bg); 
            color: var(--text);
            font-family: "Inter", "Segoe UI", Arial, sans-serif;
            margin: 0;
        }

        .cart-page { 
            max-width: 1100px; 
            margin: 0 auto; 
            padding: 28px 20px 60px; 
        }

        .cart-header { 
            display: flex; 
            align-items: center; 
            justify-content: space-between; 
            gap: 16px; 
            flex-wrap: wrap;
            margin-bottom: 24px;
        }
        .cart-header h1 { margin: 0; font-weight: 800; }

        .btn-back {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: var(--card);
            color: var(--text);
            border: 1px solid var(--border);
            padding: 10px 18px;
            border-radius: 12px;
            text-decoration: none;
            font-weight: 600;
            transition: all .2s;
        }
        .btn-back:hover { border-color: var(--accent); }
        .btn-back svg { width: 18px; height: 18px; fill: currentColor; }

        .checkout-grid {
            display: grid;
            grid-template-columns: 1fr 380px;
            gap: 24px;
        }

        @media (max-width: 900px) {
            .checkout-grid {
                grid-template-columns: 1fr;
            }
        }

        .checkout-section {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 16px;
            padding: 24px;
            margin-bottom: 20px;
        }

        .section-title {
            font-size: 18px;
            font-weight: 700;
            margin: 0 0 16px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .section-title .step {
            width: 28px;
            height: 28px;
            border-radius: 50%;
            background: var(--accent);
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            font-weight: 700;
        }

        /* Auth Status */
        .auth-box {
            background: rgba(255,214,10,.1);
            border: 1px solid rgba(255,214,10,.3);
            border-radius: 12px;
            padding: 14px 18px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            flex-wrap: wrap;
        }
        .auth-box.logged-in {
            background: rgba(34,197,94,.1);
            border-color: rgba(34,197,94,.3);
        }
        .auth-status { font-weight: 600; }
        .auth-actions { display: flex; gap: 8px; }

        /* Order Type Selection */
        .order-type-options {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 12px;
        }
        @media (max-width: 600px) {
            .order-type-options {
                grid-template-columns: 1fr;
            }
        }
        .order-type-btn {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 8px;
            padding: 20px 16px;
            background: var(--bg);
            border: 2px solid var(--border);
            border-radius: 12px;
            cursor: pointer;
            transition: all .2s;
            color: var(--text);
        }
        .order-type-btn:hover {
            border-color: var(--accent);
        }
        .order-type-btn.selected {
            border-color: var(--accent);
            background: rgba(230,57,70,.1);
        }
        .order-type-btn svg {
            width: 32px;
            height: 32px;
            fill: var(--accent);
        }
        .order-type-btn .type-name {
            font-weight: 600;
            font-size: 14px;
        }
        .order-type-btn .type-desc {
            font-size: 12px;
            color: var(--muted);
            text-align: center;
        }

        /* Address Form */
        .address-section {
            display: none;
        }
        .address-section.show {
            display: block;
        }
        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
            margin-bottom: 12px;
        }
        .form-row.full {
            grid-template-columns: 1fr;
        }
        .form-group {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }
        .form-group label {
            font-size: 13px;
            font-weight: 600;
            color: var(--muted);
        }
        .form-group input {
            background: var(--bg);
            border: 1px solid var(--border);
            border-radius: 10px;
            padding: 12px 14px;
            color: var(--text);
            font-size: 14px;
            font-family: inherit;
            transition: border-color .2s;
        }
        .form-group input:focus {
            outline: none;
            border-color: var(--accent);
        }
        .form-group input::placeholder {
            color: #666;
        }

        /* Payment Methods */
        .payment-options {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
        .payment-btn {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 16px;
            background: var(--bg);
            border: 2px solid var(--border);
            border-radius: 12px;
            cursor: pointer;
            transition: all .2s;
            color: var(--text);
        }
        .payment-btn:hover {
            border-color: var(--accent);
        }
        .payment-btn.selected {
            border-color: var(--accent);
            background: rgba(230,57,70,.1);
        }
        .payment-btn .payment-icon {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            background: var(--card);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }
        .payment-btn .payment-icon svg {
            width: 22px;
            height: 22px;
            fill: var(--accent);
        }
        .payment-btn .payment-info {
            flex: 1;
        }
        .payment-btn .payment-name {
            font-weight: 600;
            font-size: 15px;
        }
        .payment-btn .payment-desc {
            font-size: 12px;
            color: var(--muted);
            margin-top: 2px;
        }
        .payment-btn .payment-check {
            width: 24px;
            height: 24px;
            border-radius: 50%;
            border: 2px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all .2s;
        }
        .payment-btn.selected .payment-check {
            background: var(--accent);
            border-color: var(--accent);
        }
        .payment-btn .payment-check svg {
            width: 14px;
            height: 14px;
            fill: #fff;
            opacity: 0;
        }
        .payment-btn.selected .payment-check svg {
            opacity: 1;
        }

        /* Troco Section */
        .troco-section {
            display: none;
            margin-top: 16px;
            padding: 16px;
            background: var(--bg);
            border-radius: 12px;
        }
        .troco-section.show {
            display: block;
        }
        .troco-section label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            font-size: 14px;
        }
        .troco-section input {
            width: 100%;
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 10px;
            padding: 12px 14px;
            color: var(--text);
            font-size: 14px;
            font-family: inherit;
        }

        /* Order Summary */
        .summary-sticky {
            position: sticky;
            top: 20px;
        }
        .summary-items {
            max-height: 300px;
            overflow-y: auto;
            margin-bottom: 16px;
        }
        .summary-items::-webkit-scrollbar { width: 4px; }
        .summary-items::-webkit-scrollbar-thumb { background: #333; border-radius: 4px; }

        .summary-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 0;
            border-bottom: 1px solid var(--border);
        }
        .summary-item:last-child {
            border-bottom: none;
        }
        .summary-item-img {
            width: 50px;
            height: 50px;
            border-radius: 10px;
            object-fit: cover;
            background: var(--bg);
            flex-shrink: 0;
        }
        .summary-item-info {
            flex: 1;
            min-width: 0;
        }
        .summary-item-name {
            font-weight: 600;
            font-size: 14px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .summary-item-qty {
            font-size: 13px;
            color: var(--muted);
        }
        .summary-item-price {
            font-weight: 700;
            color: var(--warning);
            font-size: 14px;
        }

        .summary-empty {
            text-align: center;
            padding: 30px;
            color: var(--muted);
        }

        .summary-totals {
            border-top: 1px solid var(--border);
            padding-top: 16px;
        }
        .summary-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
            font-size: 14px;
        }
        .summary-row.total {
            font-size: 18px;
            font-weight: 700;
            margin-top: 12px;
            padding-top: 12px;
            border-top: 1px dashed var(--border);
        }
        .summary-row.total .value {
            color: var(--warning);
        }

        .btn-finalizar {
            width: 100%;
            background: var(--accent);
            color: #fff;
            border: none;
            padding: 16px;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 700;
            cursor: pointer;
            margin-top: 16px;
            transition: all .2s;
            font-family: inherit;
        }
        .btn-finalizar:hover:not(:disabled) {
            background: var(--accent-strong);
            transform: translateY(-1px);
        }
        .btn-finalizar:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        .btn-link {
            display: inline-block;
            color: var(--accent);
            text-decoration: none;
            font-weight: 600;
            margin-top: 12px;
            text-align: center;
            width: 100%;
        }
        .btn-link:hover {
            text-decoration: underline;
        }

        /* Loading */
        .loading-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,.8);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 9999;
        }
        .loading-overlay.show {
            display: flex;
        }
        .loading-content {
            text-align: center;
        }
        .spinner {
            width: 50px;
            height: 50px;
            border: 4px solid var(--border);
            border-top-color: var(--accent);
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin: 0 auto 16px;
        }
        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        /* Success Modal */
        .success-modal {
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,.8);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 9999;
            padding: 20px;
        }
        .success-modal.show {
            display: flex;
        }
        .success-content {
            background: var(--card);
            border-radius: 20px;
            padding: 40px;
            text-align: center;
            max-width: 400px;
            width: 100%;
            animation: popIn .3s ease;
        }
        @keyframes popIn {
            from { transform: scale(0.9); opacity: 0; }
            to { transform: scale(1); opacity: 1; }
        }
        .success-icon {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: rgba(34,197,94,.15);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
        }
        .success-icon svg {
            width: 40px;
            height: 40px;
            fill: var(--success);
        }
        .success-title {
            font-size: 24px;
            font-weight: 800;
            margin: 0 0 10px;
        }
        .success-message {
            color: var(--muted);
            margin: 0 0 24px;
            line-height: 1.6;
        }
        .success-order-id {
            font-size: 32px;
            font-weight: 800;
            color: var(--warning);
            margin-bottom: 24px;
        }
        .success-btn {
            background: var(--accent);
            color: #fff;
            border: none;
            padding: 14px 32px;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 700;
            cursor: pointer;
            font-family: inherit;
        }
    </style>
</head>
<body>
    <?php 
        if (isset($_SESSION['usuario_id'])) {
            echo '<input type="hidden" id="usuario_id" value="' . htmlspecialchars($_SESSION['usuario_id'] ?? '') . '">';
        }
    ?>
    
    <main class="cart-page">
        <div class="cart-header">
            <h1>Finalizar Pedido</h1>
            <a href="cardapio.php" class="btn-back">
                <svg viewBox="0 0 24 24"><path d="M15.41 7.41L14 6l-6 6 6 6 1.41-1.41L10.83 12z"/></svg>
                Voltar ao cardápio
            </a>
        </div>

        <!-- Auth Status -->
        <div class="auth-box" id="auth-box">
            <span class="auth-status" id="auth-status">Verificando login...</span>
            <div class="auth-actions" id="auth-actions"></div>
        </div>

        <div class="checkout-grid">
            <div class="checkout-main">
                <!-- Tipo de Pedido -->
                <section class="checkout-section">
                    <h2 class="section-title">
                        <span class="step">1</span>
                        Tipo de Pedido
                    </h2>
                    <div class="order-type-options" id="order-type-options">
                        <button type="button" class="order-type-btn" data-type="1">
                            <svg viewBox="0 0 24 24"><path d="M11 9H9V2H7v7H5V2H3v7c0 2.12 1.66 3.84 3.75 3.97V22h2.5v-9.03C11.34 12.84 13 11.12 13 9V2h-2v7zm5-3v8h2.5v8H21V2c-2.76 0-5 2.24-5 4z"/></svg>
                            <span class="type-name">Comer no Local</span>
                            <span class="type-desc">Consumir no restaurante</span>
                        </button>
                        <button type="button" class="order-type-btn" data-type="2">
                            <svg viewBox="0 0 24 24"><path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-7 14l-5-5 1.41-1.41L12 14.17l4.59-4.58L18 11l-6 6z"/></svg>
                            <span class="type-name">Retirar no Local</span>
                            <span class="type-desc">Você busca o pedido</span>
                        </button>
                        <button type="button" class="order-type-btn" data-type="3">
                            <svg viewBox="0 0 24 24"><path d="M18.92 6.01C18.72 5.42 18.16 5 17.5 5h-11c-.66 0-1.21.42-1.42 1.01L3 12v8c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-1h12v1c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-8l-2.08-5.99zM6.5 16c-.83 0-1.5-.67-1.5-1.5S5.67 13 6.5 13s1.5.67 1.5 1.5S7.33 16 6.5 16zm11 0c-.83 0-1.5-.67-1.5-1.5s.67-1.5 1.5-1.5 1.5.67 1.5 1.5-.67 1.5-1.5 1.5zM5 11l1.5-4.5h11L19 11H5z"/></svg>
                            <span class="type-name">Delivery</span>
                            <span class="type-desc">Entrega no seu endereço</span>
                        </button>
                    </div>
                </section>

                <!-- Endereço (só para Delivery) -->
                <section class="checkout-section address-section" id="address-section">
                    <h2 class="section-title">
                        <span class="step">2</span>
                        Endereço de Entrega
                    </h2>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="cep">CEP</label>
                            <input type="text" id="cep" placeholder="00000-000" maxlength="9">
                        </div>
                        <div class="form-group">
                            <label for="numero">Número *</label>
                            <input type="text" id="numero" placeholder="Nº">
                        </div>
                    </div>
                    <div class="form-row full">
                        <div class="form-group">
                            <label for="rua">Rua *</label>
                            <input type="text" id="rua" placeholder="Nome da rua">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="bairro">Bairro *</label>
                            <input type="text" id="bairro" placeholder="Bairro">
                        </div>
                        <div class="form-group">
                            <label for="cidade">Cidade *</label>
                            <input type="text" id="cidade" placeholder="Cidade">
                        </div>
                    </div>
                    <div class="form-row full">
                        <div class="form-group">
                            <label for="estado">Estado</label>
                            <input type="text" id="estado" placeholder="UF" maxlength="2">
                        </div>
                    </div>
                    <div class="form-row full">
                        <div class="form-group">
                            <label for="complemento">Complemento / Referência</label>
                            <input type="text" id="complemento" placeholder="Apto, bloco, ponto de referência...">
                        </div>
                    </div>
                </section>

                <!-- Método de Pagamento -->
                <section class="checkout-section">
                    <h2 class="section-title">
                        <span class="step" id="step-pagamento">2</span>
                        Forma de Pagamento
                    </h2>
                    <div class="payment-options" id="payment-options">
                        <button type="button" class="payment-btn" data-method="1">
                            <div class="payment-icon">
                                <svg viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/></svg>
                            </div>
                            <div class="payment-info">
                                <div class="payment-name">PIX</div>
                                <div class="payment-desc">Pagamento instantâneo</div>
                            </div>
                            <div class="payment-check">
                                <svg viewBox="0 0 24 24"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg>
                            </div>
                        </button>
                        <button type="button" class="payment-btn" data-method="2">
                            <div class="payment-icon">
                                <svg viewBox="0 0 24 24"><path d="M20 4H4c-1.11 0-1.99.89-1.99 2L2 18c0 1.11.89 2 2 2h16c1.11 0 2-.89 2-2V6c0-1.11-.89-2-2-2zm0 14H4v-6h16v6zm0-10H4V6h16v2z"/></svg>
                            </div>
                            <div class="payment-info">
                                <div class="payment-name">Cartão de Crédito</div>
                                <div class="payment-desc">Pague na entrega/retirada</div>
                            </div>
                            <div class="payment-check">
                                <svg viewBox="0 0 24 24"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg>
                            </div>
                        </button>
                        <button type="button" class="payment-btn" data-method="3">
                            <div class="payment-icon">
                                <svg viewBox="0 0 24 24"><path d="M20 4H4c-1.11 0-1.99.89-1.99 2L2 18c0 1.11.89 2 2 2h16c1.11 0 2-.89 2-2V6c0-1.11-.89-2-2-2zm0 14H4v-6h16v6zm0-10H4V6h16v2z"/></svg>
                            </div>
                            <div class="payment-info">
                                <div class="payment-name">Cartão de Débito</div>
                                <div class="payment-desc">Pague na entrega/retirada</div>
                            </div>
                            <div class="payment-check">
                                <svg viewBox="0 0 24 24"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg>
                            </div>
                        </button>
                        <button type="button" class="payment-btn" data-method="4">
                            <div class="payment-icon">
                                <svg viewBox="0 0 24 24"><path d="M21 18v1c0 1.1-.9 2-2 2H5c-1.11 0-2-.9-2-2V5c0-1.1.89-2 2-2h14c1.1 0 2 .9 2 2v1h-9c-1.11 0-2 .9-2 2v8c0 1.1.89 2 2 2h9zm-9-2h10V8H12v8zm4-2.5c-.83 0-1.5-.67-1.5-1.5s.67-1.5 1.5-1.5 1.5.67 1.5 1.5-.67 1.5-1.5 1.5z"/></svg>
                            </div>
                            <div class="payment-info">
                                <div class="payment-name">Benefícios</div>
                                <div class="payment-desc">Vale Refeição, Alimentação</div>
                            </div>
                            <div class="payment-check">
                                <svg viewBox="0 0 24 24"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg>
                            </div>
                        </button>
                        <button type="button" class="payment-btn" data-method="5">
                            <div class="payment-icon">
                                <svg viewBox="0 0 24 24"><path d="M11.8 10.9c-2.27-.59-3-1.2-3-2.15 0-1.09 1.01-1.85 2.7-1.85 1.78 0 2.44.85 2.5 2.1h2.21c-.07-1.72-1.12-3.3-3.21-3.81V3h-3v2.16c-1.94.42-3.5 1.68-3.5 3.61 0 2.31 1.91 3.46 4.7 4.13 2.5.6 3 1.48 3 2.41 0 .69-.49 1.79-2.7 1.79-2.06 0-2.87-.92-2.98-2.1h-2.2c.12 2.19 1.76 3.42 3.68 3.83V21h3v-2.15c1.95-.37 3.5-1.5 3.5-3.55 0-2.84-2.43-3.81-4.7-4.4z"/></svg>
                            </div>
                            <div class="payment-info">
                                <div class="payment-name">Dinheiro</div>
                                <div class="payment-desc">Pague na entrega/retirada</div>
                            </div>
                            <div class="payment-check">
                                <svg viewBox="0 0 24 24"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg>
                            </div>
                        </button>
                    </div>

                    <!-- Troco (só para Dinheiro) -->
                    <div class="troco-section" id="troco-section">
                        <label for="troco">Precisa de troco para quanto?</label>
                        <input type="text" id="troco" placeholder="Ex: R$ 50,00 (deixe vazio se não precisar)">
                    </div>
                </section>
            </div>

            <!-- Resumo do Pedido -->
            <div class="checkout-summary">
                <div class="summary-sticky">
                    <section class="checkout-section">
                        <h2 class="section-title">Resumo do Pedido</h2>
                        
                        <div class="summary-items" id="summary-items">
                            <div class="summary-empty">Seu carrinho está vazio</div>
                        </div>

                        <div class="summary-totals">
                            <div class="summary-row">
                                <span>Subtotal</span>
                                <span id="subtotal">R$ 0,00</span>
                            </div>
                            <div class="summary-row" id="delivery-fee-row" style="display: none;">
                                <span>Taxa de Entrega</span>
                                <span id="delivery-fee">R$ 5,00</span>
                            </div>
                            <div class="summary-row total">
                                <span>Total</span>
                                <span class="value" id="total">R$ 0,00</span>
                            </div>
                        </div>

                        <button type="button" class="btn-finalizar" id="btn-finalizar" disabled>
                            Finalizar Pedido
                        </button>

                        <a href="cardapio.php" class="btn-link">Adicionar mais itens</a>
                    </section>
                </div>
            </div>
        </div>
    </main>

    <!-- Loading Overlay -->
    <div class="loading-overlay" id="loading-overlay">
        <div class="loading-content">
            <div class="spinner"></div>
            <p>Processando seu pedido...</p>
        </div>
    </div>

    <!-- Success Modal -->
    <div class="success-modal" id="success-modal">
        <div class="success-content">
            <div class="success-icon">
                <svg viewBox="0 0 24 24"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg>
            </div>
            <h2 class="success-title">Pedido Confirmado!</h2>
            <p class="success-message">Seu pedido foi recebido e está sendo preparado.</p>
            <div class="success-order-id">Nº <span id="order-number">0000</span></div>
            <button type="button" class="success-btn" id="success-btn">Voltar ao Cardápio</button>
        </div>
    </div>

    <script>
        const STORAGE_KEY = 'carrinhoTadallas';
        const TAXA_ENTREGA = 5.00;

        // Estado
        let carrinho = [];
        let usuario = null;
        let tipoPedidoSelecionado = null;
        let metodoPagamentoSelecionado = null;

        // Elementos
        const authBox = document.getElementById('auth-box');
        const authStatus = document.getElementById('auth-status');
        const authActions = document.getElementById('auth-actions');
        const orderTypeOptions = document.getElementById('order-type-options');
        const addressSection = document.getElementById('address-section');
        const paymentOptions = document.getElementById('payment-options');
        const trocoSection = document.getElementById('troco-section');
        const summaryItems = document.getElementById('summary-items');
        const subtotalEl = document.getElementById('subtotal');
        const deliveryFeeRow = document.getElementById('delivery-fee-row');
        const totalEl = document.getElementById('total');
        const btnFinalizar = document.getElementById('btn-finalizar');
        const loadingOverlay = document.getElementById('loading-overlay');
        const successModal = document.getElementById('success-modal');
        const orderNumber = document.getElementById('order-number');
        const stepPagamento = document.getElementById('step-pagamento');

        // Funções auxiliares
        function formatPrice(value) {
            return Number(value || 0).toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
        }

        function obterCarrinho() {
            try {
                const raw = localStorage.getItem(STORAGE_KEY);
                return raw ? JSON.parse(raw) : [];
            } catch (e) {
                return [];
            }
        }

        // Renderizar carrinho
        function renderizarResumo() {
            carrinho = obterCarrinho();
            
            if (!carrinho.length) {
                summaryItems.innerHTML = '<div class="summary-empty">Seu carrinho está vazio</div>';
                subtotalEl.textContent = formatPrice(0);
                totalEl.textContent = formatPrice(0);
                btnFinalizar.disabled = true;
                return;
            }

            let subtotal = 0;
            summaryItems.innerHTML = carrinho.map(item => {
                const itemTotal = item.preco * item.quantidade;
                subtotal += itemTotal;
                const imgHtml = item.imagem
                    ? `<img class="summary-item-img" src="${item.imagem}" alt="${item.nome}">`
                    : `<div class="summary-item-img" style="display:flex;align-items:center;justify-content:center;font-size:18px;background:var(--bg);">🍔</div>`;
                return `
                    <div class="summary-item">
                        ${imgHtml}
                        <div class="summary-item-info">
                            <div class="summary-item-name">${item.nome}</div>
                            <div class="summary-item-qty">${item.quantidade}x ${formatPrice(item.preco)}</div>
                        </div>
                        <div class="summary-item-price">${formatPrice(itemTotal)}</div>
                    </div>
                `;
            }).join('');

            subtotalEl.textContent = formatPrice(subtotal);
            atualizarTotal();
            validarFormulario();
        }

        function atualizarTotal() {
            const subtotal = carrinho.reduce((acc, item) => acc + (item.preco * item.quantidade), 0);
            let total = subtotal;

            if (tipoPedidoSelecionado === 3) {
                deliveryFeeRow.style.display = 'flex';
                total += TAXA_ENTREGA;
            } else {
                deliveryFeeRow.style.display = 'none';
            }

            totalEl.textContent = formatPrice(total);
        }

        // Verificar autenticação
        async function verificarAuth() {
            try {
                const resp = await fetch('/backend/me');
                const data = await resp.json();
                
                if (data && data.logged_in) {
                    usuario = data;
                    authBox.classList.add('logged-in');
                    authStatus.textContent = `Olá, ${data.nome || 'Usuário'}! (${data.email || ''})`;
                    authActions.innerHTML = `
                        <a href="/backend/logout" class="btn-back" style="padding:8px 14px;font-size:13px;">Sair</a>
                    `;
                    
                    // Carregar endereço salvo
                    carregarEnderecoSalvo();
                } else {
                    usuario = null;
                    authStatus.textContent = 'Faça login para finalizar seu pedido';
                    authActions.innerHTML = `
                        <a href="/backend/login?redirect=/carrinho.php" class="btn-back" style="background:var(--accent);border-color:var(--accent);padding:8px 14px;font-size:13px;">Entrar</a>
                        <a href="/backend/register?redirect=/carrinho.php" class="btn-back" style="padding:8px 14px;font-size:13px;">Cadastrar</a>
                    `;
                }
                
                validarFormulario();
            } catch (e) {
                usuario = null;
                authStatus.textContent = 'Erro ao verificar login';
            }
        }

        // Carregar endereço salvo
        async function carregarEnderecoSalvo() {
            try {
                const resp = await fetch('/backend/api/meu-endereco');
                const data = await resp.json();
                
                if (data.status === 'success' && data.data) {
                    document.getElementById('rua').value = data.data.rua || '';
                    document.getElementById('numero').value = data.data.numero || '';
                    document.getElementById('bairro').value = data.data.bairro || '';
                    document.getElementById('cidade').value = data.data.cidade || '';
                    document.getElementById('estado').value = data.data.estado || '';
                    document.getElementById('cep').value = data.data.cep || '';
                }
            } catch (e) {
                console.log('Endereço não encontrado');
            }
        }

        // Selecionar tipo de pedido
        orderTypeOptions.addEventListener('click', (e) => {
            const btn = e.target.closest('.order-type-btn');
            if (!btn) return;

            document.querySelectorAll('.order-type-btn').forEach(b => b.classList.remove('selected'));
            btn.classList.add('selected');
            tipoPedidoSelecionado = parseInt(btn.dataset.type);

            // Mostrar/esconder endereço
            if (tipoPedidoSelecionado === 3) {
                addressSection.classList.add('show');
                stepPagamento.textContent = '3';
            } else {
                addressSection.classList.remove('show');
                stepPagamento.textContent = '2';
            }

            atualizarTotal();
            validarFormulario();
        });

        // Selecionar método de pagamento
        paymentOptions.addEventListener('click', (e) => {
            const btn = e.target.closest('.payment-btn');
            if (!btn) return;

            document.querySelectorAll('.payment-btn').forEach(b => b.classList.remove('selected'));
            btn.classList.add('selected');
            metodoPagamentoSelecionado = parseInt(btn.dataset.method);

            // Mostrar/esconder troco
            if (metodoPagamentoSelecionado === 5) {
                trocoSection.classList.add('show');
            } else {
                trocoSection.classList.remove('show');
            }

            validarFormulario();
        });

        // Validar formulário
        function validarFormulario() {
            let valido = true;

            // Verificar login
            if (!usuario) valido = false;

            // Verificar carrinho
            if (!carrinho.length) valido = false;

            // Verificar tipo de pedido
            if (!tipoPedidoSelecionado) valido = false;

            // Verificar endereço (se for delivery)
            if (tipoPedidoSelecionado === 3) {
                const rua = document.getElementById('rua').value.trim();
                const numero = document.getElementById('numero').value.trim();
                const bairro = document.getElementById('bairro').value.trim();
                const cidade = document.getElementById('cidade').value.trim();
                
                if (!rua || !numero || !bairro || !cidade) valido = false;
            }

            // Verificar método de pagamento
            if (!metodoPagamentoSelecionado) valido = false;

            btnFinalizar.disabled = !valido;
            return valido;
        }

        // Eventos dos campos de endereço
        ['rua', 'numero', 'bairro', 'cidade', 'estado', 'cep'].forEach(id => {
            document.getElementById(id).addEventListener('input', validarFormulario);
        });

        // Máscara CEP
        document.getElementById('cep').addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            if (value.length > 5) {
                value = value.substring(0, 5) + '-' + value.substring(5, 8);
            }
            e.target.value = value;
        });

        // Finalizar pedido
        btnFinalizar.addEventListener('click', async () => {
            if (!validarFormulario()) {
                alert('Preencha todos os campos obrigatórios.');
                return;
            }

            loadingOverlay.classList.add('show');

            try {
                // Salvar endereço se for delivery
                if (tipoPedidoSelecionado === 3) {
                    await fetch('/backend/api/salvar-endereco', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json' },
                        body: JSON.stringify({
                            rua: document.getElementById('rua').value.trim(),
                            numero: document.getElementById('numero').value.trim(),
                            bairro: document.getElementById('bairro').value.trim(),
                            cidade: document.getElementById('cidade').value.trim(),
                            estado: document.getElementById('estado').value.trim(),
                            cep: document.getElementById('cep').value.trim()
                        })
                    });
                }

                // Enviar pedido
                const resp = await fetch('/backend/pedidos/salvar', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({
                        usuario_id: usuario.usuario_id,
                        tipo_pedido: tipoPedidoSelecionado,
                        metodo_pagamento: metodoPagamentoSelecionado,
                        troco: document.getElementById('troco').value.trim(),
                        itens: carrinho
                    })
                });

                const data = await resp.json();

                loadingOverlay.classList.remove('show');

                if (data.sucesso) {
                    // Limpar carrinho
                    localStorage.removeItem(STORAGE_KEY);
                    
                    // Mostrar sucesso
                    orderNumber.textContent = data.pedido_id;
                    successModal.classList.add('show');
                } else {
                    alert(data.mensagem || 'Erro ao criar pedido. Tente novamente.');
                }

            } catch (e) {
                loadingOverlay.classList.remove('show');
                alert('Erro de conexão. Verifique sua internet e tente novamente.');
            }
        });

        // Botão de sucesso
        document.getElementById('success-btn').addEventListener('click', () => {
            window.location.href = 'cardapio.php';
        });

        // Inicialização
        verificarAuth();
        renderizarResumo();
    </script>
</body>
</html>
