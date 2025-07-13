<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Cadastro de Pacientes</title>
</head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<body>
    <nav>
        <a href="medico.php">Cadastro de Médicos</a>
        <a href="index.php">Página Inicial</a>
        <a href="consulta.php">Registrar Consulta</a>
        <a href="php/consultas_registradas.php">Consultas Marcadas</a>
        <a href="consultar.php">Cadastros</a>
        <a href="logout.php">Sair</a>
    </nav>
    <?php include 'php/protege.php'; ?>
    <h2>Cadastrar Paciente</h2>
    <form method="POST" action="php/paciente.php">
        Nome: <input type="text" name="nome" required><br>
        Data de Nascimento: <input type="date" name="data_nascimento" required><br>
        Tipo Sanguíneo: <input type="text" name="tipo_sanguineo" required><br>
        <input type="submit" value="Cadastrar">
    </form>
</body>

</html>