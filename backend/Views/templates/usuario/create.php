<?php

$nome  = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?? '';
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL) ?? '';
$senha = $_POST['senha'] ?? ''; 
$telefone = filter_input(INPUT_POST, 'telefone', FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?? '';
$cep = filter_input(INPUT_POST, 'cep', FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?? '';
$numero = filter_input(INPUT_POST, 'numero', FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?? '';


?>

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
    <h3><i class="fa fa-user-plus"></i> Criar Novo Usuário</h3>

    <?php
 
    if (!empty($_SESSION['flash'])) {
        foreach ($_SESSION['flash'] as $tipo => $mensagem) {
            $classe = $tipo === 'success' ? 'alert-success' : 'alert-error';
            echo "<div class='alert {$classe}'><i class='fa fa-info-circle'></i> {$mensagem}</div>";
        }
        unset($_SESSION['flash']); 
    }
    ?>

    <form method="POST" action="/backend/usuario/salvar" autocomplete="off">
  
        <div class="w3-section">
            <label for="nome"><i class="fa fa-user"></i> Nome</label>
            <input type="text" id="nome" name="nome" placeholder="Digite o nome completo" value="<?php echo $nome; ?>" required maxlength="100">
        </div>

        <div class="w3-section">
            <label for="email"><i class="fa fa-envelope"></i> Email</label>
            <input type="email" id="email" name="email" placeholder="exemplo@dominio.com" value="<?php echo $email; ?>" required maxlength="150">
        </div>

        <div class="w3-section">
            <label for="senha"><i class="fa fa-lock"></i> Senha</label>
            <input type="password" id="senha" name="senha" placeholder="Digite uma senha segura" required minlength="8">
        </div>
        <div class="w3-section">
            <label for="telefone"><i class="fa fa-phone"></i> Telefone</label>
            <input type="text" id="telefone" name="telefone" placeholder="(XX) XXXXX-XXXX" value="<?php echo $telefone; ?>" required maxlength="15">
        </div>
        <div>
            <label for="cep" class="fa fa-address">Cep</label>
            <input type="text" id="cep" name="cep" placeholder="Digite o CEP para auto preencher o endereço" maxlength="9" value="<?php echo htmlspecialchars($cep, ENT_QUOTES, 'UTF-8'); ?>">
        </div>
        <div class="w3-section">
            <label for="numero"><i class="fa fa-home"></i> Número</label>
            <input type="text" id="numero" name="numero" placeholder="Número da residência" maxlength="10" required value="<?php echo htmlspecialchars($numero, ENT_QUOTES, 'UTF-8'); ?>">
        </div>
        <div class="form-actions">
            <a href="/backend/cliente" class="btn-cancel">
                <i class="fa fa-arrow-left"></i> Voltar
            </a>
            <button type="submit" class="btn-primary">
                <i class="fa fa-save"></i> Criar Usuário
            </button>
        </div>
    </form>
</div>
