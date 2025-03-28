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

  <!-- Link to Prism.js for syntax highlighting -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/themes/prism-tomorrow.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/themes/prism.css" rel="stylesheet">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/prism.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/components/prism-cpp.min.js"></script>

  <title>Aula 13 - Kiocode</title>
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
    <div class="aula-container">
      <div class="aula-content-wrapper">

        <!-- Sidebar Container -->
        <div id="sidebar-container"></div>

        <!-- Sidebar Toggle Button -->
        <button class="sidebar-toggle-btn">></button>

        <!-- Main Content -->
        <div class="aulas-main-content">
            <h2 class="aulas-section-title">Classes em C++</h2>
            <h3 class="aulas-section-h3">- O que são Classes?</h3>
            <p>
                Uma <strong>classe</strong> em C++ é um modelo que define atributos e comportamentos para criar objetos. Ela encapsula dados e funções relacionadas, permitindo organizar o código. Os atributos representam as características do objeto, enquanto os métodos definem suas ações.
            </p>
            <hr>
            

            <h4 class="aulas-section-h4">Declarar uma classe</h4>
            
            <p>Para declarar uma classe, usamos a palavra-chave `class`, seguida pelo nome da classe e um bloco de código que define seus atributos e métodos. A classe serve como um modelo para criar objetos, agrupando dados e comportamentos.</p>
           
            <div class="code-section">
                <h3>Declarar classe</h3>
                <pre><code class="language-c++">class Carro {
    public:
        std::string modelo; // Atributo para o modelo do carro
        int ano; // Atributo para o ano do carro
    
        // Construtor para inicializar os atributos
        Carro(std::string m, int a) : modelo(m), ano(a) {}
    };
                </code></pre>
            </div>

            <h4 class="aulas-section-h4">Criar objetos</h4>
            
            <p>Uma vez definida a classe, é possível criar objetos a partir dela. Um objeto é uma instância da classe e pode utilizar os seus atributos e métodos. Cada objeto criado tem os seus próprios dados, mas segue a estrutura definida pela classe.</p>
           
            <div class="code-section">
                <h3>Objetos</h3>
                <pre><code class="language-c++">
Carro meuCarro("Fusca", 1970); // Cria um objeto da classe Carro
                </code></pre>
            </div>


            <h4 class="aulas-section-h4">Acesso e Modificação de Atributos</h4>
            
            <p>Os atributos de um objeto podem ser acedidos e modificados diretamente, caso sejam públicos. 
                No entanto, é comum usar métodos específicos para manipular esses atributos para garantir um melhor controlo sobre os dados.</p>  
            <div class="code-section">
                <h3>aaaa</h3>
                <pre><code class="language-c++">std::cout << "Modelo: " << meuCarro.modelo << ", Ano: " << meuCarro.ano << std::endl; //Acede os atributos
meuCarro.ano = 2020; // Modifica o ano do carro                </code></pre>
            </div>

            <div class="aulas-buttons-container">
              <div class="container text-center">
                <a class="btn btn-secondary me-3" href="aula3.php">Anterior</a>
                <a class="btn btn-secondary" href="aula5.php">Próximo</a>
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
