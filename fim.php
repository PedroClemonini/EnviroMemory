<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.cdnfonts.com/css/common-pixel" rel="stylesheet">
    <link rel="icon" href="imagens/favicon.png" type="image/x-icon">
    <title>Enviro Memory - Winner</title>

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

        a, h1, h2, h3, p {
            font-family: 'Common Pixel', sans-serif;
        }

        #botao {
            color: #2f2d2d;
            border: 3px solid #2f2d2d;
            border-radius: 5px;
            background: #dee74f;
            text-decoration: none;
            padding: 5px;
        }

        #botao:hover {
            background: #74b111;
        }

        .fim {
            text-align: center;
        }

        img {
            width: 25%;
        }
    </style>

</head>
</html>

<?php
session_start();

if (isset($_SESSION['memory_game'])) {
    $dados = $_SESSION['memory_game'];

    // Busca os valores específicos da SESSION
    $attempts = $dados['attempts'];
    $score = $dados['score'];
    $matches = $dados['matches'];

    echo '<div class="fim">';
    echo '<img src="./imagens/win.gif" alt="Personagem Enviro Memory">';
    echo "<h2>Parabens, voce venceu!</h2>";
    echo "<h3>Pontos: " . $score . "</h3>";
    echo "<h3>Tentativas: " . $attempts . "</h3>";
    echo '<div>';

    if ($dados['matches'] == 8) {
        echo '<h4><a id="botao" href="medio.php">Avancar para proxima fase!</a></h4>';
    } else if ($dados['matches'] == 10) {
        echo '<h4><a id="botao" href="dificil.php">Avancar para proxima fase!</a></h4>';
    } else {
       echo '<h4><a id="botao" href="index.php">Voltar ao menu!</a></h4>';
    }

    unset($_SESSION['memory_game']); // Remove os dados da sessão para reiniciar o jogo

} else {
    // Caso a SESSION 'memory_game' não esteja definida
    echo "A variável de sessão 'memory_game' não está definida.";
}

?>



