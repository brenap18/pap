<?php
session_start(); 

// desativa todas as variáveis da sessão
$_SESSION = array();

// se for necessário destruir a sessão, exclui o cookie da sessão
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params(); // obtém os parâmetros do cookie
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    ); 
}

// acaba a sessão
session_destroy();

// redireciona para a página de login
header("Location: login.php");
exit();
?>
