<?php
session_start();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Confirmação de Login</title>
  <link rel="stylesheet" href="../static/css/bootstrap.min.css">
  <style>
    body {
      background-color: #f4f4f9;
      text-align: center;
      padding-top: 100px;
    }
    .container {
      max-width: 600px;
      margin: auto;
      background: white;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
    .btn-login {
      background-color: #4a4b8b;
      color: white;
      font-weight: bold;
      padding: 10px 20px;
      border-radius: 5px;
      text-decoration: none;
      display: inline-block;
    }
    .btn-login:hover {
      background-color: #383969;
    }
  </style>
</head>
<body>

  <div class="container">
    <h1>Confirmação de Atualização</h1>
    <p>
      <?php
      echo isset($_SESSION['msg']) ? $_SESSION['msg'] : "Você precisa fazer login novamente.";
      unset($_SESSION['msg']);
      ?>
    </p>
    <a href="login.php" class="btn-login">Ir para o Login</a>
  </div>

</body>
</html>
