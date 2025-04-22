<?php
// dados da base de dados
$host = "localhost";
$user = "root";
$password = "";
$db_name = "test_db";

// liga à base de dados
$conn = new mysqli($host, $user, $password, $db_name);

// verifica se deu erro
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}
?>
