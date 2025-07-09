<?php

include 'conexao.php';
include 'protege.php';


$sql = "SELECT * FROM Medico";
$result = $conexao->query($sql);

if ($result->num_rows > 0) {
    echo "<table border='1'>
            <tr><th>ID</th><th>Nome</th><th>Especialidade</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['id']}</td>
                <td>{$row['nome']}</td>
                <td>{$row['especialidade']}</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "Nenhum médico cadastrado.";
}
?>
