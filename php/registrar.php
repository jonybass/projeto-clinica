<?php
include 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO Usuario (nome, email, senha) VALUES ('$nome', '$email', '$senha')";
    if ($conexao->query($sql)) {
        echo "Usuário registrado! <a href='../login.html'>Fazer login</a>";
    } else {
        echo "Erro: " . $conexao->error;
    }
}
?>