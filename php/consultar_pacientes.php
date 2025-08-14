<?php
include 'conexao.php';
include 'protege.php';

try {
    // Buscar pacientes com imagem
    $stmt = $pdo->query("SELECT Paciente.*, imagens.path 
                         FROM Paciente
                         LEFT JOIN imagens ON Paciente.imagem_id = imagens.id");
    $pacientes = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Erro: " . $e->getMessage();
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Consultar Pacientes</title>
   <link rel="stylesheet" href="css/style.css">
</head>
<body>


<ul>
    <li><a href="../medico.php">Cadastro de Médicos</a></li>
    <li><a href="../paciente.php">Cadastro de Pacientes</a></li>
    <li><a href="../consulta.php">Registrar Consulta</a></li>
    <li><a href="consultas_registradas.php">Consultas Marcadas</a></li>
    <li><a href="consultar_medicos.php">Consultar Médicos</a></li>
    
    <li><a href="../consultar.php">Cadastros</a></li>
    <li><a href="logout.php">Sair</a></li>
</ul>
    <h2>Pacientes Cadastrados</h2>
    <?php if (count($pacientes) > 0): ?>
        <table>
            <tr>
                
                <th>Nome</th>
                <th>Data de Nascimento</th>
                <th>Tipo Sanguíneo</th>
                <th>Imagem</th>
            </tr>
            <?php foreach ($pacientes as $p): ?>
                <tr>
                    
                    <td><?= htmlspecialchars($p['nome']) ?></td>
                    <td><?= date('d/m/Y', strtotime($p['data_nascimento'])) ?></td>
                    <td><?= htmlspecialchars($p['tipo_sanguineo']) ?></td>
                    <td>
                        <img src="<?= $p['path'] ? '../img/' . $p['path'] : '../img/profile.jpg' ?>" alt="Foto do paciente">
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php else: ?>
        <p>Nenhum paciente cadastrado.</p>
    <?php endif; ?>
</body>
</html>
