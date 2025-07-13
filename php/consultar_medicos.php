<?php

try {
    $sql = "SELECT * FROM Medico";
    $stmt = $pdo->query($sql); 

    $medicos = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (count($medicos) > 0) {
        echo "<table border='1'>
                <tr><th>ID</th><th>Nome</th><th>Especialidade</th></tr>";
        foreach ($medicos as $row) {
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
} catch (PDOException $e) {
    echo "Erro: " . $e->getMessage();
}
?>
