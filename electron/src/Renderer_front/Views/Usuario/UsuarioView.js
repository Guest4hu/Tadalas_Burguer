
class UsuarioView{
    constructor(){

    }
    renderizarLista(Usuarios){
        let container ='<div class="container">';
        Usuarios.foreach(usuario =>{
            container += `<div> Nome: ${usuario.nome} - Senha: ${usuario.senha} </div> </br>`;
        });
        container += '</div>';
        return container;
    }
    renderizarFormulario(){
        return `
        <div class="container">
            <form id="form-usuario">
                <label for="nome">Nome:</label>
                <input type="text" id="nome" name="nome" required>
                <br>
                <label for="senha">Senha:</label>
                <input type="password" id="senha" name="senha" required>
                <br>
                <button type="submit">Cadastrar</button>
            </form>
        </div>
        `
    }
}
export default UsuarioView;