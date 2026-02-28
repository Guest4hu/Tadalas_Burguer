
export function userLogged() {
    const grid = document.getElementById('UserLogin');
    
    // Tenta pegar do input hidden (gerado pelo PHP)
    const hiddenInput = document.getElementById('usuario_id');
    const userData = hiddenInput ? hiddenInput.value : sessionStorage.getItem('usuario_id');

    console.log('Dados do usuário logado:', userData);

    if (userData){
             grid.innerHTML = `<a href="carrinho.php" class="cart-link" aria-label="Ir para o carrinho">
              <svg class="icon-cart" viewBox="0 0 24 24" aria-hidden="true">
                <path d="M7 18c-1.1 0-1.99.9-1.99 2S5.9 22 7 22s2-.9 2-2-.9-2-2-2zm10 0c-1.1 0-1.99.9-1.99 2S15.9 22 17 22s2-.9 2-2-.9-2-2-2zM7.16 14h9.69c.75 0 1.41-.41 1.75-1.03l3.58-6.49A1 1 0 0 0 21.31 5H6.21L5.27 3.57A2 2 0 0 0 3.61 3H2a1 1 0 0 0 0 2h1.61l3.6 5.59-1.35 2.44A2 2 0 0 0 7.16 14zM7.42 7h12.61l-2.8 5H8.53L7.42 7z" />
              </svg>
            </a>
            <button class="cart-link modalSeeOrder" aria-label="Visualizar pedidos">
              <svg class="icon-cart" viewBox="0 0 24 24" aria-hidden="true">
                <path d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zM12 17c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z"/>
              </svg>
            </button>
            `
    } else {
        grid.innerHTML = `<a href="./backend/login" class="user-link" aria-label="Acessar conta">
        <svg class="icon-user" viewBox="0 0 24 24" aria-hidden="true">
          <path d="M12 12c2.7 0 5-2.3 5-5s-2.3-5-5-5-5 2.3-5 5 2.3 5 5 5zm0 2c-3.3 0-10 1.7-10 5v3h20v-3c0-3.3-6.7-5-10-5z" />
        </svg>
      </a>`
    }
}