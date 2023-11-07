<!DOCTYPE html>

<!--Erik Eduardo Santos de Oliveira
GU3046061

Pedro Marques Clemonini
GU3046877-->

<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.cdnfonts.com/css/common-pixel" rel="stylesheet">
    <link rel="icon" href="imagens/favicon.png" type="image/x-icon">
    <title>Enviro Memory</title>    

    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-image: url(imagens/background.png);
            font-family: 'Common Pixel', sans-serif;
        }

        #logo {
            width: 30%;
            filter: saturate(130%);
        }

        .dificuldade {
            text-align: center;
        }

        .dificuldade button {
            margin: 5px;
            border: 3px solid #2f2d2d;
            border-radius: 5px;
            background: #dee74f;
            font-size: 20px;
            font-family: 'common pixel', sans-serif;
        }

        .dificuldade button:hover {
            background: #74b111;
        }

        .dificuldade a {
            text-decoration: none;
            color: #000;
        }
    </style>

</head>
<body>

<div class="dificuldade">
        <img src="imagens/LogoEnviroMemory.png" id="logo">
        <h2>Escolha um nível:</h2>

        <button><a href="facil.php">Facil</a></button>
            
        <button><a href="medio.php">Medio</a></button>

        <button><a href="dificil.php">Dificil</a></button>
    </div>   

</body>   
</html>

<?php
session_start();

unset($_SESSION['memory_game']); // Remove os dados da sessão para reiniciar o jogo
?>
