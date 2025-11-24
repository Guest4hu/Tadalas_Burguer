class Confuguracao{
    constructor(){
        this.verificarconexao();
    }
    verificarconexao(){
        const updateOnlineStatus = () => {
            document.getElementById('status').innerHTML = navigator.onLine ? 'Online' : 'Offline';
        }
        window.addEventListener('online',  updateOnlineStatus);
        window.addEventListener('offline', updateOnlineStatus);
    }
}
export default Confuguracao;