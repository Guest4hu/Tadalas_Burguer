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
        min-height: 100px;
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
        background: linear-gradient(135deg, #E65100 0%, #F57C00 100%);
        box-shadow: 0 6px 14px rgba(230,81,0,.4);
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
    .current-image {
        margin-top: 10px;
        max-width: 200px;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0,0,0,.1);
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
                <option value="1" <?php echo ($categoria_id == '1') ? 'selected' : ''; ?>>Hamburguer</option>
                <option value="7" <?php echo ($categoria_id == '7') ? 'selected' : ''; ?>>Bebidas</option>
                <option value="8" <?php echo ($categoria_id == '8') ? 'selected' : ''; ?>>Sobremesas</option>
                <option value="11" <?php echo ($categoria_id == '11') ? 'selected' : ''; ?>>Sanduíches de frango</option>
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
            <a href="/backend/produtos/index" class="btn-cancel">
                <i class="fa fa-arrow-left"></i> Cancelar
            </a>
            <button type="submit" class="btn-primary">
                <i class="fa fa-save"></i> Atualizar Produto
            </button>
        </div>
    </form>
</div>