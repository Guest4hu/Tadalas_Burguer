

(function(){
  const STORAGE_KEY = 'carrinhoTadallas';

  function obterCarrinho() {
    try {
      const raw = localStorage.getItem(STORAGE_KEY);
      return raw ? JSON.parse(raw) : [];
    } catch (e) {
      return [];
    }
  }


  async function enviarPedido(usuarioId, itens) {
    const resp = await fetch('/backend/pedidos/salvar', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ usuario_id: usuarioId, itens })
    });
    const data = await resp.json().catch(() => ({ sucesso: false }));
    return { ok: resp.ok, data };
  }

  document.addEventListener('DOMContentLoaded', function(){
    const finalizarBtn = document.getElementById('finalizar-pedido');
    const form = document.getElementById('checkout-form');
    const idInput = document.getElementById('id-usuario');


    if (idInput && !idInput.value) {
      idInput.value = '3'
    }

    if (finalizarBtn && form) {
      finalizarBtn.addEventListener('click', async function(){
        const uid = (idInput && idInput.value) ? idInput.value : '';
        if (!uid) {
          alert('Defina o ID do usuário antes de finalizar o pedido.');
          return;
        }

        const itens = obterCarrinho();
        if (!Array.isArray(itens) || itens.length === 0) {
          alert('Seu carrinho está vazio.');
          return;
        }

        finalizarBtn.disabled = true;
        finalizarBtn.textContent = 'Enviando...';
        try {
          const { ok, data } = await enviarPedido(parseInt(uid, 10), itens);
          if (ok && data && data.sucesso) {
            localStorage.removeItem(STORAGE_KEY);
            alert('Pedido criado com sucesso! Nº ' + data.pedido_id);
          } else {
            alert((data && data.mensagem) ? data.mensagem : 'Falha ao criar pedido.');
          }
        } catch (e) {
          alert('Erro de rede ao enviar o pedido.');
        } finally {
          finalizarBtn.disabled = false;
          finalizarBtn.textContent = 'Finalizar Pedido';
        }
      });
    }
  });
})();
