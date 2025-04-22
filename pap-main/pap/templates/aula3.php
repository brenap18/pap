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
$aula_id = 3;

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
  <link href="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/themes/prism.css" rel="stylesheet">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/prism.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/components/prism-cpp.min.js"></script>

  <title>Aula 4 - Kiocode</title>
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
          <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
          <li class="nav-item"><a class="nav-link" href="sobre.php">Sobre nós</a></li>
          <li class="nav-item"><a class="nav-link" href="aulas.php">Aulas</a></li>
          <li class="nav-item"><a class="nav-link" href="contact.php">Contactos</a></li>
        </ul>
        <ul class="custom-navbar-cta navbar-nav mb-2 mb-md-0 ms-5">
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
          <h2 class="aulas-section-title">Sintaxe Básica</h2>
          <p>
            A sintaxe básica de C++ refere-se ao conjunto de regras e estruturas que definem como o código deve ser escrito para ser entendido corretamente pelo compilador.
          </p>
          <hr>

          <!-- Content Row -->
          <div class="aulas-row my-5">
            <div class="aulas-col-6 aulas-col-md-6">
              <div class="aulas-feature">
                <h2 class="aulas-section-title">Estrutura de um Programa C++</h2>
                <p>
                  Todos os programas em C++ têm uma estrutura base composta por algumas partes principais:
                </p>
                <ul>
                  <li><b>Inclusão de Bibliotecas:</b> Normalmente, começa-se o código incluindo bibliotecas que fornecem funcionalidades adicionais que a linguagem não oferece por padrão. A inclusão é feita com o comando #include.</li>
                  <li><b>Função main():</b> Todo programa em C++ começa a execução a partir da função main(), que é o ponto de entrada do programa. Esta função pode devolver um valor inteiro (normalmente 0), que indica que o programa terminou com sucesso.</li>
                  <li><b>Código dentro da função main():</b> O código que será executado pelo programa é escrito dentro das chaves { } da função main().</li>
                </ul>

                <h4 class="aulas-section-h4">Exemplo do código "Hello World"</h4>
                <div class="code-section">
                  <h3>Hello World:</h3>
                  <pre><code class="language-c++">
  #include &lt;iostream&gt;
  
  int main() {
      std::cout << "Hello, World!" << std::endl;
      return 0;
  }
                  </code></pre>
                </div>

                <ul>
                  <li><b>#include &lt;iostream&gt;:</b> Inclui a biblioteca de entrada e saída padrão do C++ para permitir o uso de std::cout, que é usado para imprimir na tela.</li>
                  <li><b>int main():</b> Define a função principal que será executada quando o programa iniciar.</li>
                  <li><b>std::cout << "Hello, World!" << std::endl;:</b> Imprime a string "Olá, Mundo!" seguida por uma nova linha (std::endl).</li>
                  <li><b>return 0;:</b> Finaliza a execução da função main() e retorna 0, indicando sucesso.</li>
                </ul>

                <hr>

                <h4 class="aulas-section-h4">Instruções e Ponto e Vírgula</h4>
                <p>
                  Em C++, cada comando ou instrução deve terminar com um ponto e vírgula (;). Isso é necessário para indicar ao compilador que a instrução terminou, mesmo que o comando seja simples ou complexo.
                </p>
                <div class="code-section">
                  <h3>Uso de ponto e vírgula</h3>
                  <pre><code class="language-c++">
  int a = 5;  // Declara e inicializa a variável a com valor 5 
  a = a + 2;   // Atribui o valor de a + 2 à variável a
  std::cout << "Valor de a: " << a << std::endl;  // Imprime o valor de a na tela
                  </code></pre>
                </div>

                <p>Aqui, cada linha termina com um ponto e vírgula para indicar que a instrução foi concluída.</p>

                <hr>
                <h4 class="aulas-section-h4">Blocos de código</h4>
                <p>Blocos de código em C++ são usados para agrupar instruções, especialmente em estruturas de controle como loops e condicionais. 
                Eles são delimitados por chaves { }.</p>
                <ul>
                    <li><b>Condicionais:</b> Utilizadas para executar trechos de código com base em uma condição</li>
                    <li><b>Loops:</b> Usados para repetir um bloco de código várias vezes</li>
                </ul>

                <div class="code-section">
                    <h3>Bloco de código com <u>if</u></h3>
                    <pre><code class="language-c++">
int x = 10;

if (x > 0) {
    std::cout << "X é positivo!" << std::endl;  // será executado se x for maior que 0
} else {
    std::cout << "X não é positivo!" << std::endl;  // se não, este código é executado
}
                    </code></pre>
                </div>
                <ul>
                  <li><b>if (x > 0):</b> Verifica se o valor de x é maior que zero.</li>
                  <li><b>else:</b> Caso a condição do if não seja satisfeita, o código dentro do bloco else será executado.</li>
                </ul>

                <div class="code-section">
                  <h3>Bloco de código com <u>for</u></h3>
                  <pre><code class="language-c++">
for (int i = 0; i < 5; i++) {
    std::cout << "Valor de i: " << i << std::endl;  // Imprime os valores de i de 0 a 4
}
                  </code></pre>
                </div>
                <p>O laço <u>'for'</u> vai executar o código dentro das chaves { } 5 vezes, começando com <u>i</u> igual a 0, até <u>i</u> ser igual a 4. 
                A cada ciclo, o valor de i é incrementado em 1.</p>

                <hr>
                <h4 class="aulas-section-h4">Comentários</h4>
                <p>Comentários são usados para explicar o código e não afetam a execução do programa. 
                    Eles são importantes para tornar o código mais legível e fácil de entender. Existem dois tipos principais de comentários:</p>
                <ul>
                    <li><b>Comentário de linha única:</b> Usa // para comentar uma linha inteira. Tudo o que vem depois de // na mesma linha será ignorado pelo compilador.</li>
                    <li><b>Comentário de várias linhas:</b> Usa /* para iniciar e */ para terminar o comentário, permitindo que o comentário ocupe várias linhas.</li>
                </ul>

                <div class="code-section">
                    <h3>Comentário com <u>//</u></h3>
                    <pre><code class="language-c++">
// Este é um comentário de linha única
int x = 10;  // A variável x recebe o valor 10
                    </code></pre>
                </div>

                <div class="code-section">
                    <h3>Comentário com <u>/* */</u></h3>
                    <pre><code class="language-c++">
/*
Este é um comentário
de várias linhas.
Ele pode ocupar várias linhas sem afetar o código.
*/
int y = 20;
                    </code></pre>
                </div>
                <div class="aulas-buttons-container">
                  <div class="container text-center">
                    <a class="btn btn-secondary me-3" href="aula2.php">Anterior</a>
                    <a class="btn btn-secondary" href="aula4.php">Próximo</a>
                  </div>
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
    // espera o conteúdo carregar
document.addEventListener("DOMContentLoaded", function() {

  // carrega o sidebar dinamicamente
  fetch('sidebar.php')
    .then(response => response.text())
    .then(data => {
      document.getElementById('sidebar-container').innerHTML = data;

      // ativa os botões de submenu depois do sidebar ser carregado
      document.querySelectorAll('.submenu-toggle').forEach(toggleButton => {
        toggleButton.addEventListener('click', function () {
          const submenu = toggleButton.nextElementSibling;
          submenu.classList.toggle('show'); // mostra/esconde submenu
          toggleButton.classList.toggle('open'); // muda o ícone do botão
        });
      });

      // ativa o botão para mostrar/esconder o sidebar
      const toggleBtn = document.querySelector('.sidebar-toggle-btn');
      const sidebar = document.querySelector('.aula-sidebar');

      if (toggleBtn) {
        toggleBtn.addEventListener('click', function() {
            sidebar.classList.toggle('show');
        });
      }
    })
    .catch(error => console.error('Erro ao carregar o sidebar:', error));
});

  </script>

  <script src="js/bootstrap.bundle.min.js"></script>
  <script src="js/tiny-slider.js"></script>
  <script src="js/custom.js"></script>

</body>
</html>
