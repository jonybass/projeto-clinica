<?php
include 'php/protege.php';
include 'php/conexao.php';


$stmtMedicos = $pdo->query("SELECT id, nome, especialidade FROM Medico");
$medicos = $stmtMedicos->fetchAll(PDO::FETCH_ASSOC);


$stmtPacientes = $pdo->query("SELECT id, nome FROM Paciente");
$pacientes = $stmtPacientes->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Registrar Consulta</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <nav>
        <a href="index.php">Página Inicial</a>
        <a href="medico.php">Cadastro de Médicos</a>
        <a href="paciente.php">Cadastro de Pacientes</a>
        <a href="php/consultas_registradas.php">Consultas Marcadas</a>
        <a href="consultar.php">Cadastros</a>
        <a href="logout.php">Sair</a>
    </nav>
    <h2>Registrar Consulta</h2>

    <form method="POST" action="php/consulta.php">
        Médico:
        <select name="id_medico" required>
            <option value="">Selecione</option>
            <?php foreach ($medicos as $medico): ?>
                <option value="<?= htmlspecialchars($medico['id']) ?>">
                    <?= htmlspecialchars($medico['nome']) ?> - <?= htmlspecialchars($medico['especialidade']) ?>
                </option>
            <?php endforeach; ?>
        </select><br><br>

        Paciente:
        <select name="id_paciente" required>
            <option value="">Selecione</option>
            <?php foreach ($pacientes as $paciente): ?>
                <option value="<?= htmlspecialchars($paciente['id']) ?>">
                    <?= htmlspecialchars($paciente['nome']) ?>
                </option>
            <?php endforeach; ?>
        </select><br><br>

        Data e Hora: <input type="datetime-local" name="data_hora" required><br><br>
        Observações:<br>
        <textarea name="observacoes"></textarea><br><br>

        <input type="submit" value="Registrar">
    </form>

</body>

</html>
