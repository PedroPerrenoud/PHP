<?php
  session_start();

  echo "Caminho atual do save_path: <br>";
  echo session_save_path();

  // Teste simples de gravação
  $_SESSION['teste'] = "Funcionando!";
  echo "<br><br>Conteúdo da sessão: <br>";
  var_dump($_SESSION);
?>