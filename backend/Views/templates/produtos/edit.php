<?php
// Captura valores passados pelo controller
$produto_id = $produto_id ?? '';
$nome = $nome ?? '';
$descricao = $descricao ?? '';
$preco = $preco ?? '';
$estoque = $estoque ?? '';
$categoria_id = $categoria_id ?? '';
$foto_produto = $foto_produto ?? '';
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
    <h3><i class="fa fa-edit"></i> Editar Produto</h3>

    <?php
    if (!empty($_SESSION['flash'])) {
        foreach ($_SESSION['flash'] as $tipo => $mensagem) {
            $classe = $tipo === 'success' ? 'alert-success' : 'alert-error';
            echo "<div class='alert {$classe}'><i class='fa fa-info-circle'></i> {$mensagem}</div>";
        }
        unset($_SESSION['flash']);
    }
    ?>

    <form method="POST" action="/backend/produtos/atualizar" enctype="multipart/form-data" autocomplete="off">
        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token'] ?? ''; ?>">
        <input type="hidden" name="id" value="<?php echo $produto_id; ?>">

        <div class="w3-section">
            <label for="nome"><i class="fa fa-tag"></i> Nome do Produto</label>
            <input type="text" id="nome" name="nome" placeholder="Digite o nome do produto" value="<?php echo $nome; ?>" required maxlength="150">
        </div>

        <div class="w3-section">
            <label for="descricao"><i class="fa fa-align-left"></i> Descrição</label>
            <textarea id="descricao" name="descricao" placeholder="Descreva o produto" required><?php echo $descricao; ?></textarea>
        </div>

        <div class="w3-section">
            <label for="preco"><i class="fa fa-dollar-sign"></i> Preço</label>
            <input type="number" id="preco" name="preco" placeholder="Ex: 99.90" value="<?php echo $preco; ?>" step="0.01" required>
        </div>

        <div class="w3-section">
            <label for="estoque"><i class="fa fa-boxes"></i> Estoque</label>
            <input type="number" id="estoque" name="estoque" placeholder="Quantidade disponível" value="<?php echo $estoque; ?>" required min="0">
        </div>

        <div class="w3-section">
            <label for="categoria"><i class="fa fa-list"></i> Categoria</label>
            <select id="categoria" name="categoria" required>
                <option value="">Selecione uma categoria</option>
                    <?php if (!empty($categorias) && is_array($categorias)): ?>
                        <?php foreach ($categorias as $cat): ?>
                            <option value="<?php echo (int)$cat['id_categoria']; ?>" <?php echo ((int)$categoria_id === (int)$cat['id_categoria']) ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($cat['nome'] ?? '', ENT_QUOTES, 'UTF-8'); ?>
                            </option>
                        <?php endforeach; ?>
                    <?php endif; ?>
            </select>
        </div>

        <div class="w3-section">
            <label for="imagem"><i class="fa fa-image"></i> Imagem do Produto</label>
            <input type="file" id="imagem" name="imagem" accept="image/*">
            <?php if (!empty($foto_produto)): ?>
                <div class="mt-2">
                    <small class="text-muted">Imagem atual:</small><br>
                    <img src="/backend/upload/<?php echo $foto_produto; ?>" alt="Imagem atual" class="current-image">
                </div>
            <?php endif; ?>
        </div>

        <div class="form-actions">
            <a href="/backend/produtos" class="btn-cancel">
                <i class="fa fa-arrow-left"></i> Cancelar
            </a>
            <button type="submit" class="btn-edit">
                <i class="fa fa-save"></i> Atualizar Produto
            </button>
        </div>
    </form>
</div>