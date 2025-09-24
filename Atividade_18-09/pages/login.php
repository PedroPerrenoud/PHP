
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
</head>
<body>
  <form action="../index.php?controller=user&action=login" method="POST">
    Email: <input type="text" name="user_email"><br>
    Senha: <input type="password" name="user_passwd"><br>
    <button type="submit"> Entrar </button>
  </form>
</body>
</html>