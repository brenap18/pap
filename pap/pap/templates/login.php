<!doctype html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- Logo do tab -->
  <link rel="shortcut icon" href="favicon.png">

  <meta name="description" content="Site dedicado ao ensino de C++" />
  <meta name="keywords" content="bootstrap, bootstrap4, C++, programação" />

  <!-- Bootstrap CSS -->
  <link href="../static/css/bootstrap.min.css" rel="stylesheet">
  <link href="../static/css/tiny-slider.css" rel="stylesheet">
  <link href="../static/css/style.css" rel="stylesheet">
  <link href="../static/css/contas.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
  <title>Login - Kiocode</title>
</head>

<body>

  <!-- Início da Navegação -->
  <nav class="custom-navbar navbar navbar-expand-md navbar-dark bg-dark" aria-label="Navegação do Kiocode">
    <div class="container">
      <div class="navbar-brand">
        <a href="index.html">
				<img src="http://localhost/pap/static/images/logo.png" alt="Logo" class="logo">
        </a>
      </div>

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsFurni" aria-controls="navbarsFurni" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarsFurni">
        <ul class="custom-navbar-nav navbar-nav ms-auto mb-2 mb-md-0">
          <li class="nav-item">
            <a class="nav-link" href="index.html">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="sobre.html">Sobre nós</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="aulas.html">Aulas</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="contact.html">Contactos</a>
          </li>
        </ul>

        <ul class="custom-navbar-cta navbar-nav mb-2 mb-md-0 ms-5">
				<li><a class="nav-link" href="login.php"><img src="http://localhost/pap/static/images/user.png"></a></li>
        </ul>
      </div>
    </div>
  </nav>
  <!-- Fim da Navegação -->

  <!-- Login Form -->
  <div class="login-container">
        <form action="contalog.php" method="post"> 
            <h2 class="login-heading">Login</h2>

            <!-- Error message handling (if any) -->
            <?php if (isset($_GET['error'])) { ?>
                <p class="error"><?php echo $_GET['error']; ?></p>
            <?php } ?>

            <div class="login-form-group">
                <label for="usr_name" class="login-label">Username:</label> <!-- Changed label text to 'User Name' -->
                <input type="text" class="login-input" id="usr_name" name="uname" placeholder="Username" required> <!-- Changed name to uname -->
            </div>
              
            <div class="login-form-group">
                <label for="pwd" class="login-label">Palavra-passe:</label>
                <input type="password" class="login-input" id="pwd" name="password" placeholder="Palavra-passe" required>
            </div>

            <button type="submit" name="login" class="login-btn" style="width: 100%; padding: 12px; background-color: #4b4a8b; color: white; border: none; font-size: 16px; cursor: pointer; border-radius: 4px;">Entrar</button>        </form>

        <div class="login-register-link">
            <p>Não tem conta? <a href="register.php" class="login-register-text">Registar</a></p>
        </div>
    </div>
</div>


  
</body>
</html>
