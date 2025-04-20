<?php
session_start();

include 'track_progress.php'; // <- Esse é o que tava a faltar!

if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

$usuario_id = $_SESSION['id'];
$usuario_nome = $_SESSION['name'];
$aula_id = 4;

// Conexão com o banco
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test_db";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Inserir comentário
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['comentario'])) {
    $comentario = $_POST['comentario'];
    $sql = "INSERT INTO comentarios (usuario_id, comentario, data, aula_id) VALUES (?, ?, NOW(), ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isi", $usuario_id, $comentario, $aula_id);
    $stmt->execute();
    $stmt->close();
}

// Obter comentários da aula
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


  <title>Aula 5 - Kiocode</title>
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
  <!-- Fim da Navegação -->

  <!-- Main Content Section -->
<div class="aula-content-section">
    <div class="aula-container" style="margin-left: -40px;">
        <div class="aula-content-wrapper">

            <!-- Sidebar Container -->
            <div id="sidebar-container"></div>

            <!-- Sidebar Toggle Button -->
            <button class="sidebar-toggle-btn">></button>

            <!-- Main Content -->
            <div class="aulas-main-content">
                <h2 class="aulas-section-title">Tipos de dados</h2>
                <h3 class="aulas-section-h3">- O que são tipos de dados?</h3>
                <p>
                    Os tipos de dados em C++ definem a natureza dos dados que podem ser armazenados em variáveis. 
                    Eles determinam o tamanho, o intervalo e as operações que podem ser realizadas sobre esses dados.
                </p>
                <hr>

                <!-- Content Row para Dados Primitivos -->
                <div class="aulas-row my-5">
                    <div class="aulas-col-6 aulas-col-md-6">
                        <div class="aulas-feature">
                            <h4 class="aulas-section-h4">Dados Primitivos</h4>
                            <p>Os dados primitivos em C++ são tipos de dados básicos e pré-definidos pela linguagem, que representam valores simples. Estes tipos não são compostos e têm uma representação direta na memória.</p>
                            <ul>
                                <li><strong>int:</strong> Utilizado para armazenar números inteiros.</li>
                                <li><strong>float:</strong> Usado para números de ponto flutuante com precisão simples.</li>
                                <li><strong>double:</strong> Para números de ponto flutuante com precisão dupla.</li>
                                <li><strong>char:</strong> Representa um único caractere.</li>
                                <li><strong>bool:</strong> Armazena valores booleanos, verdadeiro ou falso.</li>
                            </ul>
                        </div>
                    </div>

                    <div class="code-section">
                        <h3>Dados Primitivos</h3>
                        <pre><code class="language-c++">
int idade = 25; // Armazena a idade como um número inteiro
float altura = 1.75; // Armazena a altura como um número de ponto flutuante
double peso = 70.5; // Armazena o peso com precisão dupla
char inicial = 'A'; // Armazena um único caractere
bool estudante = true; // Armazena um valor booleano (verdadeiro ou falso)
                        </code></pre>
                    </div>
                </div>

                <!-- Content Row para Dados Compostos -->
                <div class="aulas-row my-5">
                    <div class="aulas-col-6 aulas-col-md-6">
                        <div class="aulas-feature">
                            <h4 class="aulas-section-h4">Dados Compostos</h4>
                            <p>Os dados compostos em C++ são formados pela combinação de tipos primitivos e podem armazenar múltiplos valores. Eles permitem a criação de tipos de dados personalizados, facilitando a organização e manipulação de informações.</p>
                            <ul>
                                <li><strong>Arrays:</strong> Uma coleção de elementos do mesmo tipo.</li>
                                <li><strong>Structs:</strong> Agrupam diferentes tipos de dados sob um mesmo nome.</li>
                                <li><strong>Classes:</strong> Semelhantes às structs, mas com encapsulamento e herança.</li>
                                <li><strong>Unions:</strong> Permitem armazenar diferentes tipos de dados na mesma posição de memória.</li>
                                <li><strong>Enumerations (enum):</strong> Conjunto de constantes nomeadas.</li>
                            </ul>
                        </div>
                    </div>

                    <div class="code-section">
                        <h3>Dados Compostos</h3>
                        <pre><code class="language-c++">int numeros[5] = {1, 2, 3, 4, 5}; // Array 5 elementos
struct Pessoa {  
    std::string nome; // Nome da pessoa  
    int idade; // Idade da pessoa  
}; // Definição de uma struct para armazenar informações de uma pessoa  

class Carro {  
public:  
    std::string modelo; // Modelo do carro  
    int ano; // Ano do carro  
    void ligar() {}; // Método para ligar o carro  
}; // Definição de uma classe para representar um carro  

union Dados {  
    int inteiro; // Armazena um número inteiro  
    float flutuante; // Armazena um número de ponto flutuante  
    char caractere; // Armazena um único caractere  
}; // Definição de uma union para armazenar diferentes tipos de dados
enum DiaDaSemana {Domingo, Segunda, Terça, Quarta, Quinta, Sexta, Sábado};
                          </code></pre>
                    </div>
                    <div class="aulas-buttons-container">
                      <div class="container text-center">
                        <a class="btn btn-secondary me-3" href="aula3.php">Anterior</a>
                        <a class="btn btn-secondary" href="aula5.php">Próximo</a>
                      </div>
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
          <div class="mb-4 aulas-footer-logo-wrap"><a href="#" class="aulas-footer-logo">Kiocode</a></div>
          <div class="row">
            <div class="col-lg-8">
              <div class="aulas-subscription-form">
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
            <p class="mb-2 text-center text-lg-start aulas-copyright-text" style="margin-left: auto; margin-right: auto;">Copyright &copy;<script>document.write(new Date().getFullYear());</script>. All Rights Reserved.</p>
          </div>
  
          <div class="col-lg-6 text-center text-lg-end" style="text-align: right; padding-right: 30px;">
            <ul class="list-unstyled d-inline-flex ms-auto aulas-terms">
              <li class="me-4"><a href="#" class="aulas-terms-link">Terms &amp; Conditions</a></li>
              <li><a href="#" class="aulas-privacy-link">Privacy Policy</a></li>
            </ul>	
          </div>
        </div>
      </div>
    </div>
  </footer>


  <script>
    // Load the sidebar dynamically
    document.addEventListener("DOMContentLoaded", function() {
      fetch('sidebar.php')
        .then(response => response.text())
        .then(data => {
          document.getElementById('sidebar-container').innerHTML = data;
  
          // Re-attach event listeners for submenu toggles after loading the sidebar
          document.querySelectorAll('.submenu-toggle').forEach(toggleButton => {
            toggleButton.addEventListener('click', function () {
              const submenu = toggleButton.nextElementSibling;  // The next sibling is the submenu
              submenu.classList.toggle('show');  // Toggle the visibility by adding/removing the 'show' class
              toggleButton.classList.toggle('open');  // Optionally change the icon of the button
            });
          });
  
          // Attach the sidebar toggle button event listener after loading the sidebar
          const toggleBtn = document.querySelector('.sidebar-toggle-btn');
          const sidebar = document.querySelector('.aula-sidebar');
  
          if (toggleBtn) {
            toggleBtn.addEventListener('click', function() {
                sidebar.classList.toggle('show'); // Toggle the 'show' class to slide the sidebar in/out
            });
          }
        })
        .catch(error => console.error('Error fetching sidebar:', error));
    });
  </script>

  <script src="js/bootstrap.bundle.min.js"></script>
  <script src="js/tiny-slider.js"></script>
  <script src="js/custom.js"></script>

</body>
</html>
