<?php
// Captura valores do formulário
$usuario_id = $usuario_id ?? '';
$cargo_id = $cargo_id ?? '';
$status_funcionario_id = $status_funcionario_id ?? '';
$salario = $salario ?? '';
$user = $userData ?? '';
?>

<style>
    .form-card {
        max-width: 600px;
        margin: 40px auto;
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 6px 18px rgba(0,0,0,.08);
        padding: 30px;
    }
    .form-card h3 {
        color: #2f3a57;
        font-weight: 700;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .form-card label {
        font-weight: 600;
        color: #2f3a57;
        margin-bottom: 6px;
        display: block;
    }
    .form-card input,
    .form-card select {
        width: 100%;
        padding: 10px 12px;
        border: 1px solid #ccd3e0;
        border-radius: 8px;
        font-size: 15px;
        outline: none;
        transition: border-color .2s ease;
    }
    .form-card input:focus,
    .form-card select:focus {
        border-color: #42A5F5;
        box-shadow: 0 0 0 3px rgba(66,165,245,.2);
    }
    .form-card .btn-primary {
        background: linear-gradient(135deg, #1976D2 0%, #42A5F5 100%);
        color: #fff;
        font-weight: 600;
        padding: 10px 18px;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        transition: all .2s ease-in-out;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        box-shadow: 0 4px 10px rgba(25,118,210,.3);
    }
    .form-card .btn-primary:hover {
        background: linear-gradient(135deg, #1565C0 0%, #1E88E5 100%);
        box-shadow: 0 6px 14px rgba(21,101,192,.4);
        transform: translateY(-1px);
    }
    .form-card .btn-cancel {
        background: #ECEFF1;
        color: #455A64;
        font-weight: 600;
        padding: 10px 18px;
        border: none;
        border-radius: 8px;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all .2s ease;
    }
    .form-card .btn-cancel:hover {
        background: #CFD8DC;
    }
    .form-actions {
        margin-top: 20px;
        display: flex;
        justify-content: flex-end;
        gap: 12px;
    }
    .alert {
        padding: 12px 16px;
        border-radius: 8px;
        margin-bottom: 20px;
        font-weight: 600;
    }
    .alert-success {
        background: #E8F5E9;
        color: #2E7D32;
        border-left: 5px solid #43A047;
    }
    .alert-error {
        background: #FFEBEE;
        color: #C62828;
        border-left: 5px solid #E53935;
    }
    .input-error {
        background: #FFEBEE;
        border-color: #E53935;
    }

    /* ===== Seção de Cliente ===== */
    .form-section {
        background: #F8FAFC;
        border-radius: 10px;
        padding: 18px;
        margin-bottom: 20px;
        border: 1px solid #E2E8F0;
    }

    .section-label {
        font-weight: 700;
        color: #2f3a57;
        font-size: 15px;
        margin-bottom: 14px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .section-label i {
        color: #1976D2;
    }

    /* ===== Botões de Ação Rápida ===== */
    .customer-quick-actions {
        display: flex;
        gap: 10px;
        margin-bottom: 14px;
    }

    .btn-quick {
        flex: 1;
        padding: 10px 16px;
        border: 2px solid #E2E8F0;
        background: #fff;
        border-radius: 8px;
        font-weight: 600;
        font-size: 14px;
        color: #455A64;
        cursor: pointer;
        transition: all .2s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
    }

    .btn-quick:hover {
        border-color: #42A5F5;
        color: #1976D2;
        background: #E3F2FD;
        transform: translateY(-1px);
    }

    .btn-quick.active {
        border-color: #1976D2;
        background: linear-gradient(135deg, #1976D2 0%, #42A5F5 100%);
        color: #fff;
        box-shadow: 0 4px 12px rgba(25,118,210,.25);
    }

    .btn-quick i {
        font-size: 13px;
    }

    /* ===== Cliente Selecionado ===== */
    .selected-customer-compact {
        display: none;
        background: linear-gradient(135deg, #E8F5E9 0%, #C8E6C9 100%);
        border: 1px solid #81C784;
        border-radius: 8px;
        padding: 12px 16px;
        margin-bottom: 14px;
        animation: fadeIn .3s ease;
    }

    .selected-customer-compact.show {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .customer-info-compact {
        display: flex;
        flex-direction: column;
        gap: 2px;
        flex: 1;
    }

    .customer-info-compact strong {
        color: #2E7D32;
        font-size: 15px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .customer-info-compact strong i {
        color: #43A047;
    }

    .customer-info-compact small {
        color: #558B2F;
        font-size: 13px;
        display: flex;
        align-items: center;
        gap: 4px;
    }

    .customer-info-compact small i {
        color: #7CB342;
        font-size: 11px;
    }

    .btn-change-customer {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        border: none;
        background: rgba(46, 125, 50, 0.15);
        color: #2E7D32;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all .2s ease;
        flex-shrink: 0;
    }

    .btn-change-customer:hover {
        background: #C62828;
        color: #fff;
        transform: scale(1.1);
    }

    /* ===== Caixa de Busca Compacta ===== */
    .compact-search-box {
        margin-bottom: 14px;
        animation: slideDown .25s ease;
    }

    .input-compact {
        width: 100%;
        padding: 12px 14px;
        border: 2px solid #E2E8F0;
        border-radius: 8px;
        font-size: 14px;
        outline: none;
        transition: all .2s ease;
        background: #fff;
        margin-bottom: 8px;
        box-sizing: border-box;
    }

    .input-compact:focus {
        border-color: #42A5F5;
        box-shadow: 0 0 0 3px rgba(66,165,245,.15);
    }

    .input-compact::placeholder {
        color: #90A4AE;
    }

    /* ===== Resultados de Busca ===== */
    .search-results-compact {
        max-height: 280px;
        overflow-y: auto;
        background: #F8FAFC;
        border: 1px solid #E2E8F0;
        border-radius: 10px;
        padding: 8px;
        display: none;
        gap: 8px;
    }

    .search-results-compact.show {
        display: flex;
        flex-direction: column;
    }

    .search-results-compact::-webkit-scrollbar {
        width: 6px;
    }

    .search-results-compact::-webkit-scrollbar-track {
        background: #F5F5F5;
        border-radius: 3px;
    }

    .search-results-compact::-webkit-scrollbar-thumb {
        background: #BDBDBD;
        border-radius: 3px;
    }

    /* ===== Cards de Resultado ===== */
    .search-result-item {
        background: #fff;
        padding: 14px 16px;
        border-radius: 10px;
        cursor: pointer;
        transition: all .2s ease;
        display: flex;
        align-items: center;
        gap: 14px;
        border: 2px solid transparent;
        box-shadow: 0 2px 6px rgba(0,0,0,.04);
    }

    .search-result-item:hover {
        background: #fff;
        border-color: #42A5F5;
        box-shadow: 0 4px 12px rgba(66,165,245,.2);
        transform: translateY(-2px);
    }

    .search-result-item:active {
        transform: translateY(0);
        box-shadow: 0 2px 6px rgba(66,165,245,.15);
    }

    .search-result-item.selected {
        border-color: #1976D2;
        background: #E3F2FD;
    }

    .search-result-item .result-avatar {
        width: 44px;
        height: 44px;
        background: linear-gradient(135deg, #1976D2 0%, #42A5F5 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        font-weight: 700;
        font-size: 16px;
        flex-shrink: 0;
        box-shadow: 0 3px 8px rgba(25,118,210,.3);
    }

    .search-result-item .result-info {
        display: flex;
        flex-direction: column;
        gap: 4px;
        flex: 1;
        min-width: 0;
    }

    .search-result-item .result-name {
        font-weight: 700;
        color: #2f3a57;
        font-size: 15px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .search-result-item .result-detail {
        font-size: 13px;
        color: #78909C;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .search-result-item .result-detail i {
        font-size: 11px;
        color: #90A4AE;
    }

    .search-result-item .result-badge {
        background: #E8F5E9;
        color: #2E7D32;
        font-size: 11px;
        font-weight: 600;
        padding: 4px 10px;
        border-radius: 20px;
        margin-left: auto;
        flex-shrink: 0;
    }

    .search-result-item .result-badge.inactive {
        background: #FFF3E0;
        color: #E65100;
    }

    .search-result-item .select-icon {
        width: 28px;
        height: 28px;
        border-radius: 50%;
        background: #E3F2FD;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #1976D2;
        font-size: 12px;
        flex-shrink: 0;
        opacity: 0;
        transition: opacity .2s ease;
    }

    .search-result-item:hover .select-icon {
        opacity: 1;
    }

    /* ===== Sem Resultados ===== */
    .search-no-results {
        padding: 30px 20px;
        text-align: center;
        color: #90A4AE;
        font-size: 14px;
        background: #fff;
        border-radius: 10px;
    }

    .search-no-results i {
        font-size: 32px;
        margin-bottom: 12px;
        display: block;
        color: #CFD8DC;
    }

    .search-no-results span {
        display: block;
        margin-top: 6px;
        font-size: 12px;
        color: #B0BEC5;
    }

    /* ===== Loading nos Resultados ===== */
    .search-loading {
        padding: 24px;
        text-align: center;
        background: #fff;
        border-radius: 10px;
    }

    .search-loading .loading-spinner {
        width: 24px;
        height: 24px;
        margin-bottom: 10px;
    }

    .search-loading span {
        display: block;
        color: #78909C;
        font-size: 13px;
    }

    /* ===== Formulário Novo Cliente ===== */
    #newCustomerForm {
        animation: slideDown .25s ease;
    }

    #newCustomerForm .input-compact {
        margin-bottom: 10px;
    }

    #newCustomerForm .input-compact:last-child {
        margin-bottom: 0;
    }

    /* ===== Animações ===== */
    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    @keyframes slideDown {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* ===== Loading State ===== */
    .loading-spinner {
        display: inline-block;
        width: 16px;
        height: 16px;
        border: 2px solid #E0E0E0;
        border-top-color: #1976D2;
        border-radius: 50%;
        animation: spin .8s linear infinite;
    }

    @keyframes spin {
        to { transform: rotate(360deg); }
    }

    /* ===== Responsivo ===== */
    @media (max-width: 480px) {
        .form-card {
            margin: 20px 10px;
            padding: 20px;
        }

        .customer-quick-actions {
            flex-direction: column;
        }

        .btn-quick {
            width: 100%;
        }

        .form-actions {
            flex-direction: column-reverse;
        }

        .form-actions .btn-primary,
        .form-actions .btn-cancel {
            width: 100%;
            justify-content: center;
        }
    }
</style>

<div class="form-card">
    <h3><i class="fa fa-user-tie"></i> Criar Novo Funcionário</h3>

    <?php
    if (!empty($_SESSION['flash'])) {
        foreach ($_SESSION['flash'] as $tipo => $mensagem) {
            $classe = $tipo === 'success' ? 'alert-success' : 'alert-error';
            echo "<div class='alert {$classe}'><i class='fa fa-info-circle'></i> {$mensagem}</div>";
        }
        unset($_SESSION['flash']);
    }
    ?>
    <input type="hidden" id="UserData" value='<?php echo json_encode($user); ?>'>

    <form  autocomplete="off">
        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token'] ?? ''; ?>">

        <div id="customerSection" class="form-section" style="display: block;">
                        <label class="section-label">
                            <i class="fa fa-user"></i> Cliente
                        </label>
                        
                        <!-- Customer Quick Actions -->
                        <div class="customer-quick-actions">
                            <button class="btn-quick" id="searchExistingCustomerBtn">
                                <i class="fa fa-search"></i> Buscar
                            </button>
                            <button class="btn-quick" id="newCustomerBtn">
                                <i class="fa fa-user-plus"></i> Novo
                            </button>
                        </div>

                        <!-- Selected Customer -->
                        <div id="selectedCustomerDisplay" class="selected-customer-compact">
                            <div class="customer-info-compact">
                                <strong id="selectedCustomerName"></strong>
                                <small id="selectedCustomerPhone"></small>
                            </div>
                        </div>

                        <!-- Customer Search Compact -->
                        <div id="customerSearchBox" class="compact-search-box" style="display: none;">
                            <input type="text" class="input-compact" id="customerSearchInput" placeholder="Nome ou telefone e email...">
                            <div id="customerSearchResults" class="search-results-compact"></div>
                        </div>

                        <!-- New Customer Form Compact -->
                        <div id="newCustomerForm" style="display: none;">
                            <input type="text" class="input-compact" id="customerName" placeholder="Nome completo">
                            <input type="email" class="input-compact" id="customerEmail" placeholder="Email do Usuario">
                            <input type="password" class="input-compact" id="customerPassword" placeholder="Senha do Funcionario" max="4">
                            <input type="password" class="input-compact" id="customerPasswordConfirm" placeholder="Confirme a senha" max="4">
                        </div>
                    </div>

        <div class="w3-section">
            <label for="cargo_id"><i class="fa fa-briefcase"></i> Cargo</label>
            <select id="cargo_id" name="cargo_id">
                <option value="">Selecione um cargo</option>
                <?php foreach ($cargosData as $cargo): ?>
                    <option value="<?php echo htmlspecialchars($cargo['id']); ?>">
                        <?php echo htmlspecialchars($cargo['cargo_descricao']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="w3-section">
            <label for="status_funcionario_id"><i class="fa fa-check-circle"></i> Status</label>
            <select id="status_funcionario_id" name="status_funcionario_id" >
                <option value="">Selecione o status</option>
                <?php foreach ($statusFuncionariosData as $status): ?>
                    <option value="<?php echo htmlspecialchars($status['id']); ?>">
                        <?php echo htmlspecialchars($status['descricao']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="w3-section">
            <label for="salario"><i class="fa fa-money-bill-wave"></i> Salário (R$)</label>
            <input type="number" id="salario" name="salario" placeholder="Ex: 2500.00" value="" required min="0">
        </div>

        <div class="form-actions">
            <a href="/backend/funcionarios" class="btn-cancel">
                <i class="fa fa-arrow-left"></i> Voltar
            </a>
            <button type="submit" class="btn-primary" id="createFunc">
                <i class="fa fa-save"></i> Salvar Funcionário
            </button>
        </div>
    </form>
</div>


<script type="module" src="/backend/Views/public/js/funcionarios/funcionariosCreate/funcionarioCreate.js"></script>