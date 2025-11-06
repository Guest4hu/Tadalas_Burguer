
(function(){
  function initProdutos() {
    const grid = document.querySelector('.menu-grid');
    if (!grid) return;

   
    // const produtos = [
    //   { id: 101, nome: 'Dallas Burger', descricao: 'Carne 180g, cheddar e bacon crocante.', preco: 29.90 },
    //   { id: 102, nome: 'Texano Picante', descricao: 'Jalapeños e molho especial.', preco: 31.90 },
    //   { id: 103, nome: 'BBQ Supreme', descricao: 'Duplo com barbecue e cebola crispy.', preco: 34.90 },
    //   { id: 201, nome: 'Batatas Crocantes', descricao: 'Crocantes por fora, macias por dentro.', preco: 14.90 },
    //   { id: 301, nome: 'Shake Chocolate', descricao: 'Cremoso e com cobertura.', preco: 17.90 },
    //   { id: 401, nome: 'Refrigerante', descricao: '350ml bem gelado.', preco: 7.90 }
    // ];

    const cards = grid.querySelectorAll('.card');
    cards.forEach((card, index) => {
      //const produto = produtos[index];
      //if (!produto) return;

      const h3 = card.querySelector('h3');
      const p = card.querySelector('p');
      const price = card.querySelector('.price');
      const addBtn = card.querySelector('.add');

      if (h3 && !h3.textContent) h3.textContent = produto.nome;
      if (p && !p.textContent) p.textContent = produto.descricao;
      if (price && !price.textContent) price.textContent = 'R$ ' + produto.preco.toFixed(2).replace('.', ',');

      console.log('passou por aqui')

      if (addBtn && addBtn.dataset.wired !== '1') {
        addBtn.dataset.id = String(produto.id);
        addBtn.dataset.nome = produto.nome;
        addBtn.dataset.preco = String(produto.preco);
        addBtn.dataset.wired = '1';
        addBtn.addEventListener('click', function(){
          if (typeof window.adicionarAoCarrinho === 'function') {
            window.adicionarAoCarrinho(produto.id, produto.nome, produto.preco);
          } else {
            console.warn('Função adicionarAoCarrinho não encontrada. Verifique ordem dos scripts.');
          }
        });
      }
    });
  }

  document.addEventListener('DOMContentLoaded', initProdutos);
  document.addEventListener('menu-ready', initProdutos);
})();
