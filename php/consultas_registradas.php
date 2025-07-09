<?php

include 'protege.php';
include 'conexao.php';

$sql = "SELECT 
            c.data_hora,
            c.observacoes,
            m.nome AS nome_medico,
            m.especialidade,
            p.nome AS nome_paciente
        FROM Consulta c
        JOIN Medico m ON c.id_medico = m.id
        JOIN Paciente p ON c.id_paciente = p.id
        ORDER BY c.data_hora DESC";

$result = $conexao->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Consultas Registradas</title>
</head>
<body>

<h2>Consultas Realizadas</h2>

<?php if ($result && $result->num_rows > 0): ?>
    <table border="1" cellpadding="8" cellspacing="0">
        <tr>
            <th>Data e Hora</th>
            <th>Médico</th>
            <th>Especialidade</th>
            <th>Paciente</th>
            <th>Observações</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= date('d/m/Y H:i', strtotime($row['data_hora'])) ?></td>
                <td><?= $row['nome_medico'] ?></td>
                <td><?= $row['especialidade'] ?></td>
                <td><?= $row['nome_paciente'] ?></td>
                <td><?= nl2br($row['observacoes']) ?></td>
            </tr>
        <?php endwhile; ?>
    </table>
<?php else: ?>
    <p>Nenhuma consulta registrada ainda.</p>
<?php endif; ?>

</body>
</html>
