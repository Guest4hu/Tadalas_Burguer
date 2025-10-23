
<form action="tipoUsuario/create" method="POST" style="margin-top: 20px;">
    <div class="w3-row-padding">
        <div class="w3-half">
            <label for="descricao">Descrição</label>
            <input class="w3-input w3-border" type="text" id="descricao" name="descricao" required>
        </div>
        <div class="w3-half">
            <label for="status">Status</label>
            <select class="w3-select w3-border" id="status" name="status" required>
                <option value="ativo">Ativo</option>
                <option value="inativo">Inativo</option>
            </select>
        </div>
    </div>
    <div class="w3-margin-top">
        <button class="w3-button w3-blue" type="submit">
            <i class="fa fa-plus"></i> Criar Tipo de Usuário
        </button>
    </div>
</form>