<?php
include 'conexao.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $m = $_POST["id_medico"];
    $p = $_POST["id_paciente"];
    $d = $_POST["data_hora"];
    $o = $_POST["observacoes"];

    try {
        $sql = "INSERT INTO Consulta (id_medico, id_paciente, data_hora, observacoes)
                VALUES (:medico, :paciente, :data, :obs)";
        
        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(':medico', $m, PDO::PARAM_INT);
        $stmt->bindParam(':paciente', $p, PDO::PARAM_INT);
        $stmt->bindParam(':data', $d);
        $stmt->bindParam(':obs', $o);

        $stmt->execute();

        echo "Consulta registrada!";
    } catch (PDOException $e) {
        echo "Erro: " . $e->getMessage();
    }
}
?>
