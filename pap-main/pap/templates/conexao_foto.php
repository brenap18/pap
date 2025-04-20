<?php
// Credenciais do banco de dados
$host = 'localhost'; // Endereço do servidor
$user = 'root'; // Usuário do banco de dados
$password = ''; // Senha do banco de dados
$dbname = 'test_db'; // Nome do banco de dados

// Cria a conexão com o banco de dados
$conn = new mysqli($host, $user, $password, $dbname);

// Verifica se houve erro na conexão
if ($conn->connect_error) {
    die("Erro ao conectar ao banco de dados: " . $conn->connect_error);
}

// Configura o charset para UTF-8 para garantir a correta leitura de caracteres especiais
$conn->set_charset("utf8");
?>
