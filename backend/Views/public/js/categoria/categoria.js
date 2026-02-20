

import { SoftDelete } from "./function/deletarCategoria.js";


document.querySelectorAll('.btn-delete').forEach(button => {
   button.addEventListener('click', async () => {
      const categoriaId = button.getAttribute('data-id');
      await SoftDelete(categoriaId);
   });
});