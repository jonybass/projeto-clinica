<?php
include 'protege.php';
include 'conexao.php';

try {
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

    $stmt = $pdo->query($sql);
    $consultas = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Erro ao buscar consultas: " . $e->getMessage());
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
        <a href="projeto-clinica/index.php">Página Inicial</a>
        <a href="medico.php">Cadastro de Médicos</a>
        <a href="paciente.php">Cadastro de Pacientes</a>
        <a href="/projeto-clinica/consultar.php">Cadastros</a>
        <a href="logout.php">Sair</a>
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
            </tr>
            <?php foreach ($consultas as $row): ?>
                <tr>
                    <td><?= date('d/m/Y H:i', strtotime($row['data_hora'])) ?></td>
                    <td><?= htmlspecialchars($row['nome_medico']) ?></td>
                    <td><?= htmlspecialchars($row['especialidade']) ?></td>
                    <td><?= htmlspecialchars($row['nome_paciente']) ?></td>
                    <td><?= nl2br(htmlspecialchars($row['observacoes'])) ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php else: ?>
        <p>Nenhuma consulta registrada ainda.</p>
    <?php endif; ?>

</body>

</html>