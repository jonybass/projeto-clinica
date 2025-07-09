<?php include 'conexao.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
$nome = $_POST["nome"];
$especialidade = $_POST["especialidade"];
$sql = "INSERT INTO Medico (nome, especialidade) VALUES ('$nome', '$especialidade')";
if ($conexao->query($sql)) { echo "Médico cadastrado!"; } else { echo "Erro: " . $conexao->error; }
} ?>