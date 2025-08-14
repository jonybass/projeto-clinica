<?php
include 'php/conexao.php';
include 'php/protege.php';

// Buscar consultas com paciente e imagem do paciente
$stmt = $pdo->query("SELECT Consulta.*, Paciente.nome AS paciente_nome, Paciente.tipo_sanguineo, imagens.path
                    FROM Consulta
                    INNER JOIN Paciente ON Consulta.id_paciente = Paciente.id
                    LEFT JOIN imagens ON Paciente.imagem_id = imagens.id
                    ORDER BY Consulta.data_hora ASC");
$consultas = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Consultas Marcadas</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <nav>
        <a href="index.php">Página Inicial</a>
        <a href="paciente.php">Cadastro de Pacientes</a>
        <a href="medico.php">Cadastro de Médicos</a>
        <a href="consulta.php">Registrar Consulta</a>
        <a href="logout.php">Sair</a>
    </nav>

    <h2>Consultas Marcadas</h2>

    <?php foreach ($consultas as $c): ?>
        <div class="consulta">
            <strong>Paciente:</strong> <?= htmlspecialchars($c['paciente_nome']) ?><br>
            <strong>Tipo Sanguíneo:</strong> <?= htmlspecialchars($c['tipo_sanguineo']) ?><br>
            <strong>Data e Hora:</strong> <?= date('d/m/Y H:i', strtotime($c['data_hora'])) ?><br>
            <img src="<?= $c['path'] ? 'img/' . $c['path'] : 'img/profile.jpg' ?>" alt="Foto do paciente">
        </div>
        <hr>
    <?php endforeach; ?>
</body>
</html>
