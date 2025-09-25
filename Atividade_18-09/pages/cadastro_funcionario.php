<?php
    require_once __DIR__ . '/../config/session.php';
    require_once __DIR__ . '/../config/configPaths.php';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Funcionário</title>
    <link rel="stylesheet" href="../src/output.css">
</head>
<body class="bg-[#191825] flex items-center justify-center min-h-screen p-4">

  <div class="w-full max-w-md p-8 space-y-6 bg-[#1A1A1D] rounded-xl shadow-2xl shadow-[#7A1CAC]/30 border border-[#4F1C51]">
      
  <h1 class="text-3xl font-bold text-[#FEFBF6] text-center tracking-widest uppercase mb-6">
    Cadastrar <br><span class="text-[#7A1CAC]">_Funcionário_</span>
  </h1>
    
    <form action="<?= ROOT_PATH ?>index.php?controller=funcionario&action=salvar" method="POST" class="space-y-4">

      <div>
        <label for="nome" class="block text-sm font-medium text-[#FBF5E5] mb-1">Nome:</label>
        <input type="text" id="nome" name="nome" required
          class="w-full px-4 py-2 border-b-2 border-[#4F1C51] bg-transparent text-[#FEFBF6] placeholder-gray-500 focus:outline-none focus:border-[#7A1CAC] transition duration-300">
      </div>

      <div>
        <label for="cargo" class="block text-sm font-medium text-[#FBF5E5] mb-1">Cargo:</label>
        <input type="text" id="cargo" name="cargo" required
          class="w-full px-4 py-2 border-b-2 border-[#4F1C51] bg-transparent text-[#FEFBF6] placeholder-gray-500 focus:outline-none focus:border-[#7A1CAC] transition duration-300">
      </div>

      <div>
          <label for="salario" class="block text-sm font-medium text-[#FBF5E5] mb-1">Salário:</label>
          <input type="number" step="0.01" id="salario" name="salario" required
            class="w-full px-4 py-2 border-b-2 border-[#4F1C51] bg-transparent text-[#FEFBF6] placeholder-gray-500 focus:outline-none focus:border-[#7A1CAC] transition duration-300">
      </div>

      <div class="flex justify-between mt-6">
        <button type="submit"
            class="px-6 py-2 bg-[#7A1CAC] text-[#FEFBF6] font-bold uppercase rounded-md hover:bg-[#4F1C51] transition duration-300 shadow-lg shadow-[#7A1CAC]/50">
          Salvar
        </button>
        <a href="<?= PAGES_PATH ?>dashboard.php"
          class="px-6 py-2 bg-gray-700 text-[#FEFBF6] font-bold uppercase rounded-md hover:bg-gray-600 transition duration-300 shadow-md">
          Cancelar
        </a>
      </div>
    </form>

  </div>

</body>
</html>
