import UsuarioListar from "../Views/Usuario/listar/UsuarioListar";
import UsuarioForm from "../Views/Usuario/form/UsuarioForm";
class Rotas{
    constructor(){
        this.rotas={
            "/usuario_listar": async () => {
                return new UsuarioListar().renderizarLista;
            },
            "/usuario_form": () => {
                return new UsuarioForm().renderizarFormulario;
            }

        }
    }
    async getPage(rota){
        return this.rotas[rota]();
    }
}
export default Rotas;