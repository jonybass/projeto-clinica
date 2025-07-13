<?php
include 'protege.php';
include 'conexao.php';

if (isset($_GET['id'])) {
    $stmt = $pdo->prepare("DELETE FROM Medico WHERE id = :id");
    $stmt->execute([':id' => $_GET['id']]);
}

header("Location: ../consultar.php");
exit;
