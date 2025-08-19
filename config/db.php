/*
Estrutura do Banco de dados
    CREATE DATABASE crud_contatos;
    USE crud_contatos;

    CREATE TABLE contatos (
        id INT PRIMARY KEY AUTO_INCREMENT,
        nome VARCHAR(100) NOT NULL,
        email VARCHAR(100) NOT NULL,
        telefone VARCHAR(20) NOT NULL,
        cidade VARCHAR(50) NOT NULL,
        data_cadastro DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
    );
*/

// Conexão padrão BD

<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "crud_contatos";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}
?>