import { deletFunc } from "./function/deleteFunc.js";
import Central from "../../central.js";
const principal = new Central();

addEventListener('click', async function(event) {
    if (event.target.classList.contains('btn-delete')) {
        const dados = {
            funcID: event.target.dataset.funcid,
            userID: event.target.dataset.userid
        }
        if (await principal.alertaConfirmacao('Tem certeza?','Excluir funcionário?','info')) {
            await deletFunc(dados);
            window.location.reload();
        }
    }
});