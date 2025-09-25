<?php
    require_once __DIR__ . '/../config/session.php';
    require_once __DIR__ . '/../config/configPaths.php';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Funcionário</title>
</head>
<body>

    <h1>Editar Funcionário</h1>
    
    <form action="<?= ROOT_PATH ?>index.php?controller=funcionario&action=atualizar" method="POST">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($funcionario->getId()); ?>">
        
        <label for="nome">Nome:</label><br>
        <input type="text" id="nome" name="nome" value="<?php echo htmlspecialchars($funcionario->getNome()); ?>" required><br><br>

        <label for="cargo">Cargo:</label><br>
        <input type="text" id="cargo" name="cargo" value="<?php echo htmlspecialchars($funcionario->getCargo()); ?>" required><br><br>
        
        <label for="salario">Salário:</label><br>
        <input type="number" id="salario" name="salario" value="<?php echo htmlspecialchars($funcionario->getSalario()); ?>" required><br><br>
        
        <button type="submit">Salvar Alterações</button>
        <a href="<?= ROOT_PATH ?>index.php?controller=funcionario&action=listar">Cancelar</a>
    </form>

</body>
</html>