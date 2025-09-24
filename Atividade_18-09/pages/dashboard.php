<?php
  require_once __DIR__ . '/../controllers/session_verify.php';
  require_once __DIR__ . '/../models/Funcionario.php';
  $funcionarios = Funcionario::buscarTodos();
  //Verifica a existência de mensagens
  if( isset($_SESSION['mensagem'])){
    $mensagem = $_SESSION['mensagem'];
    
    echo "<script>";
    if( $mensagem['tipo'] === 'sucesso'){
      echo "alert('Sucesso: " . addslashes($mensagem['texto']) . "');";
    } else {
      echo "alert('ERRO: " . addslashes($mensagem['texto']) . "');";
    }
    echo "</script";

    unset($_SESSION['mensagem']); //Limpa a sessão
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DASHBOARD</title>
     <style>
        body { font-family: sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ccc; padding: 10px; text-align: left; }
        th { background-color: #f2f2f2; }
        .acoes a { margin-right: 10px; text-decoration: none; padding: 5px 10px; border-radius: 3px; }
        .editar { background-color: #2196F3; color: white; }
        .excluir { background-color: #F44336; color: white; }
        .cadastrar-btn { margin-top: 20px; padding: 10px 15px; background-color: #4CAF50; color: white; text-decoration: none; border-radius: 5px; }
    </style>
</head>
<body>
  <h1>Gestão de Funcionários</h1>

    <a href="../index.php?controller=funcionario&action=cadastrar" class="cadastrar-btn">Cadastrar Novo Funcionário</a>

    <table>
      <thead>
        <tr>
          <th>ID</th>
          <th>Nome</th>
          <th>Cargo</th>
          <th>Salário</th>
          <th>Ações</th>
        </tr>
      </thead>
      <tbody>
          <?php
          // Verifica se a variável $funcionarios foi passada e se não está vazia
          if (!empty($funcionarios)) {
              // Itera sobre cada funcionário para criar uma linha na tabela
              foreach ($funcionarios as $funcionario) {
                  echo "<tr>";
                  echo "<td>" . htmlspecialchars($funcionario->getId()) . "</td>";
                  echo "<td>" . htmlspecialchars($funcionario->getNome()) . "</td>";
                  echo "<td>" . htmlspecialchars($funcionario->getCargo()) . "</td>";
                  echo "<td>R$" . htmlspecialchars(number_format($funcionario->getSalario(), 2, ',', '.')) . "</td>";
                  echo "<td class='acoes'>";
                  // Botões de ação, que apontam para os endpoints do seu controlador
                  echo "<a href='../index.php?controller=funcionario&action=editar&id=" . $funcionario->getId() . "' class='editar'>Editar</a>";
                  echo "<a href='../index.php?controller=funcionario&action=excluir&id=" . $funcionario->getId() . "' class='excluir' onclick='return confirm(\"Tem certeza que deseja excluir?\");'>Excluir</a>";
                  echo "</td>";
                  echo "</tr>";
              }
          } else {
              echo "<tr><td colspan='4'>Nenhum funcionário encontrado.</td></tr>";
          }
          ?>
      </tbody>
    </table>
</body>
</html>