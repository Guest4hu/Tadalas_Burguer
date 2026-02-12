<?php
// Captura valores passados pelo controller
$id_categoria = $id_categoria ?? '';
$nome = $nome ?? '';
$descricao = $descricao ?? '';
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
    .form-card textarea {
        width: 100%;
        padding: 10px 12px;
        border: 1px solid #ccd3e0;
        border-radius: 8px;
        font-size: 15px;
        outline: none;
        transition: border-color .2s ease;
    }
    .form-card input:focus,
    .form-card textarea:focus {
        border-color: #42A5F5;
        box-shadow: 0 0 0 3px rgba(66,165,245,.2);
    }
    .form-card textarea {
        resize: vertical;
        min-height: 90px;
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
</style>

<div class="form-card">
    <h3><i class="fa fa-edit"></i> Editar Categoria</h3>

    <?php
    // Exibe mensagens flash
    if (!empty($_SESSION['flash'])) {
        foreach ($_SESSION['flash'] as $tipo => $mensagem) {
            $classe = $tipo === 'success' ? 'alert-success' : 'alert-error';
            echo "<div class='alert {$classe}'><i class='fa fa-info-circle'></i> {$mensagem}</div>";
        }
        unset($_SESSION['flash']);
    }
    ?>

    <form method="POST" action="/backend/categoria/atualizar" autocomplete="off">
        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token'] ?? ''; ?>">
        <input type="hidden" name="id" value="<?php echo $id_categoria; ?>">

        <div class="w3-section">
            <label for="nome"><i class="fa fa-tag"></i> Nome da Categoria</label>
            <input type="text" id="nome" name="nome" placeholder="Digite o nome da categoria" value="<?php echo $nome; ?>" required maxlength="100">
        </div>

        <div class="w3-section">
            <label for="descricao"><i class="fa fa-align-left"></i> Descrição</label>
            <textarea id="descricao" name="descricao" placeholder="Descreva brevemente a categoria" required maxlength="255"><?php echo $descricao; ?></textarea>
        </div>

        <div class="form-actions">
            <a href="/backend/categoria" class="btn-cancel">
                <i class="fa fa-arrow-left"></i> Cancelar
            </a>
            <button type="submit" class="btn-primary">
                <i class="fa fa-save"></i> Atualizar Categoria
            </button>
        </div>
    </form>
</div>