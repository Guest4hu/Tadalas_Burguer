<<<<<<< HEAD

=======
﻿<?php
// Captura valores do formulário
$funcionario_id = htmlspecialchars($funcionario['funcionario_id'] ?? '', ENT_QUOTES, 'UTF-8');
$usuario_id = htmlspecialchars($funcionario['usuario_id'] ?? '', ENT_QUOTES, 'UTF-8');
$cargo_id = htmlspecialchars($funcionario['cargo_id'] ?? '', ENT_QUOTES, 'UTF-8');
$status_funcionario_id = htmlspecialchars($funcionario['status_funcionario_id'] ?? '', ENT_QUOTES, 'UTF-8');
$salario = htmlspecialchars($funcionario['salario'] ?? '', ENT_QUOTES, 'UTF-8');
?>
>>>>>>> f0d22a1a9a6a0851f1e004ccf9e433802e0db8b1

<style>
    .form-card {
        max-width: 650px;
        margin: 2.5rem auto;
        background: var(--gradient-card);
        border-radius: 16px;
        box-shadow: var(--shadow-md);
        border: 1px solid var(--border-color);
        padding: 2rem;
        position: relative;
        overflow: hidden;
        animation: fadeInUp 0.6s ease-out backwards;
    }
    .form-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 4px;
        background: linear-gradient(90deg, var(--accent-red), var(--accent-gold));
    }
    .form-card h3 {
        color: var(--text-primary);
        font-weight: 700;
        font-size: 1.5rem;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }
    .form-card h3 i {
        color: var(--accent-red);
    }
    .form-card label {
        font-weight: 600;
        color: var(--text-primary);
        margin-bottom: 0.5rem;
        display: block;
        font-size: 0.9375rem;
    }
    .form-card label i {
        color: var(--accent-gold);
        margin-right: 0.25rem;
    }
    .form-card input,
    .form-card textarea,
    .form-card select {
        width: 100%;
        padding: 0.75rem 1rem;
        border: 1px solid var(--border-color);
        border-radius: 10px;
        font-size: 0.9375rem;
        outline: none;
        background: var(--bg-secondary);
        color: var(--text-primary);
        font-family: inherit;
        transition: border-color 0.3s ease, box-shadow 0.3s ease;
    }
    .form-card input::placeholder,
    .form-card textarea::placeholder {
        color: var(--text-muted);
    }
    .form-card input:focus,
    .form-card textarea:focus,
    .form-card select:focus {
        border-color: var(--accent-red);
        box-shadow: 0 0 0 3px rgba(229, 57, 53, 0.2);
    }
    .form-card textarea {
        resize: vertical;
        min-height: 100px;
    }
    .form-card select option {
        background: var(--bg-secondary);
        color: var(--text-primary);
    }
    .form-card .btn-primary,
    .form-card .btn-edit {
        background: var(--accent-red);
        color: var(--text-primary);
        font-weight: 600;
        padding: 0.75rem 1.5rem;
        border: none;
        border-radius: 10px;
        cursor: pointer;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        box-shadow: 0 4px 16px rgba(229, 57, 53, 0.3);
        font-size: 0.9375rem;
    }
    .form-card .btn-primary:hover,
    .form-card .btn-edit:hover {
        background: var(--accent-red-hover);
        box-shadow: 0 6px 24px rgba(229, 57, 53, 0.5);
        transform: translateY(-2px);
    }
    .form-card .btn-cancel {
        background: var(--bg-card);
        color: var(--text-primary);
        font-weight: 600;
        padding: 0.75rem 1.5rem;
        border: 1px solid var(--border-color);
        border-radius: 10px;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        transition: all 0.3s ease;
        font-size: 0.9375rem;
    }
    .form-card .btn-cancel:hover {
        background: var(--bg-card-hover);
        border-color: var(--accent-red);
    }
    .form-actions {
        margin-top: 1.5rem;
        display: flex;
        justify-content: flex-end;
        gap: 0.75rem;
    }
    .form-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1rem;
    }
    .form-grid-full {
        grid-column: 1 / -1;
    }
    .w3-section {
        margin-bottom: 1rem;
    }
    .alert {
        padding: 1rem 1.5rem;
        border-radius: 12px;
        margin-bottom: 1.5rem;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }
    .alert-success {
        background: linear-gradient(135deg, rgba(76, 175, 80, 0.2), rgba(76, 175, 80, 0.1));
        color: #4CAF50;
        border: 1px solid rgba(76, 175, 80, 0.3);
    }
    .alert-error {
        background: linear-gradient(135deg, rgba(229, 57, 53, 0.2), rgba(229, 57, 53, 0.1));
        color: var(--accent-red);
        border: 1px solid rgba(229, 57, 53, 0.3);
    }
    .current-image {
        margin-top: 10px;
        max-width: 200px;
        border-radius: 12px;
        box-shadow: var(--shadow-md);
        border: 1px solid var(--border-color);
    }
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    @media (max-width: 768px) {
        .form-card { margin: 1rem; padding: 1.5rem; }
        .form-grid { grid-template-columns: 1fr; }
        .form-actions { flex-direction: column; }
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

    <form method="POST" action="/backend/funcionarios/atualizar">
        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token'] ?? ''; ?>">
        <input type="hidden" name="funcionario_id" value="<?php echo $funcionario['funcionario_id'] ?? 0; ?>">


        <div class="w3-section">
            <label for="cargo_id"><i class="fa fa-briefcase"></i> Cargo</label>
            <select id="cargo_id" name="cargo_id" required>
                <?php foreach ($cargosData as $cargo): ?>
                    <option value="<?php echo $cargo['id']; ?>"
                        <?php echo ((int)$cargo['id'] === (int)$funcionario['cargo_id']) ? 'selected' : ''; ?>>
                        <?php echo htmlspecialchars($cargo['cargo_descricao'], ENT_QUOTES, 'UTF-8'); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="w3-section">
            <label for="status_funcionario_id"><i class="fa fa-check-circle"></i> Status</label>
            <select id="status_funcionario_id" name="status_funcionario_id" required>
                <?php foreach ($statusFuncionariosData as $status): ?>
                    <option value="<?php echo $status['id']; ?>"
                        <?php echo ((int)$status['id'] === (int)$funcionario['status_funcionario_id']) ? 'selected' : ''; ?>>
                        <?php echo htmlspecialchars($status['descricao'], ENT_QUOTES, 'UTF-8'); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="w3-section">
            <label for="salario"><i class="fa fa-money-bill-wave"></i> Salário (R$)</label>
            <input type="number" id="salario" name="salario" placeholder="Ex: 2500.00" value="<?php echo $funcionario['salario'] ?? 0; ?>" step="0.01" required min="0">
        </div>

        <div class="form-actions">
            <a href="/backend/funcionarios" class="btn-cancel">
                <i class="fa fa-arrow-left"></i> Voltar
            </a>
            <button type="submit" class="btn-primary">
                <i class="fa fa-save"></i> Atualizar Funcionário
            </button>
        </div>
    </form>
</div>