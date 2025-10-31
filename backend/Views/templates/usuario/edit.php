<?php
// Sanitização segura de entradas
$nome  = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?? '';
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL) ?? '';
$senha = $_POST['senha'] ?? '';
$tipo  = filter_input(INPUT_POST, 'tipo', FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?? '';
$id    = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT) ?? '';
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
    .form-card input, .form-card select {
        width: 100%;
        padding: 10px 12px;
        border: 1px solid #ccd3e0;
        border-radius: 8px;
        font-size: 15px;
        outline: none;
        transition: border-color .2s ease;
    }
    .form-card input:focus, .form-card select:focus {
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
    <h3><i class="fa fa-user-edit"></i> Editar Usuário</h3>

    <form method="POST" action="/backend/usuario/atualizar/<?php echo $usuario_id; ?>" autocomplete="off">

        <div class="w3-section">
            <label for="nome"><i class="fa fa-user"></i> Nome</label>
            <input type="text" id="nome" name="nome" value="<?php echo $nome; ?>" required>
        </div>

        <div class="w3-section">
            <label for="email"><i class="fa fa-envelope"></i> Email</label>
            <input type="email" id="email" name="email" value="<?php echo $email; ?>" required>
        </div>

        <div class="w3-section">
            <label for="senha"><i class="fa fa-lock"></i> Senha</label>
            <input type="password" id="senha" name="senha" value="<?php echo $senha; ?>">
        </div>

        <div class="w3-section">
            <label for="tipo"><i class="fa fa-user-tag"></i> Tipo de Usuário</label>
            <select id="tipo" name="tipo" required>
                <option value="1" <?php echo ($tipo === 1) ? 'selected' : ''; ?>>Cliente</option>
                <option value="2" <?php echo ($tipo === 2) ? 'selected' : ''; ?>>Funcionario</option>
            </select>
        </div>

        <input type="hidden" name="id" value="<?php echo $usuario_id; ?>">

        <div class="form-actions">
            <a href="/backend/usuario/index" class="btn-cancel"><i class="fa fa-arrow-left"></i> Voltar</a>
            <button type="submit" class="btn-primary"><i class="fa fa-save"></i> Salvar Alterações</button>
        </div>
    </form>
</div>
