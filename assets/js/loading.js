function telaDeCarregamento() {

    let limit = document.body.childNodes.length
    let node

    for (let i = 0; i < limit; i++) {
        if (document.body.childNodes[i].nodeName !== '#text') {
            node = document.body.childNodes[i]
            break
        }
    }

    node.classList.add('blur')

    const burguer = document.createElement('div')
    burguer.className = 'ham'
    burguer.innerHTML =
        `
        <img src="/assets/img/loading.png" id="burguer">
    `

    document.body.appendChild(burguer)
}

telaDeCarregamento()

setTimeout(() => {
    history.go(-2)
}, 2000)