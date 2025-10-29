<div class="w3-container">
    <h3 class="w3-text-red">Confirmar Atualização de Pedido</h3>
    
    <div class="w3-container w3-card-4 w3-padding">
        <p>Você tem certeza que deseja colocar este pedido para a próxima atualização de produção?</p>
        
        <h4><strong><?= htmlspecialchars($pedido['descricao'] ?? ''); ?></strong></h4>
        
        <p>Após confirmar, o pedido será movido para a fila de produção. Esta ação não pode ser desfeita facilmente.</p>

        <form action="/backend/pedidos/atualizarProcesso" method="POST">
            <input type="hidden" name="id_pedido" value="<?= $pedido['id_pedido']; ?>">
            <input type="hidden" name="status_pedido_id" value="2">
            <p>
                <button type="submit" class="w3-button w3-red w3-padding">Sim, Atualizar para Produção</button>
                <a href="/backend/pedidos/listar/1" class="w3-button w3-grey w3-padding">Cancelar</a>
            </p>
        </form>
    </div>
</div>