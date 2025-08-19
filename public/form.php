<?php
// Formulário de cadastro/edição de contato

include '../config/db.php';

// Variáveis para os campos do formulário
$id = '';
$nome = $email = $telefone = $cidade = '';
$editando = false;

// Se houver um ID na URL, busca os dados para edição
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $sql = "SELECT * FROM contatos WHERE id = $id";
    $res = $conn->query($sql);
    if ($res && $res->num_rows > 0) {
        $editando = true;
        $row = $res->fetch_assoc();
        $nome = $row['nome'];
        $email = $row['email'];
        $telefone = $row['telefone'];
        $cidade = $row['cidade'];
    }
}
?>
<!DOCTYPE html>
<link rel="stylesheet" href="assets/style.css">
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title><?= $editando ? 'Editar' : 'Adicionar' ?> Contato</title>
</head>
<body>
    <h1><?= $editando ? 'Editar' : 'Adicionar' ?> Contato</h1>
    <form method="post" action="save.php">
        <input type="hidden" name="id" value="<?= htmlspecialchars($id) ?>">
        <label>Nome:<br>
            <input type="text" name="nome" required value="<?= htmlspecialchars($nome) ?>">
        </label><br><br>
        <label>E-mail:<br>
            <input type="email" name="email" required value="<?= htmlspecialchars($email) ?>">
        </label><br><br>
        <label>Telefone:<br>
            <input type="text" name="telefone" required value="<?= htmlspecialchars($telefone) ?>">
        </label><br><br>
        <label>Cidade:<br>
            <input type="text" name="cidade" required value="<?= htmlspecialchars($cidade) ?>">
        </label><br><br>
        <button type="submit"><?= $editando ? 'Salvar Alterações' : 'Cadastrar' ?></button>
        <a href="index.php">Voltar</a>
    </form>
</body>
</html>