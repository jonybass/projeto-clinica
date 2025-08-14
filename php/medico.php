<?php
include 'conexao.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST["nome"];
    $especialidade = $_POST["especialidade"];

    // Tratamento da imagem
    if (!empty($_FILES['imagem']['name'])) {
        $extensao = pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION);
        $novoNome = uniqid() . '.' . $extensao;
        $caminho = __DIR__ . '/../img/' . $novoNome;

        if (move_uploaded_file($_FILES['imagem']['tmp_name'], $caminho)) {
            $stmt = $pdo->prepare("INSERT INTO imagens (path) VALUES (?)");
            $stmt->execute([$novoNome]);
            $imagem_id = $pdo->lastInsertId();
        } else {
            $imagem_id = null;
        }
    } else {
        $imagem_id = null;
    }

    // Inserir médico com imagem
    $sql = "INSERT INTO Medico (nome, especialidade, imagem_id) 
            VALUES (:nome, :especialidade, :imagem_id)";
    $stmt = $pdo->prepare($sql);

    if ($stmt->execute([
        ':nome' => $nome,
        ':especialidade' => $especialidade,
        ':imagem_id' => $imagem_id
    ])) {
        echo "<script>alert('Médico cadastrado!'); window.location.href = '../medico.php';</script>";
    } else {
        $error = $stmt->errorInfo();
        echo "<script>alert('Erro: " . addslashes($error[2]) . "'); window.location.href = '../medico.php';</script>";
    }
}
?>
