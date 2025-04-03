<?php
session_start();

// Redireciona se o usuário não estiver logado
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

// Inicializa o histórico de navegação se ainda não existir
if (!isset($_SESSION['historico_aulas'])) {
    $_SESSION['historico_aulas'] = [];
}

// Lista completa de aulas com nomes legíveis
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
$progresso = ($aulas_visitadas / $total_aulas) * 100;
$historico = array_reverse($_SESSION['historico_aulas']);
?>

<!doctype html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="shortcut icon" href="favicon.png">
  <meta name="description" content="Site dedicado ao ensino de C++">
  <meta name="keywords" content="bootstrap, bootstrap4, C++, programação">
  <link href="../static/css/bootstrap.min.css" rel="stylesheet">
  <link href="../static/css/tiny-slider.css" rel="stylesheet">
  <link href="../static/css/perfil.css" rel="stylesheet">
  <link href="../static/css/style.css" rel="stylesheet">
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <title>Perfil - Kiocode</title>
</head>

<body>
  <!-- Início da Navegação -->
  <nav class="custom-navbar navbar navbar-expand-md navbar-dark bg-dark">
    <div class="container">
      <a href="index.php" class="navbar-brand">
        <img src="http://localhost/pap-main/pap/static/images/logo.png" alt="Logo" class="logo">
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsFurni">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarsFurni">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
          <li class="nav-item"><a class="nav-link" href="sobre.php">Sobre nós</a></li>
          <li class="nav-item"><a class="nav-link" href="aulas.php">Aulas</a></li>
          <li class="nav-item"><a class="nav-link" href="contact.php">Contactos</a></li>
        </ul>
        <ul class="navbar-nav ms-5">
          <?php
          if (isset($_SESSION['id'])) {
              echo '<li><a class="nav-link" href="utilizador.php"><img src="http://localhost/pap-main/pap/static/images/user.png"></a></li>';
          } else {
              echo '<li><a class="nav-link" href="login.php"><img src="http://localhost/pap-main/pap/static/images/user.png"></a></li>';
          }
          ?>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container mt-5">
    <h1>Olá, <?php echo $_SESSION['name']; ?></h1>
    <p>Esta é a sua página de utilizador.</p>

    <!-- User Profile Section -->
    <div class="row">
      <div class="profile-nav col-md-3">
        <div class="panel">
          <div class="user-heading round">
            <a href="#">
              <img src="https://bootdey.com/img/Content/avatar/avatar3.png" alt="">
            </a>
            <h1 style="color: black;"><?php echo $_SESSION['name']; ?></h1>
          </div>
          <ul class="nav nav-pills nav-stacked">
            <li><a href="#"> <i class="fa fa-edit"></i> Editar perfil</a></li>
          </ul>
        </div>
      </div>
      <div class="profile-info col-md-9">
        <div class="panel">
          <div class="bio-graph-heading">
            <h5><i class="fa fa-history"></i> Histórico das Aulas:</h5>
            <ul class="list-group">
                <?php
                if (!empty($_SESSION['historico_aulas'])) {
                    foreach (array_reverse($_SESSION['historico_aulas']) as $page) {
                        $pageName = $pageNames[$page] ?? ucfirst(str_replace('.php', '', $page));
                        echo "<li class='list-group-item'><a href='$page' class='text-decoration-none'>$pageName</a></li>";
                    }
                } else {
                    echo "<li class='list-group-item'>Nenhuma aula visitada ainda.</li>";
                }
                ?>
            </ul>

            <!-- Barra de Progresso -->
            <div class="progress mt-3">
                <div class="progress-bar bg-success" role="progressbar" style="width: <?php echo $progresso; ?>%;" aria-valuenow="<?php echo $progresso; ?>" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            <small><?php echo round($progresso, 2); ?>% do total de aulas concluídas.</small>
          </div>

          <!-- Gráfico de Progresso -->
          <div class="progress-container mt-4">
            <canvas id="progressChart"></canvas>
          </div>

          <form action="logout.php" method="post">
              <button type="submit" class="btn btn-danger">Logout</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <script>
    const progresso = <?php echo $progresso; ?>;
    const ctx = document.getElementById('progressChart').getContext('2d');
    new Chart(ctx, {
      type: 'doughnut',
      data: {
        labels: ['Concluído', 'Restante'],
        datasets: [{
          data: [progresso, 100 - progresso],
          backgroundColor: ['#28a745', '#e0e0e0']
        }]
      },
      options: { responsive: true, maintainAspectRatio: false }
    });
  </script>
</body>
</html>
