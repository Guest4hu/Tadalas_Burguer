<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tadala's Burguer</title>

    <style>
        :root {
            --bg: #121212;
        }

        body {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            background: var(--bg);
            position: relative;  
        }

        @keyframes rotate360 {
            to { transform: rotate(360deg); }
        }

        .container {
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            filter: blur(20px);
        }

        .ham {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        #burguer {
            animation: 2s rotate360 infinite ease-in-out;
        }

    </style>

</head>

<body>
<div class="container"></div>

<div class="ham">
    <img src="/backend/Views/templates/loading/loading.png" id="burguer">
</div>


</body>

</html>