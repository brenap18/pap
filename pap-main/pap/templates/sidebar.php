<?php
// Subcategorias com aulas agrupadas
$aulas_categorias = [
    'Fundamentos' => [
        'aula1.php' => 'Aula 1: Introdução ao C++',
        'aula2.php' => 'Aula 2: Variáveis e Tipos de Dados',
        'aula3.php' => 'Aula 3: Operadores e Expressões',
        'aula4.php' => 'Aula 4: Estruturas de Decisão',
        'aula5.php' => 'Aula 5: Ciclos',
    ],
    'Intermédio' => [
        'aula6.php' => 'Aula 6: Arrays',
        'aula7.php' => 'Aula 7: Strings',
        'aula8.php' => 'Aula 8: Funções',
        'aula9.php' => 'Aula 9: Ponteiros',
        'aula10.php' => 'Aula 10: Estruturas',
    ],
    'Avançado' => [
        'aula11.php' => 'Aula 11: POO',
        'aula12.php' => 'Aula 12: Herança e Polimorfismo',
        'aula13.php' => 'Aula 13: Ficheiros',
        'aula14.php' => 'Aula 14: Projeto Final',
    ]
];

// Página atual
$current_page = basename($_SERVER['PHP_SELF']);

// Progresso
session_start();
$total_aulas = 14;
$aulas_visitadas = isset($_SESSION['historico_aulas']) ? count(array_unique($_SESSION['historico_aulas'])) : 0;
$progresso = ($aulas_visitadas / $total_aulas) * 100;
?>

<div class="aula-sidebar">
  <ul class="aula-sidebar-menu">
    <li class="aula-sidebar-title">Conteúdo do Curso</li>

    <?php foreach ($aulas_categorias as $categoria => $aulas): ?>
      <li class="aula-sidebar-subtitle"><?= $categoria ?></li>
      <?php foreach ($aulas as $file => $title): ?>
        <li class="aula-sidebar-item <?= $current_page === $file ? 'active' : '' ?>">
          <a href="<?= $file ?>"><?= $title ?></a>
        </li>
      <?php endforeach; ?>
    <?php endforeach; ?>

    <!-- Barra de progresso -->
    <li class="aula-sidebar-progress">
      <div class="progress mt-3" style="height: 10px;">
        <div class="progress-bar bg-success" role="progressbar" style="width: <?= $progresso ?>%;" aria-valuenow="<?= $progresso ?>" aria-valuemin="0" aria-valuemax="100"></div>
      </div>
      <small><?= round($progresso, 1) ?>% concluído</small>
    </li>
  </ul>
</div>
