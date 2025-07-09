<?php include 'conexao.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
$m = $_POST["id_medico"];
$p = $_POST["id_paciente"];
$d = $_POST["data_hora"];
$o = $_POST["observacoes"];
$sql = "INSERT INTO Consulta (id_medico, id_paciente, data_hora, observacoes) VALUES ('$m', '$p', '$d', '$o')";
if ($conexao->query($sql)) { echo "Consulta registrada!"; } else { echo "Erro: " . $conexao->error; }
} ?>