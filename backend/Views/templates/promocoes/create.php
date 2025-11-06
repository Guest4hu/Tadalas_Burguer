<?php
// Captura valores do formulário
$titulo = $titulo ?? '';
$descricao = $descricao ?? '';
$percentual_desconto = $percentual_desconto ?? '';
$data_inicio = $data_inicio ?? '';
$data_fim = $data_fim ?? '';
$ativo = $ativo ?? 1;
?>

<style>
    .form-card {
        max-width: 700px;
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
    .form-card textarea,
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
    .form-card textarea:focus,
    .form-card select:focus {
        border-color: #42A5F5;
        box-shadow: 0 0 0 3px rgba(66,165,245,.2);
    }
    .form-card textarea {
        resize: vertical;
        min-height: 90px;
    }
    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 15px;
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
    <h3><i class="fa fa-percent"></i> Criar Nova Promoção</h3>

    <?php
    if (!empty($_SESSION['flash'])) {
        foreach ($_SESSION['flash'] as $tipo => $mensagem) {
            $classe = $tipo === 'success' ? 'alert-success' : 'alert-error';
            echo "<div class='alert {$classe}'><i class='fa fa-info-circle'></i> {$mensagem}</div>";
        }
        unset($_SESSION['flash']);
    }
    ?>

    <form method="POST" action="/backend/promocoes/salvar" autocomplete="off">
        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token'] ?? ''; ?>">

        <div class="w3-section">
            <label for="titulo"><i class="fa fa-heading"></i> Título da Promoção</label>
            <input type="text" id="titulo" name="titulo" placeholder="Ex: Black Friday - 50% OFF" value="<?php echo $titulo; ?>" required maxlength="150">
        </div>

        <div class="w3-section">
            <label for="descricao"><i class="fa fa-align-left"></i> Descrição</label>
            <textarea id="descricao" name="descricao" placeholder="Descreva os detalhes da promoção" required><?php echo $descricao; ?></textarea>
        </div>

        <div class="w3-section">
            <label for="percentual_desconto"><i class="fa fa-percentage"></i> Percentual de Desconto (%)</label>
            <input type="number" id="percentual_desconto" name="percentual_desconto" placeholder="Ex: 25" value="<?php echo $percentual_desconto; ?>" required min="0" max="100" step="0.01">
        </div>

        <div class="form-row">
            <div class="w3-section">
                <label for="data_inicio"><i class="fa fa-calendar-alt"></i> Data de Início</label>
                <input type="date" id="data_inicio" name="data_inicio" value="<?php echo $data_inicio; ?>" required>
            </div>

            <div class="w3-section">
                <label for="data_fim"><i class="fa fa-calendar-check"></i> Data de Término</label>
                <input type="date" id="data_fim" name="data_fim" value="<?php echo $data_fim; ?>" required>
            </div>
        </div>

        <div class="w3-section">
            <label for="ativo"><i class="fa fa-toggle-on"></i> Status</label>
            <select id="ativo" name="ativo" required>
                <option value="1" <?php echo ($ativo == 1) ? 'selected' : ''; ?>>Ativa</option>
                <option value="0" <?php echo ($ativo == 0) ? 'selected' : ''; ?>>Inativa</option>
            </select>
        </div>

        <div class="form-actions">
            <a href="/backend/promocoes/index" class="btn-cancel">
                <i class="fa fa-arrow-left"></i> Voltar
            </a>
            <button type="submit" class="btn-primary">
                <i class="fa fa-save"></i> Salvar Promoção
            </button>
        </div>
    </form>
</div>