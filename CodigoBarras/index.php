<?php
  $mensagem = null;
  if (session_status() == PHP_SESSION_NONE) {
    session_start();
  }

  if( isset($_SESSION['mensagem']) ){
    $mensagem = $_SESSION['mensagem'];
    unset($_SESSION['mensagem']); // Limpa a sessão, deixando a mensagem livre
  }
?>

<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verificador de Código de Barras</title>
    <link rel="stylesheet" href="./src/output.css">
    <link rel="icon" type="image/x-icon" href="src/icons/icon-page.png">  
  </head>

  <body class="bg-background-light min-h-screen flex items-center justify-center p-4 font-sans">
    <div class="bg-white p-8 sm:p-10 rounded-xl shadow-2xl max-w-sm w-full transition duration-300 hover:shadow-primary/50">

      <h2 class="text-2xl font-bold text-primary mb-6 text-center border-b pb-3 border-tertiary">
        Insira o Código de Barras
      </h2>

      <form id="form-code" action="model_controller/CodeController.php" method="POST" class="space-y-4">  
        <label for="code-input" class="block text-sm font-medium text-primary">
            Código
        </label>
        <input 
          type="text" 
          name="code" 
          id="code-input"
          placeholder="1234567891234"
          class="w-full p-3 border-2 border-tertiary rounded-lg focus:outline-none focus:border-secondary transition duration-150 text-gray-700"
        >
      </form>

      <button 
        type="submit" 
        form="form-code"
        class="mt-6 w-full py-3 px-4 bg-primary text-white font-semibold rounded-lg shadow-md hover:bg-secondary focus:outline-none focus:ring-4 focus:ring-primary/50 transition duration-300 transform hover:scale-[1.02] "
      >
        Verificar
      </button>

      <?php if ($mensagem): ?>
        <?php
          // Define as classes de cor com base no tipo.
          // Nota: Mantenho a cor vermelha para erro (padrão de alerta), mas usamos sua paleta para sucesso.
          $bg_color = ($mensagem['tipo'] === 'sucesso') ? 'bg-secondary/20 border-secondary' : 'bg-red-100 border-red-400';
          $text_color = ($mensagem['tipo'] === 'sucesso') ? 'text-primary' : 'text-red-700';
        ?>

        <div class=" mt-6 p-3 border-l-4 rounded-md <?= $bg_color ?>">
          <p class="font-medium text-sm <?= $text_color ?>">
            <?= htmlspecialchars($mensagem['texto']) ?>
          </p>
        </div>
        
       <?php else: ?>
        
        <div class="text-center text-sm text-gray-500 py-3">
          Aguardando código...
        </div>
        
       <?php endif; ?>
    </div>

  </body>
</html>