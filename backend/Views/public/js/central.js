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


  async alertaConfirmacao(titulo, texto, icone) {
    const result = await Swal.fire({
      title: titulo,
      text: texto,
      icon: icone,
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Sim",
    });
    return result.isConfirmed === true;
  }
 
  // Exibe modal de carregamento usando SweetAlert2
  abrirCarregar() {
    Swal.fire({
      title: "CARREGANDO",
      html: "Espere por favor...",
      allowEscapeKey: false,
      allowOutsideClick: false,
      showConfirmButton: false,
      didOpen: () => {
        Swal.showLoading();
      }
    });
  }
 
  // Fecha modal de carregamento e exibe mensagem de feedback
  fecharCarregar(icone, mensagem) {
    Swal.close();
    Swal.fire({
      position: "top-end",
      icon: icone,
      title: mensagem,
      showConfirmButton: false,
      timer: 900
    });
  }
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
