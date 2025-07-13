<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Cadastro de Médicos</title>
</head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<body>
    <nav>
        <a href="index.php">Página Inicial</a>
        <a href="paciente.php">Cadastro de Pacientes</a>
        <a href="consulta.php">Registrar Consulta</a>
        <a href="php/consultas_registradas.php">Consultas Marcadas</a>
        <a href="consultar.php">Cadastros</a>
        <a href="logout.php">Sair</a>
    </nav>
    <?php include 'php/protege.php'; ?>
    <h2>Cadastrar Médico</h2>
    <form method="POST" action="php/medico.php">
        Nome: <input type="text" name="nome" required><br>
        Especialidade: <input type="text" name="especialidade" required><br>
        <input type="submit" value="Cadastrar">
    </form>
</body>

</html>