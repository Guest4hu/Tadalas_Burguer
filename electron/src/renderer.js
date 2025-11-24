import './index.css'
import Rotas from './Renderer_front/Services/Rotas'
import Confuguracao from './Renderer_front/Services/Configuracao'

const config = new Confuguracao();

const rota_mapeada = new Rotas();

async function navegarPara(rota){
    const html = await rota_mapeada.getPage(rota);
    document.querySelector('#app').innerHTML = html;
}



window.addEventListener('hashchange', async () => {
    const rota = window.location.hash.replace('#' , '/');
    await navegarPara(rota);
});

navegarPara('/usuario_listar');