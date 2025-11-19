import Usuario from '../Models/Usuario.js';
class UsuarioController{
    constructor(){
        this.usuario = new Usuario();
    }
    async cadastrar(usuario){
        this.usuario.adiocionar(usuario);

    }
    async listar(){
        const dados = await TouchList.usuario.listar();
        console.log('dados do controller', dados);
    }
}