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
                            <button class="btn-remove" id="clearCustomerBtn">
                                <i class="fa fa-times"></i>
                            </button>
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
            <select id="cargo_id" name="cargo_id" required>
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
            <select id="status_funcionario_id" name="status_funcionario_id" required>
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
            <input type="number" id="salario" name="salario" placeholder="Ex: 2500.00" value="<?php echo $salario; ?>" step="0.01" required min="0">
        </div>

        <div class="form-actions">
            <a href="/backend/funcionarios" class="btn-cancel">
                <i class="fa fa-arrow-left"></i> Voltar
            </a>
            <button type="submit" class="btn-primary">
                <i class="fa fa-save"></i> Salvar Funcionário
            </button>
        </div>
    </form>
</div>


<script type="module" src="/backend/Views/public/js/funcionarios/funcionario.js"></script>