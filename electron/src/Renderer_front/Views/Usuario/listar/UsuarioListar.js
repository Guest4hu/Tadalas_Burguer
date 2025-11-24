import UsuarioView from "../UsuarioView";
class UsuarioListar{
    constructor(){
        this.view = new UsuarioView();
    }
    async renderizarLista(){
        const dados = await window.api.Usuarios.listar();
        console.log('dados de usuarios na lista', dados);
        return this.view.renderizarLista(dados);
    }

}
export default UsuarioListar;