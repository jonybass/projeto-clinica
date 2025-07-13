<?php
include 'protege.php';
include 'conexao.php';

if (!isset($_GET['id'])) {
    header('Location: ../consultar.php');
    exit;
}

$id = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $especialidade = $_POST['especialidade'];

    $stmt = $pdo->prepare("UPDATE Medico SET nome = :nome, especialidade = :especialidade WHERE id = :id");
    $stmt->execute([
        ':nome' => $nome,
        ':especialidade' => $especialidade,
        ':id' => $id
    ]);

    echo "<script>alert('Médico atualizado com sucesso!'); window.location.href = '../consultar.php';</script>";
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM Medico WHERE id = :id");
$stmt->execute([':id' => $id]);
$medico = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$medico) {
    echo "Médico não encontrado.";
    exit;
}
?>

<form method="POST">
    Nome: <input type="text" name="nome" value="<?= htmlspecialchars($medico['nome']) ?>" required><br>
    Especialidade: <input type="text" name="especialidade" value="<?= htmlspecialchars($medico['especialidade']) ?>" required><br>
    <input type="submit" value="Salvar Alterações">
</form>
