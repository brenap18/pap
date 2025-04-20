<?php
session_start();
require_once 'conexao_foto.php';

// Verifica se o usuário está logado
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

// Caminho para salvar as fotos
$uploadDir = "uploads/fotos/";

// Garante que o diretório existe
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

// Verifica se um arquivo foi enviado
if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
    $fileTmpPath = $_FILES['foto']['tmp_name'];
    $fileName = basename($_FILES['foto']['name']);
    $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
    $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];

    if (in_array($fileExtension, $allowedExtensions)) {
        $newFileName = uniqid('perfil_', true) . '.' . $fileExtension;
        $destPath = $uploadDir . $newFileName;

        if (move_uploaded_file($fileTmpPath, $destPath)) {
            // Atualiza a foto de perfil na sessão
            $_SESSION['foto_perfil'] = $destPath;

            // Atualiza a foto no banco de dados
            $stmt = $conn->prepare("UPDATE users SET foto_perfil = ? WHERE id = ?");
            $stmt->bind_param("si", $destPath, $_SESSION['id']);
            $stmt->execute();
        } else {
            $_SESSION['msg'] = "Erro ao mover o arquivo enviado.";
        }
    } else {
        $_SESSION['msg'] = "Tipo de arquivo inválido. Envie uma imagem (jpg, jpeg, png ou gif).";
    }
} else {
    $_SESSION['msg'] = "Erro ao fazer upload da imagem.";
}

// Redireciona de volta à página de edição
header("Location: editar.php");
exit();
?>
