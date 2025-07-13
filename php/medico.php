<?php
include 'conexao.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST["nome"];
    $especialidade = $_POST["especialidade"];

    $sql = "INSERT INTO Medico (nome, especialidade) VALUES (:nome, :especialidade)";
    $stmt = $pdo->prepare($sql);

    if ($stmt->execute([':nome' => $nome, ':especialidade' => $especialidade])) {
        echo "<script>alert('Médico cadastrado!'); window.location.href = '../medico.php';</script>";
    } else {
        $error = $stmt->errorInfo();
        echo "<script>alert('Erro: " . addslashes($error[2]) . "'); window.location.href = '../medico.php';</script>";
    }
}
?>
