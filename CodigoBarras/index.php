

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Verificador de código de barras</title>
</head>
<body>
  <div>
    <h2> Insira o código de barras</h2>
    <form action="model_controller/CodeController.php" method="POST">
      Código
      <input type="text" name="code" placeholder="1 2 3 4 5 6">
    </form>
    <button type="submit">
      Verificar
    </button>
  </div>
</body>
</html>