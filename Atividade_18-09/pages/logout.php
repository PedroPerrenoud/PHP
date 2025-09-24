<?php
  // Destrói a sessão;
  session_destroy();

  // Redireciona para a página de login ou para a home;
  header('Location: login.php');
  exit();
?>