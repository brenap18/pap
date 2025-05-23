<?php
session_start();

// Inicializa o histórico de navegação se ainda não existir
if (!isset($_SESSION['history'])) {
    $_SESSION['history'] = [];
}

// Obtém o nome da página atual
$current_page = basename($_SERVER['PHP_SELF']);

// Evita adicionar a mesma página repetidamente
if (empty($_SESSION['history']) || end($_SESSION['history']) !== $current_page) {
    $_SESSION['history'][] = $current_page;
}

// Limita o histórico às últimas 5 páginas
if (count($_SESSION['history']) > 5) {
    array_shift($_SESSION['history']);
}
?>
<!doctype html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="shortcut icon" href="favicon.png">
  <meta name="description" content="Site dedicado ao ensino de C++" />
  <meta name="keywords" content="bootstrap, bootstrap4, C++, programação" />
  <link href="../static/css/bootstrap.min.css" rel="stylesheet">
  <link href="../static/css/tiny-slider.css" rel="stylesheet">
  <link href="../static/css/style.css" rel="stylesheet">
  <link href="../static/css/contas.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
  <title>Registar - Kiocode</title>
</head>

<body>
  <nav class="custom-navbar navbar navbar-expand-md navbar-dark bg-dark" aria-label="Navegação do Kiocode">
    <div class="container">
      <div class="navbar-brand">
        <a href="index.php">
          <img src="http://localhost/pap-main/pap/static/images/logo.png" alt="Logo" class="logo">
        </a>
      </div>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsFurni" aria-controls="navbarsFurni" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarsFurni">
        <ul class="custom-navbar-nav navbar-nav ms-auto mb-2 mb-md-0">
          <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
          <li class="nav-item"><a class="nav-link" href="sobre.php">Sobre nós</a></li>
          <li class="nav-item"><a class="nav-link" href="aulas.php">Aulas</a></li>
          <li class="nav-item"><a class="nav-link" href="contact.php">Contactos</a></li>
        </ul>
        <ul class="custom-navbar-cta navbar-nav mb-2 mb-md-0 ms-5">
    		<?php
    		if (isset($_SESSION['id'])) {
        		// User is logged in -> Direct to user page
        		echo '<li><a class="nav-link" href="utilizador.php"><img src="http://localhost/pap-main/pap/static/images/user.png"></a></li>';
    		} else {
        		// User is NOT logged in -> Direct to login/register page
        		echo '<li><a class="nav-link" href="login.php"><img src="http://localhost/pap-main/pap/static/images/user.png"></a></li>';
    		}
    		?>
		</ul>
      </div>
    </div>
  </nav>

  <div class="login-container">
    <form action="contareg.php" method="post">
      <h2 class="login-heading">Registar</h2>
      <?php if (isset($_GET['error'])) { ?>
        <p class="error"><?php echo $_GET['error']; ?></p>
      <?php } ?>
      <div class="login-form-group">
        <label for="full_name" class="login-label">Nome completo:</label>
        <input type="text" class="login-input" id="full_name" name="name" placeholder="Nome completo" required>
      </div>
      <div class="login-form-group">
        <label for="usr_name" class="login-label">Username:</label>
        <input type="text" class="login-input" id="usr_name" name="uname" placeholder="Username" required>
      </div>
      <div class="login-form-group">
        <label for="pwd" class="login-label">Palavra-passe:</label>
        <input type="password" class="login-input" id="pwd" name="password" placeholder="Palavra-passe" required>
      </div>
      <div class="login-form-group">
        <label for="pwd_confirm" class="login-label">Confirmar Palavra-passe:</label>
        <input type="password" class="login-input" id="pwd_confirm" name="password_confirm" placeholder="Confirmar Palavra-passe" required>
      </div>
      <button type="submit" name="register" class="login-btn" style="width: 100%; padding: 12px; background-color: #4b4a8b; color: white; border: none; font-size: 16px; cursor: pointer; border-radius: 4px;">Regista</button>
    </form>
    <div class="login-register-link">
      <p>Já tem conta? <a href="login.php" class="login-register-text">Login</a></p>
    </div>
  </div>
</body>
</html>