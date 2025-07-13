<?php
include 'conexao.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST["nome"];
    $data = $_POST["data_nascimento"];
    $tipo = $_POST["tipo_sanguineo"];

    $sql = "INSERT INTO Paciente (nome, data_nascimento, tipo_sanguineo) VALUES (:nome, :data_nascimento, :tipo_sanguineo)";
    $stmt = $pdo->prepare($sql);

    if ($stmt->execute([
        ':nome' => $nome,
        ':data_nascimento' => $data,
        ':tipo_sanguineo' => $tipo
    ])) {
        echo "Paciente cadastrado!";
    } else {
        $error = $stmt->errorInfo();
        echo "Erro: " . $error[2];
    }
}
?>
