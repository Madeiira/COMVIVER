<?php
// Lista todos os contatos e permite pesquisar, editar e excluir

include '../config/db.php';

// Mensagem de feedback (sucesso ou erro)
$msg = '';
if (isset($_GET['msg'])) $msg = $_GET['msg'];

// Lógica de busca
$busca = '';
$sql = "SELECT * FROM contatos";
if (isset($_GET['busca']) && $_GET['busca'] != '') {
    $busca = $conn->real_escape_string($_GET['busca']);
    $sql .= " WHERE nome LIKE '%$busca%' OR cidade LIKE '%$busca%'";
}
$sql .= " ORDER BY data_cadastro DESC";
$result = $conn->query($sql);
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>CRUD de Contatos</title>
</head>
<body>
    <h1>Contatos</h1>
    <!-- Formulário de pesquisa -->
    <form method="get" action="">
        <input type="text" name="busca" placeholder="Buscar por nome ou cidade" value="<?= htmlspecialchars($busca) ?>">
        <button type="submit">Pesquisar</button>
        <a href="index.php">Limpar</a>
    </form>
    <p><a href="form.php">Adicionar Novo Contato</a></p>
    <!-- Mensagens de feedback -->
    <?php if ($msg): ?>
        <p><?= htmlspecialchars($msg) ?></p>
    <?php endif; ?>
    <!-- Tabela de contatos -->
    <table border="1" cellpadding="6" cellspacing="0">
        <tr>
            <th>Nome</th>
            <th>E-mail</th>
            <th>Telefone</th>
            <th>Cidade</th>
            <th>Data de Cadastro</th>
            <th>Ações</th>
        </tr>
        <?php while($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= htmlspecialchars($row['nome']) ?></td>
            <td><?= htmlspecialchars($row['email']) ?></td>
            <td><?= htmlspecialchars($row['telefone']) ?></td>
            <td><?= htmlspecialchars($row['cidade']) ?></td>
            <td><?= date('d/m/Y H:i', strtotime($row['data_cadastro'])) ?></td>
            <td>
                <a href="form.php?id=<?= $row['id'] ?>">Editar</a> | 
                <a href="delete.php?id=<?= $row['id'] ?>" onclick="return confirm('Tem certeza que deseja excluir?')">Excluir</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>