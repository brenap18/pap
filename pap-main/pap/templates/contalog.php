<?php 
session_start(); // começa a sessão para guardar dados entre páginas
include "db_conn.php"; // inclui a ligação à base de dados

// verifica se os dados foram enviados pelo formulário
if (isset($_POST['uname']) && isset($_POST['password'])) {

    // função para limpar os dados
    function validar($dados) {
        $dados = trim($dados); // tira espaços a mais
        $dados = stripslashes($dados); // tira barras invertidas
        $dados = htmlspecialchars($dados); // converte caracteres especiais
        return $dados;
    }

    // limpa os dados do utilizador
    $uname = validar($_POST['uname']);
    $pass = validar($_POST['password']);

    // verifica se o nome e pass do utilizador está vazio
    if (empty($uname)) {
        header("Location: login.php?error=nome de utilizador obrigatório");
        exit();
    } 

    else if (empty($pass)) {
        header("Location: login.php?error=palavra-passe obrigatória");
        exit();
    } 
    else {
        // procura o utilizador na base de dados
        $sql = "SELECT * FROM users WHERE user_name='$uname'";
        $result = mysqli_query($conn, $sql);

        // verifica se encontrou o utilizador
        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);

            // verifica se a palavra-passe está correta
            if (password_verify($pass, $row['password'])) {
                // guarda os dados do utilizador na sessão
                $_SESSION['user_name'] = $row['user_name'];
                $_SESSION['name'] = $row['name'];
                $_SESSION['id'] = $row['id'];

                // redireciona para a página principal
                header("Location: index.php");
                exit();
            } else {
                // palavra-passe errada
                header("Location: login.php?error=nome ou palavra-passe incorretos");
                exit();
            }
        } else {
            // utilizador não encontrado
            header("Location: login.php?error=nome ou palavra-passe incorretos");
            exit();
        }
    }

} else {
    // se não foram enviados os dados, vai para o login
    header("Location: login.php");
    exit();
}
?>
