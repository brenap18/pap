<?php
if (!isset($_SESSION)) session_start();

$aulas = [
    'aula1.php', 'aula2.php', 'aula3.php', 'aula4.php', 'aula5.php',
    'aula6.php', 'aula7.php', 'aula8.php', 'aula9.php', 'aula10.php',
    'aula11.php', 'aula12.php', 'aula13.php', 'aula14.php'
];

if (!isset($_SESSION['historico_aulas'])) {
    $_SESSION['historico_aulas'] = [];
}

$pagina_atual = basename($_SERVER['PHP_SELF']);
if (in_array($pagina_atual, $aulas) && !in_array($pagina_atual, $_SESSION['historico_aulas'])) {
    $_SESSION['historico_aulas'][] = $pagina_atual;
}
?>
