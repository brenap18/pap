<?php
session_start();

// Verifica se o usuário está logado e redireciona se não estiver, exceto na página de registro
if (!isset($_SESSION['id']) && basename($_SERVER['PHP_SELF']) !== 'register.php') {
    header("Location: login.php");
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
    
    <!-- Bootstrap CSS -->
    <link href="../static/css/bootstrap.min.css" rel="stylesheet">
    <link href="../static/css/tiny-slider.css" rel="stylesheet">
    <link href="../static/css/style.css" rel="stylesheet">
    
    <!-- Bootstrap JS & Popper -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
    
    <title>Home - Kiocode</title>
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
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsFurni"
                    aria-controls="navbarsFurni" aria-expanded="false" aria-label="Toggle navigation">
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

    <!-- Início da Seção Hero -->
    <div class="hero">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-lg-5">
                    <div class="intro-excerpt">
                        <h1>Bem-vindo ao <span class="d-block">Kiocode</span></h1>
<div style="max-width: 100%; padding-right: 20px;">
    <p class="mb-4" style="font-size:20px; width: 140%; margin-right: 20px;">
        O Kiocode é um site dedicado ao ensino de C++. Aqui você encontrará uma abordagem prática e direta para aprender a programar. Nossas aulas são projetadas para te ajudar a entender os conceitos fundamentais e aplicá-los na prática.
    </p>
</div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Fim da Seção Hero -->

    <!-- Início da Seção de Razões -->
    <div class="answer-section">
        <div class="container">
            <div class="col-12 text-center mb-5">

    <h2 class="section-title" style="font-size: 35px;">Porquê escolher o Kiocode?</h2>

            </div>

            <div class="row">
                <div class="col-12 col-md-4 col-lg-3 mb-5 mb-md-0">
                    <a class="answer-one">
                        <img src="http://localhost/pap-main/pap/static/images/gratis.png" class="img-fluid answer-thumbnail" alt="Grátis">
                        <h3 class="answer-title" style="color: black; font-size: 25px;">Grátis</h3>
                        <span class="answer-why" style="font-size: 15px; margin-top: 20px;">Disponibilizamos conteúdos de C++ de forma gratuita, podendo aprender sem preocupações com mensalidades ou custos.</span>
                    </a>
                </div>
                                
                <div class="col-12 col-md-4 col-lg-3 mb-5 mb-md-0">
                    <a class="answer-one">
                        <img src="http://localhost/pap-main/pap/static/images/suporte.png" class="img-fluid answer-thumbnail" alt="Suporte Exclusivo">
                        <h3 class="answer-title" style="color: black; font-size: 25px;">Suporte Exclusivo</h3>
                        <span class="answer-why" style="font-size: 15px; margin-top: 20px;">Os exemplos de código vêm acompanhados de comentários de outros alunos para ajudar com as tuas dúvidas.</span>
                    </a>
                </div>
                                
                <div class="col-12 col-md-4 col-lg-3 mb-5 mb-md-0">
                    <a class="answer-one">
                        <img src="http://localhost/pap-main/pap/static/images/foco.png" class="img-fluid answer-thumbnail" alt="Foco no Prático">
                        <h3 class="answer-title" style="color: black; font-size: 25px;">Foco no Prático</h3>
                        <span class="answer-why" style="font-size: 15px; margin-top: 20px;">O conteúdo é apresentado de forma clara e simples, sem complicações desnecessárias.</span>
                    </a>
                </div>
                                
                <div class="col-12 col-md-4 col-lg-3 mb-5 mb-md-0">
                    <a class="answer-one">
                        <img src="http://localhost/pap-main/pap/static/images/plataformas.png" class="img-fluid answer-thumbnail" alt="Fácil de Aceder">
                        <h3 class="answer-title" style="color: black; font-size: 25px;">Fácil de Aceder</h3>
                        <span class="answer-why" style="font-size: 15px; margin-top: 20px;">A plataforma é fácil de aceder rapidamente ao conteúdo de que precisas em qualquer plataforma.</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- Fim da Seção de Razões -->

    <!-- Início da Seção "Ajudamos Você" -->
    <div class="we-help-section">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-lg-7 mb-5 mb-lg-0">
                    <div class="imgs-grid">
                        <div class="grid grid-1">
                            <img src="http://localhost/pap-main/pap/static/images/file.jpg" alt="Imagem 1" class="img-fluid">
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 ps-lg-5">
                    <h2 class="section-title mb-4" style="font-size: 50px;">Onde começar?</h2>
                    <p style="font-size: 25px; margin-top: 50px">Para começar a aprendizagem:</p>
                    <ul class="list-unstyled custom-list my-4" style="font-size: 18px; margin-top: 50px">
                        <li>Cria uma conta ou faz login na tua conta existente</li>
                        <li>Acede às aulas e escolhe o tópico que desejas aprender</li>
                        <li>Comunique com outros utilizadores se tiver dúvidas ou precisar de ajuda</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- Fim da Seção "Ajudamos Você" -->

    <!-- Início da Seção do Footer -->
    <footer class="footer-section">
        <div class="container relative">
            <div class="row g-5 mb-5">
                <div class="col-lg-4">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="subscription-form">
                                <h3 class="d-flex align-items-center">
                                    <span class="me-1">
                                        <img src="http://localhost/pap-main/pap/static/images/envelope-outline.svg" alt="Email" class="img-fluid">
                                    </span>
                                    <span>Contacte-nos</span>
                                </h3>
                                <p class="footer-email">kiocodecplusplus@gmail.com</p>
                                <p><a href="contact.php" class="btn btn-primary">Contacte-nos</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="border-top copyright">
                <div class="row pt-4">
                    <div class="col-lg-6">
                        <p class="mb-2 text-center text-lg-start">Copyright &copy;<script>document.write(new Date().getFullYear());</script>. All Rights Reserved.</p>
                    </div>

                    <div class="col-lg-6 text-center text-lg-end">
                        <ul class="list-unstyled d-inline-flex ms-auto">
                            <li class="me-4"><a href="#">Terms &amp; Conditions</a></li>
                            <li><a href="#">Privacy Policy</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Fim da Seção do Footer -->

    <!-- Scripts do Bootstrap e JS -->
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/tiny-slider.js"></script>
    <script src="js/custom.js"></script>

</body>

</html>
