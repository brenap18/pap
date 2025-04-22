<?php
session_start();
include 'come_conexao.php'; // liga à base de dados

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_SESSION['id'])) {
        $usuario_id = $_SESSION['id']; // id do user
        $comentario = $_POST['comentario'];

        // insere comentário de forma segura
        $sql = "INSERT INTO comentarios (usuario_id, comentario) VALUES (?, ?)";

        if ($stmt = mysqli_prepare($conn, $sql)) {
            mysqli_stmt_bind_param($stmt, "is", $usuario_id, $comentario); // "i" = inteiro, "s" = string

            if (mysqli_stmt_execute($stmt)) {
                echo "Comentário enviado com sucesso!";
            } else {
                echo "Erro ao enviar comentário: " . mysqli_stmt_error($stmt);
            }

            mysqli_stmt_close($stmt);
        } else {
            echo "Erro ao preparar: " . mysqli_error($conn);
        }
    } else {
        echo "Precisas de estar logado para comentar.";
    }
}
?>
