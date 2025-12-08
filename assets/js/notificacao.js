const notificacao = new Audio('/assets/audio/notificacao.mp3');
const negar = new Audio('/assets/audio/negacacao.mp3');
const confirmar = new Audio('/assets/audio/confirm.mp3');



function notificar(icon,titulo,){
    Swal.fire({
         position: "top-end",
         icon: icon,
         title: titulo,
         showConfirmButton: false,
         timer: 3000,
         timerProgressBar: true,
      });
}




