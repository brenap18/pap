<?php
// Definir as configurações de conexão
$host = "localhost";
$user = "root";
$password = "";
$db_name = "test_db";

// Criar a conexão
$conn = new mysqli($host, $user, $password, $db_name);

// Verificar se a conexão foi bem-sucedida
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}
?>
