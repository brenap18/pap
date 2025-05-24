<?php
session_start(); // inicia a sessão

// redireciona se o usuário não estiver logado
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

// inicializa o histórico de navegação se ainda não existir
if (!isset($_SESSION['historico_aulas'])) {
    $_SESSION['historico_aulas'] = [];
}

// lista completa de aulas com nomes legíveis
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
];

// cálculo do progresso baseado no histórico de aulas
$total_aulas = count($pageNames);
$aulas_visitadas = count(array_unique($_SESSION['historico_aulas']));
$progresso = ($aulas_visitadas / $total_aulas) * 100;

// obtém o histórico de aulas em ordem inversa
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
  <!-- início da navegação -->
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
              // mostra o ícone do usuário logado
              echo '<li><a class="nav-link" href="utilizador.php"><img src="http://localhost/pap-main/pap/static/images/user.png"></a></li>';
          } else {
              // mostra o ícone de login para quem não está logado
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

    <div class="row gutters-sm">
        <!-- Left Column (Profile Card) -->
        <div class="col-md-4 mb-3">
            <div class="card profile-card-custom">
                <div class="card-body">
                    <div class="d-flex flex-column align-items-center text-center">
                        <img src="<?php echo isset($_SESSION['foto_perfil']) ? $_SESSION['foto_perfil'] : 'https://bootdey.com/img/Content/avatar/avatar3.png'; ?>" 
                             alt="Foto de Perfil" class="rounded-circle" width="150" height="150" style="object-fit: cover; border: 4px solid #4a4b8b;">
                        <div class="mt-3">
                            <h4><?php echo $_SESSION['name']; ?></h4>
                            <a href="editar.php" class="btn btn-primary">Editar Perfil</a>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Progress Card -->
            <div class="card mb-3 profile-card-custom">
                <div class="card-body">
                    <h5 class="d-flex align-items-center mb-3">
                        <i class="fa fa-tasks mr-2"></i>Progresso das Aulas
                    </h5>
                    <div class="progress mb-3" style="height: 10px">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: <?php echo $progresso; ?>%;" 
                             aria-valuenow="<?php echo $progresso; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <small><?php echo round($progresso, 2); ?>% do total de aulas concluídas.</small>
                </div>
            </div>
                        <!-- Logout Button -->
<div class="text-left mt-4">
    <form action="logout.php" method="POST">
        <button type="submit" class="btn btn-danger w-auto ms-3">Sair</button>
    </form>
</div>

        </div>
        
        
        <!-- Right Column (Your Content) -->
        <div class="col-md-8">
            <!-- User Details Card -->
            <div class="card mb-3 profile-card-custom">
                <div class="card-body">
                    <h5 class="d-flex align-items-center mb-4">
                        <i class="fa fa-user-circle mr-2"></i> Informações Pessoais
                    </h5>
              
                    <div class="row">
                        <div class="col-sm-4">
                            <h6 class="mb-0">Nome Completo</h6>
                        </div>
                        <div class="col-sm-8 text-secondary">
                            <?php echo $_SESSION['name']; ?>
                        </div>
                    </div>
                    <hr>

                    <div class="row">
                        <div class="col-sm-4">
                            <h6 class="mb-0">Username</h6>
                        </div>
                        <div class="col-sm-8 text-secondary">
                            <?php echo $_SESSION['user_name']; ?>
                        </div>
                    </div>
                    <hr>

                    <div class="row">
                        <div class="col-sm-4">
                            <h6 class="mb-0">Palavra-passe</h6>
                        </div>
                        <div class="col-sm-8 text-secondary">
                            <?php
                            // Ensure the password exists in the session before displaying asterisks
                            if (isset($_SESSION['password'])) {
                                // Display asterisks matching the length of the password
                                echo str_repeat('*', strlen($_SESSION['password']));
                            } else {
                                echo '*******'; // Handle if password is not set
                            }
                            ?>
                        </div>
                    </div>
             
                    
                    <hr>
                </div>
            </div>

            
            
            <!-- Your History Section -->
            <?php
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
?>

<div class="card mb-3 profile-card-custom">
    <div class="card-body">
        <h5 class="d-flex align-items-center mb-3">
            <i class="fa fa-history mr-2"></i> Histórico das Aulas
        </h5>
        
        <div class="row g-3">
            <?php if (!empty($_SESSION['historico_aulas'])): ?>
                <?php foreach ($_SESSION['historico_aulas'] as $page): ?>
                    <?php $pageName = $pageNames[$page] ?? ucfirst(str_replace('.php', '', $page)); ?>
                    <div class='col-md-6'>
                        <div class='card aula-card shadow-sm h-100'>
                            <div class='card-body d-flex align-items-center'>
                                <div class='me-3' style='font-size: 1.5rem;'>📘</div>
                                <div>
                                    <h5 class='card-title mb-1'>
                                        <a href="<?php echo $page; ?>" class='text-decoration-none text-dark'><?php echo $pageName; ?></a>
                                    </h5>
                                    <p class='card-text'><small class='text-muted'>Aula visitada recentemente</small></p>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class='text-muted'>Nenhuma aula visitada ainda.</p>
            <?php endif; ?>
        </div>
    </div>
</div>

  <script src="js/bootstrap.bundle.min.js"></script>
  <script src="js/tiny-slider.js"></script>
  <script src="js/custom.js"></script>
</body>
</html>