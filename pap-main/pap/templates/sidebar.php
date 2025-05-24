<?php
session_start(); // inicia a sessão

// subcategorias com aulas agrupadas
$aulas_categorias = [
    'Introdução' => [
        'aulas.php' => 'Aulas',
    ],
    'Como programar?' => [
        'aula1.php' => 'Instalações',
        'aula2.php' => 'Hello world',
    ],
    'Funções da programação em C++' => [
        'aula3.php' => 'Sintaxe básica',
        'aula4.php' => 'Tipos de dados',
        'aula5.php' => 'Variáveis e constantes',
        'aula6.php' => 'Operadores',
    ],
    'Controle de fluxo' => [
        'aula7.php' => 'Estruturas condicionais',
        'aula8.php' => 'Laços de repetição',
    ],
    'Funções avançadas' => [
        'aula9.php' => 'Definido e chamado funções',
        'aula10.php' => 'Parâmetros e retorno de valores',
    ],
    'Estruturas de dados' => [
        'aula11.php' => 'Arrays',
        'aula12.php' => 'Strings',
        'aula13.php' => 'Estruturas',
    ],
];

// página atual (nome do arquivo da página)
$current_page = basename($_SERVER['PHP_SELF']); // obtém o nome da página atual

// progresso do curso
$total_aulas = 13; // número total de aulas
// conta quantas aulas o usuário já visitou, se o histórico de aulas está salvo na sessão
$aulas_visitadas = isset($_SESSION['historico_aulas']) ? count(array_unique($_SESSION['historico_aulas'])) : 0;
// calcula o progresso em percentual
$progresso = ($aulas_visitadas / $total_aulas) * 100;
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>

<div class="aula-sidebar">
    <ul class="aula-sidebar-menu">
        <li class="aula-sidebar-progress">
            <!-- barra de progresso -->
            <div class="progress mt-3">
                <div class="progress-bar" role="progressbar" style="width: <?= $progresso ?>%;" aria-valuenow="<?= $progresso ?>" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            <small><?= round($progresso, 1) ?>% concluído</small>
        </li>

        <?php foreach ($aulas_categorias as $categoria => $aulas): ?>
            <!-- lista as categorias de aulas -->
            <li class="submenu-toggle">
                <?= $categoria ?>
            </li>
            <ul class="submenu">
                <?php foreach ($aulas as $file => $title): ?>
                    <!-- lista as aulas dentro de cada categoria -->
                    <li class="aula-sidebar-item <?= $current_page === $file ? 'active' : '' ?>">
                        <a href="<?= $file ?>"><?= $title ?></a>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endforeach; ?>
    </ul>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
    // adiciona funcionalidade de click
    document.querySelectorAll(".submenu-toggle").forEach(toggle => {
        toggle.addEventListener("click", function () {
            let submenu = this.nextElementSibling;

            // alterna a visibilidade do submenu
            if (submenu && submenu.classList.contains("submenu")) {
                submenu.classList.toggle("show");
                this.classList.toggle("open");
            }
        });
    });
});
</script>

</body>
</html>
