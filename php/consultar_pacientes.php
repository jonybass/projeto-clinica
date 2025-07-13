<?php



try {
    $sql = "SELECT * FROM Paciente";
    $stmt = $pdo->query($sql); 

    $pacientes = $stmt->fetchAll(PDO::FETCH_ASSOC); 

    if (count($pacientes) > 0) {
        echo "<table border='1'>
                <tr><th>ID</th><th>Nome</th><th>Data de Nascimento</th><th>Tipo Sanguíneo</th></tr>";
        foreach ($pacientes as $row) {
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
} catch (PDOException $e) {
    echo "Erro: " . $e->getMessage();
}
?>
