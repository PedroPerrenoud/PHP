<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Funcionário</title>
</head>
<body>

    <h1>Cadastrar Novo Funcionário</h1>
    
    <form action="./index.php?controller=funcionario&action=salvar" method="POST">
        <label for="nome">Nome:</label><br>
        <input type="text" id="nome" name="nome" required><br><br>

        <label for="cargo">Cargo:</label><br>
        <input type="text" id="cargo" name="cargo" required><br><br>
        
        <label for="senha">Salário:</label><br>
        <input type="number" id="salario" name="salario" required><br><br>

        <button type="submit">Salvar</button>
        <a href="./index.php">Cancelar</a>
    </form>

</body>
</html>