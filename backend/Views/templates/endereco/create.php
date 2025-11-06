<?php
// Captura valores do formulário
$usuario_id = $usuario_id ?? '';
$rua = $rua ?? '';
$numero = $numero ?? '';
$bairro = $bairro ?? '';
$cidade = $cidade ?? '';
$estado = $estado ?? '';
$cep = $cep ?? '';
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
    .form-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 15px;
    }
    .form-grid-full {
        grid-column: 1 / -1;
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
    <h3><i class="fa fa-map-marker-alt"></i> Cadastrar Novo Endereço</h3>

    <?php
    if (!empty($_SESSION['flash'])) {
        foreach ($_SESSION['flash'] as $tipo => $mensagem) {
            $classe = $tipo === 'success' ? 'alert-success' : 'alert-error';
            echo "<div class='alert {$classe}'><i class='fa fa-info-circle'></i> {$mensagem}</div>";
        }
        unset($_SESSION['flash']);
    }
    ?>

    <form method="POST" action="/backend/endereco/salvar" autocomplete="off">
        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token'] ?? ''; ?>">

        <div class="w3-section">
            <label for="usuario_id"><i class="fa fa-user"></i> Usuário</label>
            <select id="usuario_id" name="usuario_id" required>
                <option value="">Selecione um usuário</option>
                <!-- Carregar dinamicamente do banco -->
            </select>
        </div>

        <div class="w3-section">
            <label for="rua"><i class="fa fa-road"></i> Rua</label>
            <input type="text" id="rua" name="rua" placeholder="Nome da rua" value="<?php echo $rua; ?>" required maxlength="255">
        </div>

        <div class="form-grid">
            <div>
                <label for="numero"><i class="fa fa-hashtag"></i> Número</label>
                <input type="text" id="numero" name="numero" placeholder="Nº" value="<?php echo $numero; ?>" required maxlength="10">
            </div>

            <div>
                <label for="bairro"><i class="fa fa-building"></i> Bairro</label>
                <input type="text" id="bairro" name="bairro" placeholder="Bairro" value="<?php echo $bairro; ?>" required maxlength="100">
            </div>
        </div>

        <div class="form-grid">
            <div>
                <label for="cidade"><i class="fa fa-city"></i> Cidade</label>
                <input type="text" id="cidade" name="cidade" placeholder="Cidade" value="<?php echo $cidade; ?>" required maxlength="100">
            </div>

            <div>
                <label for="estado"><i class="fa fa-flag"></i> Estado (UF)</label>
                <input type="text" id="estado" name="estado" placeholder="Ex: SP" value="<?php echo $estado; ?>" required maxlength="2" pattern="[A-Z]{2}">
            </div>
        </div>

        <div class="w3-section">
            <label for="cep"><i class="fa fa-mail-bulk"></i> CEP</label>
            <input type="text" id="cep" name="cep" placeholder="00000-000" value="<?php echo $cep; ?>" required maxlength="9" pattern="\d{5}-\d{3}">
        </div>

        <div class="form-actions">
            <a href="/backend/endereco/index" class="btn-cancel">
                <i class="fa fa-arrow-left"></i> Voltar
            </a>
            <button type="submit" class="btn-primary">
                <i class="fa fa-save"></i> Salvar Endereço
            </button>
        </div>
    </form>
</div>
<?php echo "create a atualizaçao"; ?>