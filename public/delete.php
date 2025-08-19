<?php
// Exclui o contato pelo ID
 
include '../config/db.php';

// Recebe o ID do contato via GET
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id > 0) {
    $sql = "DELETE FROM contatos WHERE id = $id";
    if ($conn->query($sql)) {
        header("Location: index.php?msg=" . urlencode("Contato excluído com sucesso!"));
    } else {
        header("Location: index.php?msg=" . urlencode("Erro ao excluir contato!"));
    }
} else {
    header("Location: index.php?msg=" . urlencode("ID inválido!"));
}
exit;
?>