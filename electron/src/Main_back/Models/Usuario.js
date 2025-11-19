class Usuario{
    constructor(){
        this.usuario = [
            {nome:'victor', senha:'default'},
            {nome: 'gabriel', senha: 'default' }
        ]
    }
    adiocionar(){
        this.usuario.push()
    }
    listar(){
        return this.usuario
    }
}
export default Usuario;