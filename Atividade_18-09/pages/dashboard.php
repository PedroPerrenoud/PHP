<?php
  require_once __DIR__ . '/../config/session.php';
  require_once __DIR__ . '/../config/configPaths.php';
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
  <title>Dashboard - Gestão de Funcionários</title>
  <link rel="stylesheet" href="../src/output.css">
</head>
<body class="bg-[#191825] min-h-screen p-6 text-[#FEFBF6]">

  <div class="max-w-6xl mx-auto">

    <h1 class="text-4xl font-bold text-center tracking-widest mb-8 uppercase">
        Dashboard <br><span class="text-[#7A1CAC]">_Funcionários_</span>
    </h1>

    <a href="<?= ROOT_PATH ?>index.php?controller=funcionario&action=cadastrar" 
        class="inline-block mb-6 px-5 py-3 bg-[#7A1CAC] text-[#FEFBF6] font-bold rounded-md shadow-lg shadow-[#7A1CAC]/50 hover:bg-[#4F1C51] transition duration-300">
        Cadastrar Novo Funcionário
    </a>

    <div class="overflow-x-auto">
      <table class="w-full text-left border-collapse shadow-md border border-[#4F1C51]">
        <thead class="bg-[#1A1A1D]">
            <tr>
                <th class="px-4 py-2 border-b border-[#4F1C51]">ID</th>
                <th class="px-4 py-2 border-b border-[#4F1C51]">Nome</th>
                <th class="px-4 py-2 border-b border-[#4F1C51]">Cargo</th>
                <th class="px-4 py-2 border-b border-[#4F1C51]">Salário</th>
                <th class="px-4 py-2 border-b border-[#4F1C51]">Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($funcionarios)): ?>
              <?php foreach ($funcionarios as $funcionario): ?>
                <tr class="hover:bg-[#2A2A2D] transition duration-200">
                  <td class="px-4 py-2 border-b border-[#4F1C51]"><?= htmlspecialchars($funcionario->getId()) ?></td>
                  <td class="px-4 py-2 border-b border-[#4F1C51]"><?= htmlspecialchars($funcionario->getNome()) ?></td>
                  <td class="px-4 py-2 border-b border-[#4F1C51]"><?= htmlspecialchars($funcionario->getCargo()) ?></td>
                  <td class="px-4 py-2 border-b border-[#4F1C51]">R$<?= htmlspecialchars(number_format($funcionario->getSalario(), 2, ',', '.')) ?></td>
                  <td class="px-4 py-2 border-b border-[#4F1C51] flex space-x-2">
                    <a href="<?= ROOT_PATH ?>index.php?controller=funcionario&action=editar&id=<?= $funcionario->getId() ?>"
                      class="px-3 py-1 bg-[#7A1CAC] text-[#FEFBF6] rounded text-white font-semibold hover:bg-[#F7374F] transition duration-300">
                      Editar
                    </a>
                    <a href="<?= ROOT_PATH ?>index.php?controller=funcionario&action=excluir&id=<?= $funcionario->getId() ?>"
                      onclick="return confirm('Tem certeza que deseja excluir?');"
                      class="px-3 py-1 bg-[#F44336] rounded text-white font-semibold hover:bg-[#D32F2F] transition duration-300">
                      Excluir
                    </a>
                  </td>
                </tr>
              <?php endforeach; ?>
          <?php else: ?>
              <tr>
                  <td colspan="5" class="px-4 py-6 text-center text-gray-400">Nenhum funcionário encontrado.</td>
              </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>

  </div>
</body>
</html>
