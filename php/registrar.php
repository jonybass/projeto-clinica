<?php
include 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO Usuario (nome, email, senha) VALUES (:nome, :email, :senha)";
    $stmt = $pdo->prepare($sql);

    if ($stmt->execute([':nome' => $nome, ':email' => $email, ':senha' => $senha])) {
        echo "Usuário registrado! <a href='../login.html'>Fazer login</a>";
    } else {
        $error = $stmt->errorInfo();
        echo "Erro: " . $error[2];
    }
}
?>
