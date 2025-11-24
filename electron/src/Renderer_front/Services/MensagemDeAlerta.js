import Swal from "sweetalert2";
class MensagemDeAlerta {
    constructor(){
        this.alerta = Swal;
    }
    sucesso(){
        this.alerta.fire({
            position: 'top-end',
            icon: 'success',
            title: "cadastrado com sucesso",
            showConfirmButton: false,
            timer: 1500
        })
    }
    erro(){
        this.alerta.fire({
            position: 'top-end',
            icon: 'error',
            title: "preencha todos os campos",
            showConfirmButton: false,
            timer: 1500
        })
    }
    
}
export default MensagemDeAlerta;