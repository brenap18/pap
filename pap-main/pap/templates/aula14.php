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


  <!-- Link to Prism.js for syntax highlighting -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/themes/prism-tomorrow.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/themes/prism.css" rel="stylesheet">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/prism.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/components/prism-cpp.min.js"></script>

  <title>Aula 12 - Kiocode</title>
</head>

<body>

  <!-- Início da Navegação -->
  <nav class="custom-navbar navbar navbar-expand-md navbar-dark bg-dark" aria-label="Navegação do Kiocode">
    <div class="container">
      <div class="navbar-brand">
        <a href="index.php">
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="http://localhost/pap-main/pap/static/images/logo.png" alt="Logo" class="logo">
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
            <h2 class="aulas-section-title">Structs em C++</h2>
            <h3 class="aulas-section-h3">- O que é uma Struct?</h3>
            <p>
                Uma <strong>struct</strong> (ou estrutura) é uma forma de agrupar diferentes tipos de dados sob um mesmo nome. 
                Isso permite que você crie um novo tipo de dado que pode conter variáveis de diferentes tipos, facilitando a organização e o gerenciamento de dados relacionados.
            </p>

            <p>As structs são especialmente úteis quando o utilizador deseja representar um objeto que possui várias propriedades.</p>
            <hr>
        
            <h2 class="aulas-section-title">Como definir uma struct</h2>
            <p>Para definir uma struct, utiliza-se a palavra-chave struct, seguida pelo nome da estrutura e um bloco de chaves que contém as variáveis 
                (ou membros) que você deseja agrupar.</p>
            
            <div class="code-section">
                <h3>Definição de uma struct</h3>
                <pre><code class="language-c++">#include &#60;iostream&#62;

// Definindo uma estrutura chamada Ponto
struct Ponto {
    int x; // Coordenada x
    int y; // Coordenada y
};

int main() {
    // Criando uma instância da estrutura Ponto
    Ponto p1;

    // Atribuindo valores às coordenadas
    p1.x = 10;
    p1.y = 20;

    // Exibindo as coordenadas do ponto
    std::cout << "Coordenadas do ponto: (" << p1.x << ", " << p1.y << ")" << std::endl;

    return 0;
}
                </code></pre>
            </div>

            <ul>
                <li>Definição da Struct: A estrutura Ponto é definida com dois membros: x e y, ambos do tipo int, que representam as coordenadas de um ponto no plano.</li>
                <li>Instância da Struct: No main, criamos uma instância da estrutura Ponto chamada p1.</li>
                <li>Atribuição de Valores: Atribuímos valores às coordenadas x e y do ponto p1.</li>
                <li>Exibição dos Dados: Usamos std::cout para exibir as coordenadas do ponto na tela.</li>
            </ul>
        

            <div class="aulas-buttons-container">
                <div class="container text-center">
                  <a class="btn btn-secondary me-3" href="aula3.php">Anterior</a>
                  <a class="btn btn-secondary" href="index.php">Terminar</a>
                </div>
              </div>
            
    </div>
    

  <!-- Footer Section -->
  <footer class="footer-section aulas"> <!-- Added 'aulas' class here -->
    <div class="container relative aulas"> <!-- Added 'aulas' class here -->
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
          <div class="col-lg-6">
            <p class="mb-2 text-center text-lg-start aulas-copyright-text">Copyright &copy;<script>document.write(new Date().getFullYear());</script>. All Rights Reserved.</p>
          </div>
  
          <div class="col-lg-6 text-center text-lg-end">
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
