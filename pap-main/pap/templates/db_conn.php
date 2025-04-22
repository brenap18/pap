<?php

$sname = "localhost"; // servidor de banco de dados
$uname = "root"; // nome de usuário para conectar ao banco
$password = ""; // senha do banco de dados (vazia por padrão em alguns ambientes de desenvolvimento)

$db_name = "test_db"; // nome do banco de dados

// tenta estabelecer a conexão com o banco de dados
$conn = mysqli_connect($sname, $uname, $password, $db_name);

// verifica se a conexão falhou
if (!$conn) {
    echo "Connection failed!"; // mensagem de erro se falhou
}
?>
