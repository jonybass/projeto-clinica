<?php
include 'php/conexao.php';
include 'php/protege.php';

// Buscar médicos com imagem
$stmt = $pdo->query("SELECT Medico.*, imagens.path 
                    FROM Medico 
                    LEFT JOIN imagens ON Medico.imagem_id = imagens.id");
$medicos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Médicos Cadastrados</title>
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

    <h2>Médicos Cadastrados</h2>

    <?php foreach ($medicos as $m): ?>
        <div class="medico">
            <strong>Nome:</strong> <?= htmlspecialchars($m['nome']) ?><br>
            <strong>Especialidade:</strong> <?= htmlspecialchars($m['especialidade']) ?><br>
            <img src="<?= $m['path'] ? 'img/' . $m['path'] : 'img/profile.jpg' ?>" alt="Foto do médico">
        </div>
        <hr>
    <?php endforeach; ?>
</body>
</html>
