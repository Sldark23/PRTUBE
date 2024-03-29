<?php
// Configurações do banco de dados
$host = 'localhost'; // Host do PostgreSQL (normalmente 'localhost' para ambiente local)
$dbname = 'datebase'; // Nome do banco de dados
$user = 'host'; // Usuário do banco de dados
$password = 'host'; // Senha do banco de dados
try {
    $conn = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo 'Erro ao conectar ao banco de dados: ' . $e->getMessage();
}
?>
