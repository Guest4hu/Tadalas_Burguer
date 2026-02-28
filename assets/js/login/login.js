

import { userLogged } from './function/loginFunctions.js';
import { modalSeeOrder } from './function/modalSeeOrder.js';

userLogged();


document.addEventListener('click', (event) => {
    const btn = event.target.closest(".modalSeeOrder");
    if (!btn) return;
    modalSeeOrder();
})