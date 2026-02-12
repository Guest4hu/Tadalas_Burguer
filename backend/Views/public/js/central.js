// central.js
// Classe responsável por funções utilitárias centrais da aplicação

class Central {
  constructor() {
    this.notificacao = '/assets/audio/notificacao.mp3';
    this.negar = '/assets/audio/negacacao.mp3';
    this.confirmar = '/assets/audio/confirm.mp3';
  }

  tocarAudio(audio){
    let som = new Audio(audio);
    som.play();
  }

  
  // Exibe alerta de confirmação usando SweetAlert2
 

  // Realiza requisição fetch global
  async FetchDadosGlobal(url, metodo, controller, dados = "") {
    const config = {
      method: metodo,
      cache: "no-store",
      headers: {
        "Content-Type": "application/json",
        "Authorization": "Bearer 5d242b5294d72df332ca2c492d2c0b9b"
      }
    };
    if (metodo === "POST") {
      config.body = JSON.stringify(dados);
    }
    const res = await fetch(`/backend/${controller}/api/${url}`, config);
    return await res.json();
  }
}

export default Central;
