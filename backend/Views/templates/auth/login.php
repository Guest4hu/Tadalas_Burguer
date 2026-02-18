<?php

use App\Tadala\Core\Session;

$session = new Session();

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Tadala’s Burguer - Painel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#111">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway:300,400,600">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <style>
        body {
            height: 100vh;
        }

        html,
        body,
        h1,
        h2,
        h3,
        h4,
        h5 {
            font-family: "Raleway", sans-serif;
        }

        body {
            position: relative;
        }

        .blur {
            filter: blur(5px);
            pointer-events: none;
            user-select: none;
        }

        .ham {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        @keyframes rotate360 {
            to { transform: rotate(360deg); }
        }

        #burguer {
            animation: 2s rotate360 infinite ease-in-out;
        }

    </style>
</head>

<body class="w3-light-grey">

    <div class="w3-container w3-card-4 w3-light-grey w3-text-blue w3-margin w3-center">
        <h1>Login</h1>
        <form action="/backend/login" method="POST" class="w3-panel w3-center">
            <div class="w3-row w3-section">
                <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-envelope-o"></i></div>
                <div class="w3-rest">
                    <input class="w3-input w3-border" name="email_usuario" type="email" placeholder="Email" required>
                </div>
            </div>
            <div class="w3-row w3-section">
                <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-lock"></i></div>
                <div class="w3-rest">
                    <input class="w3-input w3-border" name="senha_usuario" type="password" placeholder="Senha" required>
                </div>
            </div>
            <button type="submit" class="w3-button w3-blue">Entrar</button>
        </form>
        <a href="register">Não tenho conta</a><br>
        <a href="esqueci-senha">Esqueci a senha</a>
    </div>

    <script>
        function telaDeCarregamento() {
            const container = document.querySelector('.w3-container');
            container.classList.add('blur')

            const burguer = document.createElement('div')
            burguer.className = 'ham'
            burguer.innerHTML = `
                    <img src="/assets/img/loading.png" id="burguer">
                `

            document.body.appendChild(burguer)
        }

        <?php if ($session->has('usuario_id')): ?>
            telaDeCarregamento()
            setTimeout(() => {
                history.back()
            }, 2000)
        <?php endif ?>
    </script>

</body>

</html>