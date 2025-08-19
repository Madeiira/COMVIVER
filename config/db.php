

<?php
$host = "localhost:3320";
$user = "root";
$pass = "";
$db = "crud_contatos";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}
?>