<?php
session_start();

// Redireciona se o usuário já estiver logado
if (isset($_SESSION['id'])) {
    header("Location: utilizador.php");
    exit();
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
  <title>Login - Kiocode</title>
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
      </div>
    </div>
  </nav>

  <div class="login-container">
    <form action="contalog.php" method="post"> 
      <h2 class="login-heading">Login</h2>
      <?php if (isset($_GET['error'])) { ?>
        <p class="error"><?php echo htmlspecialchars($_GET['error']); ?></p>
      <?php } ?>
      <div class="login-form-group">
        <label for="usr_name" class="login-label">Username:</label>
        <input type="text" class="login-input" id="usr_name" name="uname" placeholder="Username" required>
      </div>
      <div class="login-form-group">
        <label for="pwd" class="login-label">Palavra-passe:</label>
        <input type="password" class="login-input" id="pwd" name="password" placeholder="Palavra-passe" required>
      </div>
      <button type="submit" name="login" class="login-btn">Entrar</button>
    </form>
    <div class="login-register-link">
      <p>Não tem conta? <a href="register.php" class="login-register-text">Registar</a></p>
    </div>
  </div>
</body>
</html>
