

import { SoftDelete } from "./function/deletarProduto.js";


document.querySelectorAll('.btn-delete').forEach(button => {
   button.addEventListener('click', async () => {
      const produtoId = button.getAttribute('data-id');
      await SoftDelete(produtoId);
   });
});