<?php
session_start();

// Redireciona se o usuário não estiver logado
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

// Inicializa o histórico de navegação se ainda não existir
if (!isset($_SESSION['history'])) {
    $_SESSION['history'] = [];
}

// Obtém o nome da página atual
$current_page = basename($_SERVER['PHP_SELF']);

// Evita adicionar a mesma página repetidamente
if (empty($_SESSION['history']) || end($_SESSION['history']) !== $current_page) {
    $_SESSION['history'][] = $current_page;
}

// Limita o histórico às últimas 5 páginas
if (count($_SESSION['history']) > 5) {
    array_shift($_SESSION['history']);
}
?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="author" content="Untree.co">
  <link rel="shortcut icon" href="favicon.png">

  <meta name="description" content="" />
  <meta name="keywords" content="bootstrap, bootstrap4" />

		<!-- Bootstrap CSS -->
		<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
		<link href="../static/css/bootstrap.min.css" rel="stylesheet">
		<link href="../static/css/tiny-slider.css" rel="stylesheet">
		<link href="../static/css/style.css" rel="stylesheet">
		<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
  		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
		<title>Contactos - Kiocode </title>
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
				<li><a class="nav-link" href="login.php"><img src="http://localhost/pap-main/pap/static/images/user.png"></a></li>
			</ul>
	  </div>
	</div>
  
  </nav>
  <!-- Fim da Navegação -->

		
		<!-- Start Contact Form -->
<div class="untree_co-section">
    <div class="container">

        <div class="block">
            <div class="intro-excerpt">
                <h1>Contactos</h1>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-8 pb-4">
                <div class="row mb-5">
                    <div class="col-lg-4">
                        <div class="service no-shadow align-items-center link horizontal d-flex active" data-aos="fade-left" data-aos-delay="0">
                            <div class="service-icon color-1 mb-4">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-geo-alt-fill" viewBox="0 0 16 16">
                                    <path d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10zm0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6z"/>
                                </svg>
                            </div> <!-- /.icon -->
                            <div class="service-contents">
                                <p>R. Stinville 14, 2830-144 Barreiro</p>
                            </div> <!-- /.service-contents-->
                        </div> <!-- /.service -->
                    </div>

                    <div class="col-lg-4">
                        <div class="service no-shadow align-items-center link horizontal d-flex active" data-aos="fade-left" data-aos-delay="0">
                            <div class="service-icon color-1 mb-4">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope-fill" viewBox="0 0 16 16">
                                    <path d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414.05 3.555zM0 4.697v7.104l5.803-3.558L0 4.697zM6.761 8.83l-6.57 4.027A2 2 0 0 0 2 14h12a2 2 0 0 0 1.808-1.144l-6.57-4.027L8 9.586l-1.239-.757zm3.436-.586L16 11.801V4.697l-5.803 3.546z"/>
                                </svg>
                            </div> <!-- /.icon -->
                            <div class="service-contents">
                                <p>kiocodecplusplus@gmail.com</p>
                            </div> <!-- /.service-contents-->
                        </div> <!-- /.service -->
                    </div>

                    <div class="col-lg-4">
                        <div class="service no-shadow align-items-center link horizontal d-flex active" data-aos="fade-left" data-aos-delay="0">
                            <div class="service-icon color-1 mb-4">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-telephone-fill" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M1.885.511a1.745 1.745 0 0 1 2.61.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z"/>
                                </svg>
                            </div> <!-- /.icon -->
                            <div class="service-contents">
                                <p>+351 936 015 489</p>
                            </div> <!-- /.service-contents-->
                        </div> <!-- /.service -->
                    </div>
                </div>

                <!-- Formulário de Contato -->
                <form action="https://api.web3forms.com/submit" method="POST">
                    <!-- Chave de Acesso da API Web3Forms -->
                    <input type="hidden" name="access_key" value="7cedfbb8-b347-41a1-8ba4-a2413bbc9fec">

                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label class="text-black" for="fname">Nome</label>
                                <input type="text" class="form-control" id="fname" name="first_name" required>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label class="text-black" for="lname">Sobrenome</label>
                                <input type="text" class="form-control" id="lname" name="last_name" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="text-black" for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>

                    <div class="form-group mb-5">
                        <label class="text-black" for="message">Mensagem</label>
                        <textarea class="form-control" id="message" name="message" cols="30" rows="5" required></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary-hover-outline">Enviar</button>
                </form>

            </div>

        </div>

    </div>
</div>
<!-- End Contact Form -->


		

		<!-- Início da Seção do Footer -->
<footer class="footer-section">
	<div class="container relative">
	  <div class="row g-5 mb-5">
		<div class="col-lg-4">
		  <div class="mb-4 footer-logo-wrap"><a href="#" class="footer-logo">Kiocode</a></div>
		  <div class="row">
			<div class="col-lg-8">
			  <div class="subscription-form">
				<h3 class="d-flex align-items-center">
				  <span class="me-1"><img src="http://localhost/pap-main/pap/static/images//envelope-outline.svg" alt="Image" class="img-fluid"></span>
				  <span>Contacte nos</span>
				</h3>
				<p class="footer-email">kiocodecplusplus@gmail.com</p>
				<p><a href="contact.php" class="btn btn-primary">Contacte-nos</a></p>
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


		<script src="js/bootstrap.bundle.min.js"></script>
		<script src="js/tiny-slider.js"></script>
		<script src="js/custom.js"></script>
	</body>

</html>
