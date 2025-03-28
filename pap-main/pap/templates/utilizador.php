<?php
session_start();

// Redireciona se o usuário não estiver logado
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

// Inclui o rastreamento de progresso
require_once "track_progress.php";

$pageNames = [
    'aula1.php' => '📘 Instalações',
    'aula2.php' => '👨‍💻 Primeiro Programa',
    'aula3.php' => '📝 Sintaxe Básica',
    'aula4.php' => '🔢 Tipos de Dados',
    'aula5.php' => '🔧 Variáveis e Constantes',
    'aula6.php' => '➗ Operadores',
    'aula7.php' => '📝 Estruturas Condicionais',
    'aula8.php' => '🔄 Laços de Repetição',
    'aula9.php' => '🔁 Funções Definidas',
    'aula10.php' => '↩️ Parâmetros de Funções',
    'aula11.php' => '🔁 Funções Recursivas',
    'aula12.php' => '📊 Arrays',
    'aula13.php' => '📚 Classes',
    'aula14.php' => '🔧 Estruturas (struct)',
];

$total_aulas = count($pageNames);
$aulas_visitadas = count(array_unique($_SESSION['historico_aulas']));
$progresso = ($total_aulas > 0) ? ($aulas_visitadas / $total_aulas) * 100 : 0;
?>

<!doctype html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="shortcut icon" href="favicon.png">
  <title>Perfil - Kiocode</title>
</head>

<body>
  <div class="container mt-5">
    <h1>Olá, <?php echo htmlspecialchars($_SESSION['name']); ?></h1>

    <h5><i class="fa fa-history"></i> Histórico das Aulas:</h5>
    <ul>
        <?php
        if (!empty($_SESSION['historico_aulas'])) {
            foreach (array_reverse($_SESSION['historico_aulas']) as $page) {
                $pageName = $pageNames[$page] ?? ucfirst(str_replace('.php', '', $page));
                echo "<li><a href='$page'>$pageName</a></li>";
            }
        } else {
            echo "<li>Nenhuma aula visitada ainda.</li>";
        }
        ?>
    </ul>

    <div class="progress mt-3">
        <div class="progress-bar bg-success" role="progressbar" style="width: <?php echo $progresso; ?>%;" aria-valuenow="<?php echo $progresso; ?>" aria-valuemin="0" aria-valuemax="100"></div>
    </div>
    <small><?php echo round($progresso, 2); ?>% do total de aulas concluídas.</small>

    <form action="logout.php" method="post">
        <button type="submit" class="btn btn-danger">Logout</button>
    </form>
  </div>
</body>
</html>
