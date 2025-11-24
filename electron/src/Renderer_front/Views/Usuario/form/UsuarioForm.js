import MensagemDeAlerta from "../../../Services/MensagemDeAlerta";
import UsuarioView from "../UsuarioView";
class UsuarioForm{
    constructor(){
        this.view = new UsuarioView();
        this.alerta = new MensagemDeAlerta();
    }

    renderizarFormulario(){
        setTimeout(() => {
            this.adicionareventos();
            console.log("evento criado")
        }, 0);
    }


    adicionareventos(){
        const formulario = document.getElementById('form-usuario');
        formulario.addEventListener('submit', async (event) =>{
            event.preventDefault();
            console.log(event);
            const nome = document.getElementById('nome');
            const senha = document.getElementById('senha');
            const usuario = {
                nome: nome.value,
                senha: senha.value
            }
            const resultado = await window.api.Usuario.cadastrar(usuario);
            if(resultado){
                nome.value = '';
                senha.value = '';
                this.alerta.sucesso()
            }
            else{
                this.alerta.erro()
            }
        });
    
}
}
export default UsuarioForm;