<?php
session_start();

if (!isset($_SESSION['id_usuario_logado'])) {
    header("Location: login.php");
    exit;
}


include 'php/conexao.php';







$id =  $_SESSION['id_usuario_logado'];

$stmt = $pdo->prepare("SELECT usuario.*, imagens.path  
                    FROM usuario 
                    LEFT JOIN imagens ON usuario.imagem_id = imagens.id                     
                    WHERE usuario.id = ?");
$stmt->execute([$id]);
$usuario = $stmt->fetch(PDO::FETCH_ASSOC);

// Definir imagem padrão se não houver imagem associada

if ($usuario['path']) {
    $imagemPath = 'img/' . $usuario['path'];
} else {
    $imagemPath = 'img/profile.jpg'; // Imagem padrão
}
// var_dump($imagemPath);
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit;
}


?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Clínica - Início</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>Bem-vindo à Clínica</h1>
    <p>Usuário logado: <?php echo htmlspecialchars($_SESSION['usuario']) , $_SESSION['id_usuario_logado']; ?></p>
    <img src="<?= htmlspecialchars($imagemPath) ?>" alt="Imagem de Perfil" style="width: 150px; height: 150px;">

    

   <ul>
    <li><a href="medico.php">Cadastro de Médicos</a></li>
    <li><a href="paciente.php">Cadastro de Pacientes</a></li>
    <li><a href="consulta.php">Registrar Consulta</a></li>
    <li><a href="php/consultas_registradas.php">Consultas Marcadas</a></li>
    <li><a href="php/consultar_medicos.php">Consultar Médicos</a></li>
    <li><a href="php/consultar_pacientes.php">Consultar Pacientes</a></li>
    <li><a href="consultar.php">Cadastros</a></li>
    <li><a href="logout.php">Sair</a></li>
</ul>

</body>
</html>
