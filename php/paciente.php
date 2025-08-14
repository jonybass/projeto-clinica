<?php
include 'conexao.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST["nome"];
    $data = $_POST["data_nascimento"];
    $tipo = $_POST["tipo_sanguineo"];

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

    // Inserir paciente com imagem
    $sql = "INSERT INTO Paciente (nome, data_nascimento, tipo_sanguineo, imagem_id) 
            VALUES (:nome, :data_nascimento, :tipo_sanguineo, :imagem_id)";
    $stmt = $pdo->prepare($sql);

    if ($stmt->execute([
        ':nome' => $nome,
        ':data_nascimento' => $data,
        ':tipo_sanguineo' => $tipo,
        ':imagem_id' => $imagem_id
    ])) {
        echo "Paciente cadastrado com sucesso!";
    } else {
        $error = $stmt->errorInfo();
        echo "Erro: " . $error[2];
    }
}
?>
