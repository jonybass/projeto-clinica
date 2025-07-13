<?php
include 'protege.php';
include 'conexao.php';

// Edição da consulta, se vier via GET
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['modo']) && $_POST['modo'] === 'editar') {
    $id_medico_original = $_POST['id_medico_original'];
    $id_paciente = $_POST['id_paciente'];
    $data_hora_original = $_POST['data_hora_original'];

    $novo_id_medico = $_POST['id_medico'];
    $novo_data_hora = $_POST['data_hora'];
    $observacoes = $_POST['observacoes'];

    try {
        $stmt = $pdo->prepare("
            UPDATE Consulta SET id_medico = :novo_id_medico, data_hora = :novo_data_hora, observacoes = :observacoes
            WHERE id_medico = :id_medico_original AND id_paciente = :id_paciente AND data_hora = :data_hora_original
        ");
        $stmt->execute([
            ':novo_id_medico' => $novo_id_medico,
            ':novo_data_hora' => $novo_data_hora,
            ':observacoes' => $observacoes,
            ':id_medico_original' => $id_medico_original,
            ':id_paciente' => $id_paciente,
            ':data_hora_original' => $data_hora_original
        ]);
        echo "<script>alert('Consulta atualizada com sucesso!'); window.location.href = '".$_SERVER['PHP_SELF']."';</script>";
        exit;
    } catch (PDOException $e) {
        echo "Erro ao atualizar consulta: " . $e->getMessage();
    }
}

// Carregar dados para exibição
try {
    $stmt = $pdo->query("
        SELECT 
            c.id_medico,
            c.id_paciente,
            c.data_hora,
            c.observacoes,
            m.nome AS nome_medico,
            m.especialidade,
            p.nome AS nome_paciente
        FROM Consulta c
        JOIN Medico m ON c.id_medico = m.id
        JOIN Paciente p ON c.id_paciente = p.id
        ORDER BY c.data_hora DESC
    ");
    $consultas = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Erro ao buscar consultas: " . $e->getMessage());
}

// Carrega especialidades e médicos
$especialidades = $pdo->query("SELECT DISTINCT especialidade FROM Medico")->fetchAll(PDO::FETCH_COLUMN);
$medicos_todos = $pdo->query("SELECT id, nome, especialidade FROM Medico")->fetchAll(PDO::FETCH_ASSOC);
$pacientes = $pdo->query("SELECT id, nome FROM Paciente")->fetchAll(PDO::FETCH_ASSOC);

// Caso seja edição, carrega consulta específica
$consulta_editar = null;
if (isset($_GET['id_medico'], $_GET['id_paciente'], $_GET['data_hora'])) {
    $stmt = $pdo->prepare("SELECT * FROM Consulta WHERE id_medico = :id_medico AND id_paciente = :id_paciente AND data_hora = :data_hora");
    $stmt->execute([
        ':id_medico' => $_GET['id_medico'],
        ':id_paciente' => $_GET['id_paciente'],
        ':data_hora' => $_GET['data_hora']
    ]);
    $consulta_editar = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Consultas Registradas</title>
</head>
<body>
    <nav>
        <a href="../index.php">Página Inicial</a>
        <a href="../medico.php">Cadastro de Médicos</a>
        <a href="../paciente.php">Cadastro de Pacientes</a>
        <a href="../consultar.php">Cadastros</a>
        <a href="../logout.php">Sair</a>
    </nav>

    <h2>Consultas Registradas</h2>

    <?php if (!empty($consultas)): ?>
        <table border="1" cellpadding="8" cellspacing="0">
            <tr>
                <th>Data e Hora</th>
                <th>Médico</th>
                <th>Especialidade</th>
                <th>Paciente</th>
                <th>Observações</th>
                <th>Ações</th>
            </tr>
            <?php foreach ($consultas as $row): ?>
                <tr>
                    <td><?= date('d/m/Y H:i', strtotime($row['data_hora'])) ?></td>
                    <td><?= htmlspecialchars($row['nome_medico']) ?></td>
                    <td><?= htmlspecialchars($row['especialidade']) ?></td>
                    <td><?= htmlspecialchars($row['nome_paciente']) ?></td>
                    <td><?= nl2br(htmlspecialchars($row['observacoes'])) ?></td>
                    <td>
                        <a href="?id_medico=<?= $row['id_medico'] ?>&id_paciente=<?= $row['id_paciente'] ?>&data_hora=<?= urlencode($row['data_hora']) ?>">Editar</a> |
                        <a href="excluir_consulta.php?id_medico=<?= $row['id_medico'] ?>&id_paciente=<?= $row['id_paciente'] ?>&data_hora=<?= urlencode($row['data_hora']) ?>" onclick="return confirm('Deseja excluir esta consulta?')">Excluir</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php else: ?>
        <p>Nenhuma consulta registrada ainda.</p>
    <?php endif; ?>

    <?php if ($consulta_editar): ?>
        <hr>
        <h2>Editar Consulta</h2>
        <form method="POST">
            <input type="hidden" name="modo" value="editar">
            <input type="hidden" name="id_medico_original" value="<?= $consulta_editar['id_medico'] ?>">
            <input type="hidden" name="id_paciente" value="<?= $consulta_editar['id_paciente'] ?>">
            <input type="hidden" name="data_hora_original" value="<?= $consulta_editar['data_hora'] ?>">

            Especialidade:
            <select id="especialidade" required>
                <option value="">Selecione</option>
                <?php foreach ($especialidades as $esp): ?>
                    <option value="<?= htmlspecialchars($esp) ?>" <?= ($esp === $medicos_todos[array_search($consulta_editar['id_medico'], array_column($medicos_todos, 'id'))]['especialidade']) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($esp) ?>
                    </option>
                <?php endforeach; ?>
            </select><br><br>

            Médico:
            <select name="id_medico" id="id_medico" required>
                <?php foreach ($medicos_todos as $med): ?>
                    <option 
                        value="<?= $med['id'] ?>" 
                        data-especialidade="<?= htmlspecialchars($med['especialidade']) ?>"
                        <?= $med['id'] == $consulta_editar['id_medico'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($med['nome']) ?> (<?= htmlspecialchars($med['especialidade']) ?>)
                    </option>
                <?php endforeach; ?>
            </select><br><br>

            Data e Hora:
            <input type="datetime-local" name="data_hora" value="<?= date('Y-m-d\TH:i', strtotime($consulta_editar['data_hora'])) ?>" required><br><br>

            Observações:<br>
            <textarea name="observacoes"><?= htmlspecialchars($consulta_editar['observacoes']) ?></textarea><br><br>

            <input type="submit" value="Salvar Alterações">
        </form>

        <script>
            const especialidadeSelect = document.getElementById('especialidade');
            const medicoSelect = document.getElementById('id_medico');

            function filtrarMedicos() {
                const especialidade = especialidadeSelect.value;
                for (let option of medicoSelect.options) {
                    const esp = option.getAttribute('data-especialidade');
                    option.style.display = (esp === especialidade) ? 'block' : 'none';
                }

                // Reseta seleção se o médico não pertencer à especialidade
                const selected = medicoSelect.options[medicoSelect.selectedIndex];
                if (selected && selected.style.display === 'none') {
                    medicoSelect.selectedIndex = 0;
                }
            }

            especialidadeSelect.addEventListener('change', filtrarMedicos);
            window.addEventListener('DOMContentLoaded', filtrarMedicos);
        </script>
    <?php endif; ?>
</body>
</html>
