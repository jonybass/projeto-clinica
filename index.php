<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: login.html");
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Clínica - Início</title>
</head>
<body>
    <h1>Bem-vindo à Clínica</h1>
    <p>Usuário logado: <?php echo $_SESSION['usuario']; ?></p>
    <ul>
        <li><a href="medico.html">Cadastro de Médicos</a></li>
        <li><a href="paciente.html">Cadastro de Pacientes</a></li>
        <li><a href="consulta.php">Registrar Consulta</a></li>
        <li><a href='php/consultas_registradas.php'>Consultas Realizadas</a></li>
        <li><a href="consultar.php">Cadastros</a></li>
        <li><a href="logout.php">Sair</a></li>
    </ul>
</body>
</html>