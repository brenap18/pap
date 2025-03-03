<?php 
session_start();
include "db_conn.php"; // Ensure this file contains your database connection

// Handle the registration logic when the form is submitted
if (isset($_POST['uname']) && isset($_POST['password']) && isset($_POST['password_confirm']) && isset($_POST['name'])) {

    function validate($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    // Get form data
    $uname = validate($_POST['uname']);
    $pass = validate($_POST['password']);
    $pass_confirm = validate($_POST['password_confirm']);
    $name = validate($_POST['name']);

    // Validate form fields
    if (empty($uname)) {
        header("Location: register.php?error=Username é obrigatório");
        exit();
    } else if (empty($pass)) {
        header("Location: register.php?error=Password é obrigatório");
        exit();
    } else if (empty($pass_confirm)) {
        header("Location: register.php?error=Confirme a sua Palavra-passe");
        exit();
    } else if ($pass !== $pass_confirm) {   
        header("Location: register.php?error=Palavras-passes diferentes");
        exit();
    } else {

        // Check if the username already exists in the database
        $sql = "SELECT * FROM users WHERE user_name='$uname'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            header("Location: register.php?error=Username já existe");
            exit();
        } else {

            // Hash the password for security
            $hashed_pass = password_hash($pass, PASSWORD_DEFAULT);

            // Insert the new user into the database
            $sql = "INSERT INTO users (user_name, password, name) VALUES ('$uname', '$hashed_pass', '$name')";

            if (mysqli_query($conn, $sql)) {
                // Registration successful, redirect to login page
                header("Location: login.php?success=Registo completo, por favor entre na sua conta");
                exit();
            } else {
                header("Location: register.php?error=Erro");
                exit();
            }
        }
    }

} else {
    header("Location: register.php");
    exit();
}
?>
