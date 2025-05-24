<?php
session_start();

include 'track_progress.php'; // controla o progresso do utilizador

// redireciona se não estiver logado
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

$usuario_id = $_SESSION['id'];
$usuario_nome = $_SESSION['name'];
$aula_id = 7;

// ligação à base de dados
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test_db";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// inserir novo comentário
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['comentario'])) {
    $comentario = $_POST['comentario'];
    $sql = "INSERT INTO comentarios (usuario_id, comentario, data, aula_id) VALUES (?, ?, NOW(), ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isi", $usuario_id, $comentario, $aula_id);
    $stmt->execute();
    $stmt->close();
}

// buscar comentários desta aula
function getComentarios($conn, $aula_id) {
    $sql = "SELECT c.comentario, c.data, u.name FROM comentarios c JOIN users u ON c.usuario_id = u.id WHERE c.aula_id = ? ORDER BY c.data DESC";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $aula_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $comentarios = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
    return $comentarios;
}

$comentarios = getComentarios($conn, $aula_id);
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


  <!-- Link to Prism.js for syntax highlighting -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/themes/prism-tomorrow.min.css" rel="stylesheet">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/prism.min.js"></script>


  <title>Aula 7 - Kiocode</title>
</head>

<body>

  <!-- Início da Navegação -->
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
          <li class="nav-item">
            <a class="nav-link" href="index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="sobre.php">Sobre nós</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="aulas.php">Aulas</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="contact.php">Contactos</a>
          </li>
        </ul>

        <ul class="custom-navbar-cta navbar-nav mb-2 mb-md-0 ms-5">
    		<?php
    		if (isset($_SESSION['id'])) {
        		// User is logged in -> Direct to user page
        		echo '<li style="max-width: 80%;"><a class="nav-link" href="utilizador.php"><img src="http://localhost/pap-main/pap/static/images/user.png"></a></li>';
    		} else {
        		// User is NOT logged in -> Direct to login/register page
        		echo '<li style="max-width: 80%;"><a class="nav-link" href="login.php"><img src="http://localhost/pap-main/pap/static/images/user.png"></a></li>';
    		}
    		?>
		</ul>
      </div>
    </div>
  </nav>
  <!-- Fim da Navegação -->

  <!-- Main Content Section -->
<div class="aula-content-section">
  <div class="aula-container" style="margin-left: -40px;">
    <div class="aula-content-wrapper">

      <div id="sidebar-container"></div>

      <div class="aulas-main-content">
        <div class="toc-container">
          <ul style="list-style: none; padding: 0; font-size: 14px;">
            <li style="margin-bottom: 8px;"><a href="#if">Estrutura if</a></li>
            <li style="margin-bottom: 8px;"><a href="#ifelse">Estrutura if...else</a></li>
            <li style="margin-bottom: 8px;"><a href="#switch">Estrutura switch</a></li>
          </ul>
        </div>

        <h2 class="aulas-section-title">Estruturas Condicionais em C++</h2>

        <h3 id="if" class="aulas-section-h3">- Estrutura if</h3>
        <p style="max-width: 80%;">
          A estrutura <code>if</code> permite que o programa tome decisões simples, executando um bloco de código somente se uma determinada condição for verdadeira. A condição é uma expressão que resulta em verdadeiro (true) ou falso (false).
        </p>
        <p style="max-width: 80%;">
          Se a condição dentro do <code>if</code> for verdadeira, o bloco entre chaves será executado; caso contrário, o programa continuará para a próxima instrução sem executar esse bloco.
        </p>
        <hr>
        <div class="code-section">
          <pre><code class="language-c++">
int idade = 18;
if (idade >= 18) {
    std::cout << "Você é maior de idade." << std::endl;
}
          </code></pre>
        </div>

        <h3 id="ifelse" class="aulas-section-h3">- Estrutura if...else</h3>
        <p style="max-width: 80%;">
          A estrutura <code>if...else</code> expande a decisão para dois caminhos possíveis: um bloco de código será executado se a condição for verdadeira, e outro bloco será executado caso a condição seja falsa.
        </p>
        <p style="max-width: 80%;">
          Isso é útil quando queremos que o programa escolha entre duas opções mutuamente exclusivas.
        </p>
        <hr>
        <div class="code-section">
          <pre><code class="language-c++">
int idade = 16;
if (idade >= 18) {
    std::cout << "Você é maior de idade." << std::endl;
} else {
    std::cout << "Você é menor de idade." << std::endl;
}
          </code></pre>
        </div>

        <h3 id="switch" class="aulas-section-h3">- Estrutura switch</h3>
        <p style="max-width: 80%;">
          A estrutura <code>switch</code> é usada para selecionar uma entre várias opções possíveis com base no valor de uma variável inteira ou caractere. Ela funciona como uma sequência de testes para diferentes valores fixos.
        </p>
        <p style="max-width: 80%;">
          Cada <code>case</code> representa um valor possível da variável, e o bloco de código correspondente será executado caso o valor da variável combine com o <code>case</code>. Se nenhum dos valores corresponder, o bloco <code>default</code> é executado, se estiver presente.
        </p>
        <p style="max-width: 80%;">
          O uso da palavra-chave <code>break</code> serve para interromper a execução do <code>switch</code> após executar o bloco de um caso, evitando que o programa execute os casos seguintes de forma contínua.
        </p>
        <hr>
        <div class="code-section">
          <pre><code class="language-c++">
char opcao = 'a';
switch (opcao) {
    case 'a':
        std::cout << "Opção A selecionada." << std::endl;
        break;
    case 'b':
        std::cout << "Opção B selecionada." << std::endl;
        break;
    default:
        std::cout << "Opção inválida." << std::endl;
}
          </code></pre>
        </div>

        <div class="aulas-buttons-container">
          <div class="container text-center">
            <a class="btn btn-secondary me-3" href="aula6.php">Anterior</a>
            <a class="btn btn-secondary" href="aula8.php">Próximo</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<!-- Comentários -->
<div class="comentarios-section">
    <h3>Comentários</h3>
    <form action="" method="POST">
        <div class="form-group">
            <textarea name="comentario" class="form-control" rows="4" placeholder="Escreva um comentário..." required></textarea>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Enviar</button>
    </form>

    <!-- Exibir os comentários -->
    <div class="comentarios-list">
        <?php foreach ($comentarios as $comentario): ?>
            <div class="comentario" style="background-color: #fff; padding: 15px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); margin-bottom: 20px;">
                <div style="display: flex; align-items: center; margin-bottom: 10px;">
                    <a href="#">
                        <!-- Verifica se o usuário tem uma foto de perfil atualizada -->
                        <img src="<?php echo isset($_SESSION['foto_perfil']) ? $_SESSION['foto_perfil'] : 'https://bootdey.com/img/Content/avatar/avatar3.png'; ?>" 
                             alt="Foto de Perfil" style="width: 30px; height: 30px; border-radius: 50%; object-fit: cover; margin-right: 10px;">
                    </a>
                    <h1 style="color: black; font-size: 14px;"><?= $_SESSION['name']; ?></h1>
                </div>
                <p style="font-size: 16px; color: #333;"><?= htmlspecialchars($comentario['comentario']) ?></p>
                <small style="display: block; font-size: 12px; color: #777; margin-top: 10px;">Publicado em: <?= $comentario['data'] ?></small>
            </div>
        <?php endforeach; ?>
    </div>
</div>
  <!-- Footer Section -->
  <footer class="footer-section aulas">
    <div class="container relative aulas">
      <div class="row g-5 mb-5">
        <div class="col-lg-4">
          <div class="row">
            <div class="col-lg-8">
                                            <div class="aulas-subscription-form" style="margin-left: -110px;">

                <h3 class="d-flex align-items-center">
                  <span class="me-1"><img src="http://localhost/pap-main/pap/static/images//envelope-outline.svg" alt="Image" class="img-fluid"></span>
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
          <div class="col-lg-6" style="text-align: left; padding-left: 60px; padding-top: 30px;">
    <p class="mb-2 text-center text-lg-start aulas-copyright-text" style="margin-left: auto; margin-right: auto; color: white !important;">
        Copyright &copy;<script>document.write(new Date().getFullYear());</script>. All Rights Reserved.
    </p>
</div>
  
          <div class="col-lg-6 text-center text-lg-end" style="text-align: right; padding-right: 30px;">
            <ul class="list-unstyled d-inline-flex ms-auto aulas-terms">
              <li class="me-4"><a href="#" class="aulas-terms-link">Terms &amp; Conditions</a></li>
              <li style="max-width: 80%;"><a href="#" class="aulas-privacy-link">Privacy Policy</a></li>
            </ul>	
          </div>
        </div>
      </div>
    </div>
  </footer>


  <script>
  // Espera o conteúdo carregar
  document.addEventListener("DOMContentLoaded", function () {

    // Carrega o sidebar dinamicamente
    fetch('sidebar.php')
      .then(response => response.text())
      .then(data => {
        document.getElementById('sidebar-container').innerHTML = data;

        // Ativa os botões de submenu depois do sidebar ser carregado
        document.querySelectorAll('.submenu-toggle').forEach(toggleButton => {
          toggleButton.addEventListener('click', function () {
            const submenu = toggleButton.nextElementSibling;
            submenu.classList.toggle('show'); // mostra/esconde submenu
            toggleButton.classList.toggle('open'); // muda o ícone do botão
          });
        });

        // Ativa o botão para mostrar/esconder o sidebar
        const toggleBtn = document.querySelector('.sidebar-toggle-btn');
        const sidebar = document.querySelector('.aula-sidebar');

        if (toggleBtn) {
          toggleBtn.addEventListener('click', function () {
            sidebar.classList.toggle('show');
          });
        }
      })
      .catch(error => console.error('Erro ao carregar o sidebar:', error));

    // Scroll suave para os links da Tabela de Conteúdo
    document.querySelectorAll('.toc-container a').forEach(anchor => {
      anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
          target.scrollIntoView({ behavior: 'smooth' });
        }
      });
    });

  });
</script>

  <script src="js/bootstrap.bundle.min.js"></script>
  <script src="js/tiny-slider.js"></script>
  <script src="js/custom.js"></script>

</body>
</html>


