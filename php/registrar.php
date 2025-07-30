<?php
include 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
   
    
    if (!empty ($_FILES['imagem'] ['name'])) {
        $extensao = pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION);
        $novoNome = uniqid() . '.' . $extensao;
        $caminho = __DIR__ . '/../img/' . $novoNome;
        // var_dump($_FILES['imagem']['tmp_name']);
        // var_dump($caminho);
        if(move_uploaded_file($_FILES['imagem']['tmp_name'], $caminho)){
            $stmt = $pdo -> prepare("INSERT INTO imagens (path) VALUES (?)");
            $stmt -> execute([$novoNome]);
            $imagem_id = $pdo -> lastInsertId();
        }
    }else{
        $imagem_id = null;
    }

    $sql = "INSERT INTO Usuario (nome, email, senha, imagem_id) VALUES (:nome, :email, :senha, :imagem_id)";
    $stmt = $pdo->prepare($sql);

    if ($stmt->execute([':nome' => $nome, ':email' => $email, ':senha' => $senha, ':imagem_id'=> $imagem_id])) {
        echo "Usuário registrado! <a href='../login.php'>Fazer login</a>";
    } else {
        $error = $stmt->errorInfo();
        echo "Erro: " . $error[2];
    }
}
?>
