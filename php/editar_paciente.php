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
    $data = $_POST['data_nascimento'];
    $tipo = $_POST['tipo_sanguineo'];

    $stmt = $pdo->prepare("UPDATE Paciente SET nome = :nome, data_nascimento = :data, tipo_sanguineo = :tipo WHERE id = :id");
    $stmt->execute([
        ':nome' => $nome,
        ':data' => $data,
        ':tipo' => $tipo,
        ':id' => $id
    ]);

    echo "<script>alert('Paciente atualizado com sucesso!'); window.location.href = '../consultar.php';</script>";
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM Paciente WHERE id = :id");
$stmt->execute([':id' => $id]);
$paciente = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$paciente) {
    echo "Paciente não encontrado.";
    exit;
}
?>

<form method="POST">
    Nome: <input type="text" name="nome" value="<?= htmlspecialchars($paciente['nome']) ?>" required><br>
    Data de Nascimento: <input type="date" name="data_nascimento" value="<?= $paciente['data_nascimento'] ?>" required><br>
    Tipo Sanguíneo: <input type="text" name="tipo_sanguineo" value="<?= htmlspecialchars($paciente['tipo_sanguineo']) ?>" required><br>
    <input type="submit" value="Salvar Alterações">
</form>
