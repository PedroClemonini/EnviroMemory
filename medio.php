<?php
session_start();

// Verifica se o jogo já começou, se não, inicia o jogo
if (!isset($_SESSION['memory_game'])) {
    // Define uma matriz de símbolos que serão usados no jogo (8 pares de cartas)
    $array_itens = ['im01', 'im02','im03','im04','im05','im06','im07','im08','im09', 'im10'];
    // Embaralha os símbolos para criar a ordem aleatória das cartas
    shuffle($array_itens);
    // Duplica os símbolos para criar um conjunto completo de cartas
    $cards = array_merge($array_itens, $array_itens);
    // Embaralha as cartas para que elas apareçam em posições aleatórias no jogo
    shuffle($cards);
    // Inicializa a sessão do jogo com informações iniciais
    $_SESSION['memory_game'] = [
        'cards' => $cards,
        'flipped' => array_fill(0, 20, false), // Inicialmente, nenhuma carta está virada
        'attempts' => 0, // Contagem de tentativas
        'matches' => 0, // Contagem de pares de cartas encontrados
        'score' => 0, // Pontuação do jogador
        'selected_card' => null, // Armazena o índice da carta selecionada atualmente
    ];
}

if (isset($_GET['reset'])) {
    // Se o jogador optar por reiniciar o jogo, remove os dados da sessão e redireciona para a página atual
    unset($_SESSION['memory_game']);
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit;
}

$game = $_SESSION['memory_game'];

if (isset($_GET['card'])) {
    $cardIndex = $_GET['card'];

    if (!$game['flipped'][$cardIndex]) {
        // Verifica se a carta não está virada
        $game['flipped'][$cardIndex] = true; // Vira a carta

        if ($game['selected_card'] === null) {
            $game['selected_card'] = $cardIndex; // Armazena o índice da primeira carta virada
        } else {
            if ($game['cards'][$game['selected_card']] === $game['cards'][$cardIndex]) {
                // Compara a primeira carta selecionada com a segunda
                $game['selected_card'] = null; // As cartas coincidem, então desmarca a primeira carta selecionada
                $game['matches']++; // Incrementa a contagem de pares encontrados
                $game['score'] += 10; // Incrementa a pontuação do jogador
            } else {
                // As cartas não coincidem
                $game['score']--; // Reduz a pontuação do jogador
                $game['attempts']++; // Incrementa a contagem de tentativas
                $game['flipped'][$game['selected_card']] = false; // Desvira a primeira carta selecionada
                $game['flipped'][$cardIndex] = false; // Desvira a segunda carta selecionada
                $game['selected_card'] = null; // Reseta a primeira carta selecionada
            }
        }
    }

    $_SESSION['memory_game'] = $game; // Atualiza os dados do jogo na sessão
}

// Verifica se o jogo foi concluído
if ($game['matches'] == 10) {
    header ('location: fim.php'); // Leva para a página de vitória
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.cdnfonts.com/css/common-pixel" rel="stylesheet">
    <link rel="icon" href="imagens/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="css/style.css">
    <title>Enviro Memory - Médio</title>

    <style>
        body {
            background-image: url(imagens/background.png);
        }

        #logo:hover {
            filter: saturate(130%);
        }
    </style>
</head>

<body>
<a href="index.php">
    <img src="imagens/LogoEnviroMemory.png" id="logo">
</a>
<?php
    echo '<div class="dados">';
    echo '<p>Pontos: ' . $game['score'] . '</p>';
    echo '<p>Tentativas: ' . $game['attempts'] . '</p>';
    echo '<p>Pares Encontrados: ' . $game['matches'] . '</p>';
    echo '<br>';
    echo '<a href="' . $_SERVER['PHP_SELF'] . '?reset=1" id="reset">Reiniciar Jogo</a>';
    echo '</div>';
    echo '<table>';
    for ($row = 0; $row < 4; $row++) {
        echo '<tr>';
        for ($col = 0; $col < 5; $col++) {
            $index = ($row * 5) + $col;
            $card = $game['cards'][$index];
            if ($game['flipped'][$index]) {
                echo '<td><img src="./imagens/' . $card . '.png"></td>';
            } else {
                echo '<td><a href="' . $_SERVER['PHP_SELF'] . '?card=' . $index . '"><img src="./imagens/carta.png"></a></td>';
            }
        }
        echo '</tr>';
    }
    echo '</table>';
?>

</body>
</html>
