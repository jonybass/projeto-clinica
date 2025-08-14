<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Registrar</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h2>Registrar Novo Usuário</h2>
    <form method="POST" action="php/registrar.php"  enctype="multipart/form-data">

        Nome: <input type="text" name="nome" required><br>

        Email: <input type="email" name="email" required><br>

        Senha: <input type="password" name="senha" required><br>

        imagem:<input type="file" id="imagem" name="imagem" accept="image/*">


        <input type="submit" value="Registrar">
    </form>
</body>
</html>
