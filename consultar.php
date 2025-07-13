<?php
include 'php/protege.php';
include 'php/conexao.php';

// Buscar médicos
$medicos = $pdo->query("SELECT * FROM Medico")->fetchAll(PDO::FETCH_ASSOC);

// Buscar pacientes
$pacientes = $pdo->query("SELECT * FROM Paciente")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Consulta de Médicos e Pacientes</title>
</head>
<body>

    <h1>Médicos Cadastrados</h1>
    <table border="1" cellpadding="8" cellspacing="0">
        <tr>
            <th>Nome</th>
            <th>Especialidade</th>
            <th>Ações</th>
        </tr>
        <?php foreach ($medicos as $medico): ?>
        <tr>
            <td><?= htmlspecialchars($medico['nome']) ?></td>
            <td><?= htmlspecialchars($medico['especialidade']) ?></td>
            <td>
                <a href="php/editar_medico.php?id=<?= $medico['id'] ?>">Editar</a> |
                <a href="php/excluir_medico.php?id=<?= $medico['id'] ?>" onclick="return confirm('Tem certeza que deseja excluir este médico?')">Excluir</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>

    <h1>Pacientes Cadastrados</h1>
    <table border="1" cellpadding="8" cellspacing="0">
        <tr>
            <th>Nome</th>
            <th>Data de Nascimento</th>
            <th>Tipo Sanguíneo</th>
            <th>Ações</th>
        </tr>
        <?php foreach ($pacientes as $paciente): ?>
        <tr>
            <td><?= htmlspecialchars($paciente['nome']) ?></td>
            <td><?= htmlspecialchars($paciente['data_nascimento']) ?></td>
            <td><?= htmlspecialchars($paciente['tipo_sanguineo']) ?></td>
            <td>
                <a href="php/editar_paciente.php?id=<?= $paciente['id'] ?>">Editar</a> |
                <a href="php/excluir_paciente.php?id=<?= $paciente['id'] ?>" onclick="return confirm('Tem certeza que deseja excluir este paciente?')">Excluir</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>

</body>
</html>
