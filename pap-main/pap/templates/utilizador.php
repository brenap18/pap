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
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Perfil - Kiocode</title>
  <link rel="shortcut icon" href="favicon.png">
  <link href="../static/css/bootstrap.min.css" rel="stylesheet">
  <link href="../static/css/tiny-slider.css" rel="stylesheet">
  <link href="../static/css/perfil.css" rel="stylesheet">
  <link href="../static/css/style.css" rel="stylesheet">
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
</head>

<body>
  <!-- Início da Navegação -->
  <nav class="custom-navbar navbar navbar-expand-md navbar-dark bg-dark" aria-label="Navegação do Kiocode">
  <div class="container">
      <a href="index.php" class="navbar-brand">
        <img src="http://localhost/pap-main/pap/static/images/logo.png" alt="Logo" class="logo">
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsFurni">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarsFurni">
      <ul class="custom-navbar-nav navbar-nav ms-auto mb-2 mb-md-0">
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

    <div class="row profile-container">
      <div class="profile-nav col-md-3">
        <div class="panel">
        <div class="user-heading round">
            <a>
                <!-- Verifica se existe uma foto de perfil atualizada -->
                <img src="<?php echo isset($_SESSION['foto_perfil']) ? $_SESSION['foto_perfil'] : 'https://bootdey.com/img/Content/avatar/avatar3.png'; ?>" 
                     alt="Foto de Perfil" class="rounded-circle" width="120" height="120" style="object-fit: cover;">
            </a>
            <h1><?php echo $_SESSION['name']; ?></h1>
        </div>
        <ul class="nav nav-pills nav-stacked" style="width: 550px;">
  <li><a href="editar.php" style="display: block; width: 100%; padding: 12px 75.7px;"><i class="fa fa-edit"></i> Editar perfil</a></li>
</ul>

    </div>
      </div>

      <div class="profile-info col-md-9">
        <div class="panel">
          <div class="bio-graph-heading">
            <h5><i class="fa fa-history"></i> Histórico das Aulas:</h5>

            <div class="row g-3">
              <?php
              if (!empty($_SESSION['historico_aulas'])) {
                  foreach ($historico as $page) {
                      $pageName = $pageNames[$page] ?? ucfirst(str_replace('.php', '', $page));
                      echo "
                      <div class='col-md-6'>
                        <div class='card aula-card shadow-sm h-100'>
                          <div class='card-body d-flex align-items-center'>
                            <div class='me-3' style='font-size: 1.5rem;'>📘</div>
                            <div>
                              <h5 class='card-title mb-1'>
                                <a href='$page' class='text-decoration-none text-dark'>$pageName</a>
                              </h5>
                              <p class='card-text'><small class='text-muted'>Aula visitada recentemente</small></p>
                            </div>
                          </div>
                        </div>
                      </div>";
                  }
              } else {
                  echo "<p class='text-muted'>Nenhuma aula visitada ainda.</p>";
              }
              ?>
            </div>

            <div class="progress mt-4">
              <div class="progress-bar bg-success" role="progressbar" style="width: <?php echo $progresso; ?>%;" aria-valuenow="<?php echo $progresso; ?>" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            <small><?php echo round($progresso, 2); ?>% do total de aulas concluídas.</small>
          </div>

          <form action="logout.php" method="post" class="mt-3">
            <button type="submit" class="btn btn-danger">Logout</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <script src="js/bootstrap.bundle.min.js"></script>
  <script src="js/tiny-slider.js"></script>
  <script src="js/custom.js"></script>
</body>
</html>
