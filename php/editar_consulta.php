<?php
include 'protege.php';
include 'conexao.php';

// Validar parâmetros obrigatórios
if (!isset($_GET['id_medico'], $_GET['id_paciente'], $_GET['data_hora'])) {
    header('Location: consultas_registradas.php');
    exit;
}

$id_medico = $_GET['id_medico'];
$id_paciente = $_GET['id_paciente'];
$data_hora = $_GET['data_hora'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $novo_id_medico = $_POST['id_medico'];
    $novo_id_paciente = $_POST['id_paciente'];
    $novo_data_hora = $_POST['data_hora'];
    $observacoes = $_POST['observacoes'];

    // Atualizar: como a PK é composta, para alterar a PK você deve primeiro deletar e inserir (ou permitir que não altere a PK)
    // Aqui vamos permitir só atualizar observações e data_hora (não alterando os ids dos médicos/pacientes para evitar complexidade)
    $stmt = $pdo->prepare("
        UPDATE Consulta SET data_hora = :data_hora, observacoes = :observacoes
        WHERE id_medico = :id_medico AND id_paciente = :id_paciente AND data_hora = :data_hora_old
    ");

    $stmt->execute([
        ':data_hora' => $novo_data_hora,
        ':observacoes' => $observacoes,
        ':id_medico' => $id_medico,
        ':id_paciente' => $id_paciente,
        ':data_hora_old' => $data_hora
    ]);

    echo "<script>alert('Consulta atualizada com sucesso!'); window.location.href = 'consultas_registradas.php';</script>";
    exit;
}

// Buscar consulta
$stmt = $pdo->prepare("SELECT * FROM Consulta WHERE id_medico = :id_medico AND id_paciente = :id_paciente AND data_hora = :data_hora");
$stmt->execute([':id_medico' => $id_medico, ':id_paciente' => $id_paciente, ':data_hora' => $data_hora]);
$consulta = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$consulta) {
    echo "Consulta não encontrada.";
    exit;
}

// Buscar médicos e pacientes para dropdown (aqui pode deixar só para visualização, já que não pode mudar id_medico e id_paciente para não complicar)
$medicos = $pdo->query("SELECT id, nome FROM Medico")->fetchAll(PDO::FETCH_ASSOC);
$pacientes = $pdo->query("SELECT id, nome FROM Paciente")->fetchAll(PDO::FETCH_ASSOC);
?>

<h2>Editar Consulta</h2>

<form method="POST">
    Médico:
    <select name="id_medico" disabled>
        <?php foreach ($medicos as $medico): ?>
            <option value="<?= $medico['id'] ?>" <?= $medico['id'] == $consulta['id_medico'] ? 'selected' : '' ?>>
                <?= htmlspecialchars($medico['nome']) ?>
            </option>
        <?php endforeach; ?>
    </select><br><br>

    Paciente:
    <select name="id_paciente" disabled>
        <?php foreach ($pacientes as $paciente): ?>
            <option value="<?= $paciente['id'] ?>" <?= $paciente['id'] == $consulta['id_paciente'] ? 'selected' : '' ?>>
                <?= htmlspecialchars($paciente['nome']) ?>
            </option>
        <?php endforeach; ?>
    </select><br><br>

    Data e Hora:
    <input type="datetime-local" name="data_hora" value="<?= date('Y-m-d\TH:i', strtotime($consulta['data_hora'])) ?>" required><br><br>

    Observações:<br>
    <textarea name="observacoes"><?= htmlspecialchars($consulta['observacoes']) ?></textarea><br><br>

    <input type="submit" value="Salvar Alterações">
</form>
