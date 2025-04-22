<?php
// dados da base de dados
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'test_db';

// liga à base de dados
$conn = new mysqli($host, $user, $password, $dbname);

// verifica se falhou
if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}

// define charset para aceitar acentos, etc.
$conn->set_charset("utf8");
?>
