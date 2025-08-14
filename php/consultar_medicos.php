<?php
include 'conexao.php';
include 'protege.php';

try {
    // Buscar médicos com imagem
    $stmt = $pdo->query("SELECT Medico.*, imagens.path 
                         FROM Medico 
                         LEFT JOIN imagens ON Medico.imagem_id = imagens.id");
    $medicos = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Erro: " . $e->getMessage();
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Consultar Médicos</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>


<body>
 <ul>
    <li><a href="medico.php">Cadastro de Médicos</a></li>
    <li><a href="paciente.php">Cadastro de Pacientes</a></li>
    <li><a href="../consulta.php">Registrar Consulta</a></li>
    <li><a href="consultas_registradas.php">Consultas Marcadas</a></li>
    
    <li><a href="consultar_pacientes.php">Consultar Pacientes</a></li>
    <li><a href="consultar.php">Cadastros</a></li>
    <li><a href="logout.php">Sair</a></li>
</ul>

    

    <h2>Médicos Cadastrados</h2>
    <?php if (count($medicos) > 0): ?>
        <table>
            <tr>
                <th>Nome</th>
                <th>Especialidade</th>
                <th>Imagem</th>
            </tr>
            <?php foreach ($medicos as $m): ?>
                <tr>
                    
                    <td><?= htmlspecialchars($m['nome']) ?></td>
                    <td><?= htmlspecialchars($m['especialidade']) ?></td>
                    <td>
                        <img src="<?= $m['path'] ? '../img/' . $m['path'] : '../img/profile.jpg' ?>" alt="Foto do médico">
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php else: ?>
        <p>Nenhum médico cadastrado.</p>
    <?php endif; ?>
</body>
</html>
