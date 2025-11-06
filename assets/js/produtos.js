
(function(){
  function initProdutos() {
    const grid = document.querySelector('.menu-grid');
    
    if (!grid) return;

    const cards = grid.querySelectorAll('.card');

    cards.forEach((card) => {

      const id = card.querySelector('input').value
      const nome = card.querySelector('h3').innerText;
      const price = card.querySelector('.price').innerText;
      const addBtn = card.querySelector('.add');

      const priceSplit = price.split(" ")[1].split(",")
      const preco = `${priceSplit[0]}.${priceSplit[1]}`

      if (addBtn && addBtn.dataset.wired !== '1') {
        addBtn.dataset.id = String(id);
        addBtn.dataset.nome = nome;
        addBtn.dataset.preco = preco;
        addBtn.dataset.wired = '1';
        addBtn.addEventListener('click', function(){
          if (typeof window.adicionarAoCarrinho === 'function') {
            window.adicionarAoCarrinho(id, nome, preco);
          } else {
            console.warn('Função adicionarAoCarrinho não encontrada. Verifique ordem dos scripts.');
          }
        });
      }
    });
  }

  // Toda vez que a página é carregada, ele roda essa função initProdutos que adiciona os atributos ao dataset dos botões de 'adicionar' e cria o eventListener que chama a função 'adicionarAoCarrinho' do carrinho.js
  document.addEventListener('DOMContentLoaded', initProdutos);
  document.addEventListener('menu-ready', initProdutos);
})();
