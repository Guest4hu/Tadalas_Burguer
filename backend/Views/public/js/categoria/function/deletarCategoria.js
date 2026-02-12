import Central from "../../central.js";
let central = new Central();
export async function SoftDelete(id) {
    if(await central.confirmar("Você tem certeza que deseja deletar esta categoria?")) {
        return
        await central.FetchDadosGlobal('deletar', "POST", 'categoria', { id: id });
    }

}