<?php
// Salva (insere ou atualiza) um contato
 
include '../config/db.php';

// Função para redirecionar com mensagem
function redir($msg) {
    header("Location: index.php?msg=" . urlencode($msg));
    exit;
}

// Recebe os dados do formulário
$id = isset($_POST['id']) ? intval($_POST['id']) : '';
$nome = trim($_POST['nome'] ?? '');
$email = trim($_POST['email'] ?? '');
$telefone = trim($_POST['telefone'] ?? '');
$cidade = trim($_POST['cidade'] ?? '');

// Validações simples
if (!$nome || !$email || !$telefone || !$cidade) {
    redir("Preencha todos os campos!");
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    redir("E-mail inválido!");
}

// Se for edição, faz UPDATE, verificando o id enviado
if ($id) {
    $stmt = $conn->prepare("UPDATE contatos SET nome=?, email=?, telefone=?, cidade=? WHERE id=?");
    $stmt->bind_param("ssssi", $nome, $email, $telefone, $cidade, $id);
    $res = $stmt->execute();
    $stmt->close();
    redir($res ? "Contato atualizado com sucesso!" : "Erro ao atualizar contato!");
} else {
    // Senão, faz INSERT
    $stmt = $conn->prepare("INSERT INTO contatos (nome, email, telefone, cidade) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $nome, $email, $telefone, $cidade);
    $res = $stmt->execute();
    $stmt->close();
    redir($res ? "Contato cadastrado com sucesso!" : "Erro ao cadastrar contato!");
}
?>