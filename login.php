<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>
    <form method="POST" action="php/login.php">
        Email: <input type="email" name="email" required><br>
        Senha: <input type="password" name="senha" required><br>
        <input type="submit" value="Entrar">
    </form>
    <p><a href="registrar.php">Registrar novo usuário</a></p>
</body>
</html>