<?php
if (!isset($_SESSION)) session_start(); // inicia a sessão, se ainda não estiver iniciada

// lista das páginas das aulas
$aulas = [
    'aula1.php', 'aula2.php', 'aula3.php', 'aula4.php', 'aula5.php',
    'aula6.php', 'aula7.php', 'aula8.php', 'aula9.php', 'aula10.php',
    'aula11.php', 'aula12.php', 'aula13.php', 'aula14.php'
];

// verifica se o histórico de aulas não foi definido, caso não, inicializa como um array vazio
if (!isset($_SESSION['historico_aulas'])) {
    $_SESSION['historico_aulas'] = [];
}

// obtém o nome da página atual
$pagina_atual = basename($_SERVER['PHP_SELF']);
// se a página atual for uma das aulas e ainda não estiver no histórico de aulas, adiciona ao histórico
if (in_array($pagina_atual, $aulas) && !in_array($pagina_atual, $_SESSION['historico_aulas'])) {
    $_SESSION['historico_aulas'][] = $pagina_atual;
}
?>
