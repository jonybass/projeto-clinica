<?php include 'conexao.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
$nome = $_POST["nome"];
$data = $_POST["data_nascimento"];
$tipo = $_POST["tipo_sanguineo"];
$sql = "INSERT INTO Paciente (nome, data_nascimento, tipo_sanguineo) VALUES ('$nome', '$data', '$tipo')";
if ($conexao->query($sql)) { echo "Paciente cadastrado!"; } else { echo "Erro: " . $conexao->error; }
} ?>