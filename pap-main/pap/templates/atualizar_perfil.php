<?php
session_start();
include 'db_conn.php';

// se não estiver logado, redireciona
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

// envia o formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_SESSION['id'];
    $user_name = trim($_POST['user_name']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // se a senha foi escrita mas não coincide com a confirmação
    if (!empty($password) && $password !== $confirm_password) {
        $_SESSION['msg'] = "As senhas não coincidem.";
        $_SESSION['msg_type'] = "danger";
        header("Location: editar.php");
        exit();
    }

    // atualiza o user_name
    $sql = "UPDATE users SET user_name = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $user_name, $id);
    $stmt->execute();

    // atualiza a senha se for fornecida
    if (!empty($password)) {
        $password_hash = password_hash($password, PASSWORD_DEFAULT);
        $sql = "UPDATE users SET password = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $password_hash, $id);
        $stmt->execute();
    }

    // termina a sessão e pede novo login
    session_unset();
    session_destroy();

    session_start();
    $_SESSION['msg'] = "Perfil atualizado com sucesso. Por favor, faça login novamente.";
    $_SESSION['msg_type'] = "success";
    header("Location: confirmar_login.php");
    exit();
}
?>
