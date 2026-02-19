
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


  async function enviarPedido(usuarioId, itens, tipoPedido = 1) {
    const resp = await fetch('/backend/pedidos/salvar', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ usuario_id: usuarioId, tipo_pedido: tipoPedido, itens })
    });
    const text = await resp.text();
    let data = { sucesso: false, mensagem: 'Resposta inválida do servidor.' };
    try {
      data = text ? JSON.parse(text) : data;
    } catch (e) {
      data = { sucesso: false, mensagem: text || 'Erro ao interpretar resposta.' };
    }
    return { ok: resp.ok, data };
  }

  document.addEventListener('DOMContentLoaded', function(){
    const finalizarBtn = document.getElementById('finalizar-pedido');
    const finalizarCarrinhoBtn = document.getElementById('finalizar-carrinho');
    const form = document.getElementById('checkout-form');
    const idInput = document.getElementById('id-usuario');

    async function carregarUsuario() {
      if (!idInput) return;
      if (idInput.value) return;
      try {
        const resp = await fetch('/backend/me');
        const data = await resp.json();
        if (data && data.logged_in && data.usuario_id) {
          idInput.value = data.usuario_id;
        }
      } catch (e) {
        // silencioso
      }
    }

    carregarUsuario();

    if (finalizarBtn && form) {
      finalizarBtn.addEventListener('click', async function(){
        const uid = (idInput && idInput.value) ? idInput.value : '';
        if (!uid) {
          alert('Faça login para finalizar o pedido.');
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
          const { ok, data } = await enviarPedido(parseInt(uid, 10), itens, 1);
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

    if (finalizarCarrinhoBtn && form) {
      finalizarCarrinhoBtn.addEventListener('click', async function(){
        const uid = (idInput && idInput.value) ? idInput.value : '';
        if (!uid) {
          alert('Faça login para finalizar o pedido.');
          return;
        }

        const itens = obterCarrinho();
        if (!Array.isArray(itens) || itens.length === 0) {
          alert('Seu carrinho está vazio.');
          return;
        }

        finalizarCarrinhoBtn.disabled = true;
        finalizarCarrinhoBtn.textContent = 'Enviando...';
        try {
          const { ok, data } = await enviarPedido(parseInt(uid, 10), itens, 1);
          if (ok && data && data.sucesso) {
            localStorage.removeItem(STORAGE_KEY);
            alert('Pedido criado com sucesso! Nº ' + data.pedido_id);
            window.location.href = 'finalizar.php';
          } else {
            alert((data && data.mensagem) ? data.mensagem : 'Falha ao criar pedido.');
          }
        } catch (e) {
          alert('Erro de rede ao enviar o pedido.');
        } finally {
          finalizarCarrinhoBtn.disabled = false;
          finalizarCarrinhoBtn.textContent = 'Finalizar pedido';
        }
      });
    }
  });
})();
