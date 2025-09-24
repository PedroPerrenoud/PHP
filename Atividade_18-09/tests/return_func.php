<?php
  // Inclui o arquivo da sua classe de conexão
  // Certifique-se de que o caminho está correto
  require_once __DIR__ . '/../Conexao.php';
  require_once __DIR__ . '/../models/Usuario.php';
  require_once __DIR__ . '/../models/Funcionario.php';

  try {
      // Tenta obter uma conexão usando a sua classe
      $conn = Conexao::getConexao();

      // Se o código chegou até aqui, a conexão foi bem-sucedida
      echo "Conexão com o banco de dados estabelecida com sucesso!";

  } catch (PDOException $e) {
      // Se ocorrer um erro, exibe a mensagem de erro
      echo "Erro ao conectar com o banco de dados: " . $e->getMessage();
  }

  echo "<br>";
  echo "<br>";

  $funcionarios = Funcionario::buscarTodos();
  print_r($funcionarios);  
?>