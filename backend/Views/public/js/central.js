// central.js
// Classe responsável por funções utilitárias centrais da aplicação

class Central {
  constructor() {
    // Inicialização, se necessário
  }

  async alertaConfirmacao(titulo, text, icon) {
    const result = await Swal.fire({
      title: titulo,
      text: text,
      icon: icon,
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Sim",
    });
    if (result.isConfirmed) {
      return true;
    }
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
  fecharCarregar(icon,mensagem) {
    Swal.close();
    Swal.fire({
      position: "top-end",
      icon: icon,
      title: mensagem,
      showConfirmButton: false,
      timer: 900
    });
  }


  async FetchDadosGlobal(url, metodo, controller, dados = "") {
    let config = {
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