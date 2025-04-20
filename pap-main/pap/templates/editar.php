<?php
session_start();

// Redireciona se o usuário não estiver logado
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}
?>

<!doctype html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Editar Perfil - Kiocode</title>
  <link rel="shortcut icon" href="favicon.png">
  <link href="../static/css/bootstrap.min.css" rel="stylesheet">
  <link href="../static/css/tiny-slider.css" rel="stylesheet">
  <link href="../static/css/perfil.css" rel="stylesheet">
  <link href="../static/css/style.css" rel="stylesheet">
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
  <style>
    .user-heading .overlay {
      position: absolute;
      top: 0;
      left: 50%;
      transform: translateX(-50%);
      width: 120px;
      height: 120px;
      background-color: rgba(0, 0, 0, 0.5);
      border-radius: 50%;
      opacity: 0;
      transition: opacity 0.3s;
      font-size: 14px;
    }
    .user-heading:hover .overlay {
      opacity: 1;
    }
  </style>
</head>

<body>
  <!-- Navbar mantida -->
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
          <li><a class="nav-link" href="index.php">Home</a></li>
          <li><a class="nav-link" href="sobre.php">Sobre nós</a></li>
          <li><a class="nav-link" href="aulas.php">Aulas</a></li>
          <li><a class="nav-link" href="contact.php">Contactos</a></li>
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

  <!-- Conteúdo da Página -->
  <div class="container mt-5">
    <?php if (isset($_SESSION['msg'])): ?>
      <div class="alert alert-info mt-2"><?php echo $_SESSION['msg']; unset($_SESSION['msg']); ?></div>
    <?php endif; ?>

    <div class="row profile-container">
      <div class="profile-nav col-md-3">
        <div class="panel">
          <div class="user-heading round position-relative text-center">
            <form action="foto_perfil.php" method="post" enctype="multipart/form-data" id="form-foto">
              <label for="foto-perfil" class="d-block position-relative" style="cursor:pointer;">
                <img src="<?php echo $_SESSION['foto_perfil'] ?? 'https://bootdey.com/img/Content/avatar/avatar3.png'; ?>" 
                     alt="Foto de Perfil" class="rounded-circle" width="120" height="120" style="object-fit:cover;">

                <div class="overlay text-white fw-bold d-flex justify-content-center align-items-center">
                  Mudar Foto
                </div>

                <input type="file" name="foto" id="foto-perfil" accept="image/*" style="display:none" onchange="document.getElementById('form-foto').submit();">
              </label>
            </form>
            <h1 class="mt-3"><?php echo $_SESSION['name']; ?></h1>
          </div>
          <ul class="nav nav-pills nav-stacked">
            <li><a href="utilizador.php"><i class="fa fa-user"></i> Voltar ao perfil</a></li>
          </ul>
        </div>
      </div>

      <div class="profile-info col-md-9">
      <div class="profile-info col-md-9">
  <div class="panel">
    <div class="bio-graph-heading">
      <h5><i class="fa fa-pencil"></i> Edição de Perfil</h5>

      <!-- MENSAGEM -->
      <?php if (isset($_SESSION['msg'])): ?>
        <div class="alert alert-<?php echo isset($_SESSION['msg_type']) ? $_SESSION['msg_type'] : 'info'; ?> mt-3">
          <?php 
            echo $_SESSION['msg']; 
            unset($_SESSION['msg'], $_SESSION['msg_type']);
          ?>
        </div>
      <?php endif; ?>
      <!-- FIM MENSAGEM -->

      <form action="atualizar_perfil.php" method="post" class="mt-4">
        <div class="mb-3">
          <label for="name" class="form-label">Nome:</label>
          <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($_SESSION['name']); ?>" required>
        </div>

        <div class="mb-3">
          <label for="password" class="form-label">Nova Senha:</label>
          <input type="password" class="form-control" id="password" name="password" placeholder="Deixe em branco para manter a atual">
        </div>

        <div class="mb-3">
          <label for="confirm_password" class="form-label">Confirmar Nova Senha:</label>
          <input type="password" class="form-control" id="confirm_password" name="confirm_password">
        </div>

        <button type="submit" class="btn btn-primary w-50">Salvar Alterações</button>
      </form>

    </div>
  </div>
</div>

      </div>
    </div>
  </div>

  <script src="js/bootstrap.bundle.min.js"></script>
  <script src="js/tiny-slider.js"></script>
  <script src="js/custom.js"></script>
</body>
</html>
