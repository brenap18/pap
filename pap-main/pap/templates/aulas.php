<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
} 

// Lista de aulas para referência no progresso
$aulas = [
    'aula1.php', 'aula2.php', 'aula3.php', 'aula4.php', 'aula5.php', 
    'aula6.php', 'aula7.php', 'aula8.php', 'aula9.php', 'aula10.php', 
    'aula11.php', 'aula12.php', 'aula13.php', 'aula14.php'
];

if (!isset($_SESSION['historico_aulas'])) {
    $_SESSION['historico_aulas'] = [];
}

// Registrar a aula visitada
$pagina_atual = basename($_SERVER['PHP_SELF']);
if (in_array($pagina_atual, $aulas) && !in_array($pagina_atual, $_SESSION['historico_aulas'])) {
    $_SESSION['historico_aulas'][] = $pagina_atual;
}


// Conexão com o banco de dados
$servername = "localhost";
$username = "root"; // Substitua com seu nome de usuário
$password = ""; // Substitua com sua senha
$dbname = "test_db"; // Substitua com o nome do seu banco de dados

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Função para obter os comentários
function getComentarios($conn, $aula_id) {
    $sql = "SELECT comentario, data, usuario_id FROM comentarios WHERE aula_id = ? ORDER BY data DESC";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $aula_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $comentarios = [];
    
    while ($row = $result->fetch_assoc()) {
        $comentarios[] = $row;
    }
    
    $stmt->close();
    return $comentarios;
}

// Processar o envio de um novo comentário
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['comentario'])) {
    $comentario = $_POST['comentario'];
    $aula_id = 1; // Defina o ID da aula (pode ser dinâmico, dependendo da página)
    $usuario_id = $_SESSION['id']; // ID do usuário logado
    
    // Insere o comentário no banco de dados
    $sql = "INSERT INTO comentarios (comentario, aula_id, usuario_id, data) VALUES (?, ?, ?, NOW())";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sii", $comentario, $aula_id, $usuario_id);
    $stmt->execute();
    $stmt->close();
    
    // Redireciona para a página atual para exibir o comentário recém-adicionado
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

// Obtém os comentários para a aula atual
$comentarios = getComentarios($conn, 1); // 1 representa o ID da aula
?>
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
  <link href="../static/css/aulas.css" rel="stylesheet">
  <link href="../static/css/comentario.css" rel="stylesheet">


  <!-- Prism.js para syntax highlighting -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/themes/prism-tomorrow.min.css" rel="stylesheet">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/prism.min.js"></script>

  <title>Aula 1 - Kiocode</title>
</head>

<body>

  <!-- Navbar -->
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
          <?php if (isset($_SESSION['id'])): ?>
            <li><a class="nav-link" href="utilizador.php"><img src="http://localhost/pap-main/pap/static/images/user.png"></a></li>
          <?php else: ?>
            <li><a class="nav-link" href="login.php"><img src="http://localhost/pap-main/pap/static/images/user.png"></a></li>
          <?php endif; ?>
        </ul>
      </div>
    </div>
  </nav>


  <!-- Conteúdo Principal -->
  <div class="aula-content-section">
    <div class="aula-container" style="margin-left: -40px;">
      <div class="aula-content-wrapper">

        <!-- Sidebar -->
        <div id="sidebar-container"></div>

        <!-- Botão toggle -->
        <button class="sidebar-toggle-btn">></button>

        <!-- Conteúdo da aula -->
        <div class="aulas-main-content">
          <h2 class="aulas-section-title">O que é C++?</h2>
          <p>
            C++ é uma linguagem de programação multiplataforma que pode ser utilizada para criar aplicações de alto desempenho.
            Foi desenvolvida por Bjarne Stroustrup como uma extensão da linguagem C.
            C++ oferece aos programadores um alto nível de controlo sobre os recursos do sistema e a memória.
            A linguagem passou por 5 atualizações principais: C++11, C++14, C++17, C++20 e C++23.
          </p>

          <div class="aulas-row my-5">
            <div class="aulas-col-6 aulas-col-md-6">
              <div class="aulas-feature">
                <h2 class="aulas-section-title">Porque Usar C++</h2>
                <p>
                  C++ é uma das linguagens mais populares do mundo. É usada em sistemas operativos, GUIs e sistemas embutidos.
                  Oferece orientação a objetos, reutilização de código, e é portátil. Além disso, tem semelhanças com C, C# e Java.
                </p>
              </div>
            </div>
          </div>

          <!-- Botões -->
          <div class="aulas-buttons-container">
            <div class="container text-center">
              <a class="btn btn-secondary me-3" href="index.php">Sair</a>
              <a class="btn btn-secondary" href="aula1.php">Próximo</a>
            </div>
          </div>

        </div> <!-- fim aulas-main-content -->
      </div>
    </div>
  </div>
  

  <!-- Footer -->
  <footer class="footer-section aulas">
    <div class="container relative aulas">
      <div class="row g-5 mb-5">
        <div class="col-lg-4">
          <div class="mb-4 aulas-footer-logo-wrap"><a href="#" class="aulas-footer-logo">Kiocode</a></div>
          <div class="row">
            <div class="col-lg-8">
              <div class="aulas-subscription-form">
                <h3 class="d-flex align-items-center">
                  <span class="me-1"><img src="http://localhost/pap-main/pap/static/images/envelope-outline.svg" alt="Email" class="img-fluid"></span>
                  <span>Contacte-nos</span>
                </h3>
                <p class="aulas-footer-email">kiocodecplusplus@gmail.com</p>
                <p><a href="contact.php" class="btn btn-primary aulas-btn">Contacte-nos</a></p>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="border-top aulas-copyright">
        <div class="row pt-4">
          <div class="col-lg-6">
            <p class="mb-2 text-center text-lg-start">Copyright &copy;
              <script>document.write(new Date().getFullYear());</script>. All Rights Reserved.
            </p>
          </div>
          <div class="col-lg-6 text-center text-lg-end">
            <ul class="list-unstyled d-inline-flex ms-auto aulas-terms">
              <li class="me-4"><a href="#" class="aulas-terms-link">Terms & Conditions</a></li>
              <li><a href="#" class="aulas-privacy-link">Privacy Policy</a></li>
            </ul>	
          </div>
        </div>
      </div>
    </div>
  </footer>

  <!-- Scripts -->
  <script>
    document.addEventListener("DOMContentLoaded", function() {
      fetch('sidebar.php')
        .then(response => response.text())
        .then(data => {
          document.getElementById('sidebar-container').innerHTML = data;

          document.querySelectorAll('.submenu-toggle').forEach(toggleButton => {
            toggleButton.addEventListener('click', function () {
              const submenu = toggleButton.nextElementSibling;  // The next sibling is the submenu
              submenu.classList.toggle('show');  // Toggle the visibility by adding/removing the 'show' class
              toggleButton.classList.toggle('open');  // Optionally change the icon of the button
            });
          });
        });

      // Toggle lateral sidebar
      const toggleBtn = document.querySelector(".sidebar-toggle-btn");
      const sidebar = document.querySelector("#sidebar-container");

      toggleBtn.addEventListener("click", function() {
        sidebar.classList.toggle("sidebar-hidden");
        toggleBtn.textContent = sidebar.classList.contains("sidebar-hidden") ? ">" : "<";
      });
    });
  </script>

  <script src="../static/js/bootstrap.bundle.min.js"></script>
  <script src="../static/js/tiny-slider.js"></script>
  <script src="../static/js/custom.js"></script>
</body>
</html>
