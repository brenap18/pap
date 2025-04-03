<?php
session_start();
include 'come_conexao.php'; // Arquivo de conexão com o banco de dados

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_SESSION['id'])) {
        $usuario_id = $_SESSION['id']; // Obtém o ID do usuário logado
        $comentario = $_POST['comentario'];

        // Prevenir SQL Injection usando Prepared Statements
        $sql = "INSERT INTO comentarios (usuario_id, comentario) VALUES (?, ?)";

        // Preparar a consulta
        if ($stmt = mysqli_prepare($conn, $sql)) {
            // Bind dos parâmetros
            mysqli_stmt_bind_param($stmt, "is", $usuario_id, $comentario); // "i" para int e "s" para string

            // Executar a consulta
            if (mysqli_stmt_execute($stmt)) {
                echo "Comentário enviado com sucesso!";
            } else {
                echo "Erro ao enviar comentário: " . mysqli_stmt_error($stmt);
            }

            // Fechar a declaração
            mysqli_stmt_close($stmt);
        } else {
            echo "Erro ao preparar a consulta: " . mysqli_error($conn);
        }
    } else {
        echo "Você precisa estar logado para comentar.";
    }
}
?>
