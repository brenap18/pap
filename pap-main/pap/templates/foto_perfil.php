<?php
session_start();
require_once 'conexao_foto.php'; // inclui a conexão com o banco de dados

// verifica se o usuário está logado
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

// define o diretório para salvar fotos
$uploadDir = "uploads/fotos/";

// cria o diretório se não existir
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

// verifica se um arquivo foi enviado
if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
    $fileTmpPath = $_FILES['foto']['tmp_name']; // caminho temporário do arquivo
    $fileName = basename($_FILES['foto']['name']); // nome do arquivo
    $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION)); // extensão do arquivo
    $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif']; // extensões permitidas

    // verifica se a extensão é permitida
    if (in_array($fileExtension, $allowedExtensions)) {
        $newFileName = uniqid('perfil_', true) . '.' . $fileExtension; // gera nome único para o arquivo
        $destPath = $uploadDir . $newFileName; // caminho destino

        // move o arquivo para o diretório de upload
        if (move_uploaded_file($fileTmpPath, $destPath)) {
            $_SESSION['foto_perfil'] = $destPath; // salva o caminho da foto na sessão

            // atualiza a foto no banco de dados
            $stmt = $conn->prepare("UPDATE users SET foto_perfil = ? WHERE id = ?");
            $stmt->bind_param("si", $destPath, $_SESSION['id']);
            $stmt->execute();
        } else {
            $_SESSION['msg'] = "Erro ao mover o arquivo enviado."; // erro ao mover arquivo
        }
    } else {
        $_SESSION['msg'] = "Tipo de arquivo inválido. Envie uma imagem (jpg, jpeg, png ou gif)."; // arquivo inválido
    }
} else {
    $_SESSION['msg'] = "Erro ao fazer upload da imagem."; // erro ao fazer upload
}

// redireciona para a página de edição
header("Location: editar.php");
exit();
?>
