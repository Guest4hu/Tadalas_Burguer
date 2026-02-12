import { SoftDelete } from "./function/deletarCargo.js";

document.querySelectorAll('.btn-delete').forEach(button => {
   button.addEventListener('click', async () => {
      const cargoId = button.getAttribute('data-id');
      await SoftDelete(cargoId);
   });
});