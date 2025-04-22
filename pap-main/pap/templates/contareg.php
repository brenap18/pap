<?php 
session_start(); // começa a sessão para guardar dados entre páginas
include "db_conn.php"; // inclui o arquivo de conexão com o banco de dados

// verifica se os dados do formulário foram enviados
if (isset($_POST['uname']) && isset($_POST['password']) && isset($_POST['password_confirm']) && isset($_POST['name'])) {

    // função para limpar os dados
    function validar($dados) {
        $dados = trim($dados); // remove espaços extras
        $dados = stripslashes($dados); // remove barras invertidas
        $dados = htmlspecialchars($dados); // converte caracteres especiais
        return $dados;
    }

    // limpa os dados do formulário
    $uname = validar($_POST['uname']);
    $pass = validar($_POST['password']);
    $pass_confirm = validar($_POST['password_confirm']);
    $name = validar($_POST['name']);

    // valida os campos do formulário
    if (empty($uname)) {
        header("Location: register.php?error=nome de utilizador obrigatório");
        exit();
    } else if (empty($pass)) {
        header("Location: register.php?error=palavra-passe obrigatória");
        exit();
    } else if (empty($pass_confirm)) {
        header("Location: register.php?error=confirmar a palavra-passe");
        exit();
    } else if ($pass !== $pass_confirm) {   
        header("Location: register.php?error=palavras-passes diferentes");
        exit();
    } else {
        // verifica se o nome de utilizador já existe no banco
        $sql = "SELECT * FROM users WHERE user_name='$uname'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            header("Location: register.php?error=nome de utilizador já existe");
            exit();
        } else {
            // faz o hash da palavra-passe para segurança
            $hashed_pass = password_hash($pass, PASSWORD_DEFAULT);

            // insere o novo utilizador na base de dados
            $sql = "INSERT INTO users (user_name, password, name) VALUES ('$uname', '$hashed_pass', '$name')";

            if (mysqli_query($conn, $sql)) {
                // registo bem-sucedido, redireciona para a página de login
                header("Location: login.php?success=registo completo, por favor entre na sua conta");
                exit();
            } else {
                header("Location: register.php?error=erro ao registar");
                exit();
            }
        }
    }

} else {
    // se o formulário não foi enviado, redireciona para a página de registo
    header("Location: register.php");
    exit();
}
?>
