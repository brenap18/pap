<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("Location: login.php"); // Redirect logged-in users
    exit();
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
		<title>Sobre nós - Kiocode</title>
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
  
		<!-- Start Hero Section -->
			<div class="hero">
				<div class="container">
					<div class="row justify-content-between">
						<div class="col-lg-5">
							<div class="intro-excerpt">
								<h1>Sobre nós</h1>
								<p class="mb-4" style="font-size: 17px;">Sou a Brena Picado, estudante da Escola Profissional Bento de Jesus Caraça, no curso de Gestão e Programação de Sistemas Informáticos, e desenvolvi este projeto como parte da minha PAP (Prova de Aptidão Profissional). 
    Aqui, apresento as competências que aprendi e aplico-as neste projeto.</p>
							</div>
						</div>
						<div class="col-lg-7">
							<div class="hero-img-wrap">
								<img src="http://localhost/pap-main/pap/static/images//Escola-Profissional-Bento-Jesus-Caraca.png" class="img-fluid">
							</div>
						</div>
					</div>
				</div>
			</div>
		<!-- End Hero Section -->

		

		<!-- Start Why Choose Us Section -->
		<div class="why-choose-section">
			<div class="container">
				<div class="row justify-content-between align-items-center">
					<div class="col-lg-6">
						<h2 class="section-title">A Estrutura do Projeto</h2>
						<p>Donec vitae odio quis nisl dapibus malesuada. Nullam ac aliquet velit. Aliquam vulputate velit imperdiet dolor tempor tristique.</p>

						<div class="row my-5">
							<div class="col-6 col-md-6">
								<div class="feature">
									<h3>Objetivo do Projeto</h3>
									<p>"Este projeto tem como objetivo 
										facilitar a aprendizagem de programação em C++. Com esta iniciativa, pretendo demonstrar as minhas competências técnicas e o meu crescimento enquanto estudante e futuro profissional da área.""</p>
								</div>
							</div>

							<div class="col-6 col-md-6">
								<div class="feature">
									<h3>Competências Técnicas</h3>
									<p>Programação em C++ e Python
										Design Responsivo
									</p>
								</div>
							</div>
						</div>
					</div>

					<div class="col-lg-5">
						<div class="img-wrap">
							<img src="http://localhost/pap-main/pap/static/images//1687438913_en-idei-club-p-aesthetic-programmer-dizain-pinterest-1.jpg" alt="Image" class="img-fluid">
						</div>
					</div>

				</div>
			</div>
		</div>
		<!-- End Why Choose Us Section -->

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
