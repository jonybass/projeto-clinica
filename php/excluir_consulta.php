<?php
include 'protege.php';
include 'conexao.php';

if (isset($_GET['id_medico'], $_GET['id_paciente'], $_GET['data_hora'])) {
    $stmt = $pdo->prepare("DELETE FROM Consulta WHERE id_medico = :id_medico AND id_paciente = :id_paciente AND data_hora = :data_hora");
    $stmt->execute([
        ':id_medico' => $_GET['id_medico'],
        ':id_paciente' => $_GET['id_paciente'],
        ':data_hora' => $_GET['data_hora']
    ]);
}

header("Location: consultas_registradas.php");
exit;
