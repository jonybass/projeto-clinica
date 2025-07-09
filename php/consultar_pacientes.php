<?php
include 'conexao.php';
include 'protege.php';

$sql = "SELECT * FROM Paciente";
$result = $conexao->query($sql);

if ($result->num_rows > 0) {
    echo "<table border='1'>
            <tr><th>ID</th><th>Nome</th><th>Data de Nascimento</th><th>Tipo Sanguíneo</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['id']}</td>
                <td>{$row['nome']}</td>
                <td>{$row['data_nascimento']}</td>
                <td>{$row['tipo_sanguineo']}</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "Nenhum paciente cadastrado.";
}
?>
