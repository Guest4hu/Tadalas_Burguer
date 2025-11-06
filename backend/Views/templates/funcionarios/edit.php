<?php
// Captura valores do formulário
$funcionario_id = htmlspecialchars($funcionario['funcionario_id'] ?? '', ENT_QUOTES, 'UTF-8');
$usuario_id = htmlspecialchars($funcionario['usuario_id'] ?? '', ENT_QUOTES, 'UTF-8');
$cargo_id = htmlspecialchars($funcionario['cargo_id'] ?? '', ENT_QUOTES, 'UTF-8');
$status_funcionario_id = htmlspecialchars($funcionario['status_funcionario_id'] ?? '', ENT_QUOTES, 'UTF-8');
$salario = htmlspecialchars($funcionario['salario'] ?? '', ENT_QUOTES, 'UTF-8');
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
        border-color: #FF9800;
        box-shadow: 0 0 0 3px rgba(255,152,0,.2);
    }
    .form-card .btn-primary {
        background: linear-gradient(135deg, #F57C00 0%, #FF9800 100%);
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
        box-shadow: 0 4px 10px rgba(245,124,0,.3);
    }
    .form-card .btn-primary:hover {
        background: linear-gradient(135deg, #EF6C00 0%, #FB8C00 100%);
        box-shadow: 0 6px 14px rgba(239,108,0,.4);
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
    <h3><i class="fa fa-user-tie"></i> Editar Funcionário</h3>

    <?php
    if (!empty($_SESSION['flash'])) {
        foreach ($_SESSION['flash'] as $tipo => $mensagem) {
            $classe = $tipo === 'success' ? 'alert-success' : 'alert-error';
            echo "<div class='alert {$classe}'><i class='fa fa-info-circle'></i> {$mensagem}</div>";
        }
        unset($_SESSION['flash']);
    }
    ?>

    <form method="POST" action="/backend/funcionarios/atualizar" autocomplete="off">
        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token'] ?? ''; ?>">
        <input type="hidden" name="funcionario_id" value="<?php echo $funcionario_id; ?>">

        <div class="w3-section">
            <label for="usuario_id"><i class="fa fa-user"></i> Usuário</label>
            <select id="usuario_id" name="usuario_id" required>
                <option value="">Selecione um usuário</option>
                <!-- Carregar dinamicamente do banco com selected="<?php echo $usuario_id; ?>" -->
            </select>
        </div>

        <div class="w3-section">
            <label for="cargo_id"><i class="fa fa-briefcase"></i> Cargo</label>
            <select id="cargo_id" name="cargo_id" required>
                <option value="">Selecione um cargo</option>
                <!-- Carregar dinamicamente do banco com selected="<?php echo $cargo_id; ?>" -->
            </select>
        </div>

        <div class="w3-section">
            <label for="status_funcionario_id"><i class="fa fa-check-circle"></i> Status</label>
            <select id="status_funcionario_id" name="status_funcionario_id" required>
                <option value="">Selecione o status</option>
                <!-- Carregar dinamicamente do banco com selected="<?php echo $status_funcionario_id; ?>" -->
            </select>
        </div>

        <div class="w3-section">
            <label for="salario"><i class="fa fa-money-bill-wave"></i> Salário (R$)</label>
            <input type="number" id="salario" name="salario" placeholder="Ex: 2500.00" value="<?php echo $salario; ?>" step="0.01" required min="0">
        </div>

        <div class="form-actions">
            <a href="/backend/funcionarios/index" class="btn-cancel">
                <i class="fa fa-arrow-left"></i> Voltar
            </a>
            <button type="submit" class="btn-primary">
                <i class="fa fa-save"></i> Atualizar Funcionário
            </button>
        </div>
    </form>
</div>