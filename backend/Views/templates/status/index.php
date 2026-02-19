<?php
$data = $_POST['status'] ?? null;

?>  

    <div>
        <form method="POST" action="/backend/status/salvar" autocomplete="off">
        <select name="status" id="status">
            <option value="aberto" <?= $data === 'aberto' ? 'selected' : '' ?>>Aberto</option>
            <option value="fechado" <?= $data === 'fechado' ? 'selected' : '' ?>>Fechado</option>
        </select>
        <button type="submit">Atualizar Status</button>
        </form>
    </div>