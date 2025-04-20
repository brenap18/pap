<?php
session_start();
include 'db_conn.php';

if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_SESSION['id'];
    $name = trim($_POST['name']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if (!empty($password) && $password !== $confirm_password) {
        $_SESSION['msg'] = "As senhas não coincidem.";
        $_SESSION['msg_type'] = "danger";
        header("Location: editar.php"); // Nome correto do arquivo de edição
        exit();
    }

    // Atualiza nome
    $sql = "UPDATE users SET name = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $name, $id);
    $stmt->execute();

    // Atualiza senha se fornecida
    if (!empty($password)) {
        $password_hash = password_hash($password, PASSWORD_DEFAULT);
        $sql = "UPDATE users SET password = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $password_hash, $id);
        $stmt->execute();
    }

    // Destroi sessão atual e força novo login
    session_unset();
    session_destroy();

    session_start();
    $_SESSION['msg'] = "Perfil atualizado com sucesso. Por favor, faça login novamente.";
    $_SESSION['msg_type'] = "success";
    header("Location: confirmar_login.php");
    exit();
}
?>
