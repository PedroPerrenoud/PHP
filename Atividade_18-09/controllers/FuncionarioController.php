<?php
  require_once __DIR__ . '/../models/Funcionario.php';
  class FuncionarioController{

    //Traz uma lista com todos os funcionários.
    public static function listar(){
      //Include permite passar uma variável para o arquivo em seu include
      include __DIR__ . '/../pages/dashboard.php';
    }

    public function editar(){
      // Pega o ID do funcionário da URL
      $id = $_GET['id'] ?? null;
      if (!$id) {
        // Redireciona de volta para a lista se o ID não for fornecido
        header("Location: index.php?controller=funcionario&action=listar");
        exit();
      }

    // Busca o funcionário pelo ID usando seu modelo
      $funcionario = Funcionario::buscarPorId($id);

      // Se o funcionário for encontrado, inclua a página do formulário
      if ($funcionario) {
          // Você precisará de um arquivo pages/editar_funcionario.php
          include __DIR__ . '/../pages/editar_funcionario.php';
      } else {
          // Redireciona se o funcionário não for encontrado
          header("Location: index.php?controller=funcionario&action=listar");
          exit();
      }
    }
    
    public function excluir() {
      // Pega o ID do funcionário da URL
      $id = $_GET['id'] ?? null;
      if ($id) {
        // Chama um método no seu modelo para excluir o funcionário
        Funcionario::deletar($id);
      }

      // Redireciona de volta para a lista de funcionários
      header("Location: index.php?controller=funcionario&action=listar");
      exit();
    }

    public function atualizar(){
    // Pega os dados do formulário
    $nome = $_POST['nome'] ?? '';
    $cargo = $_POST['cargo'] ?? '';
    $salario = $_POST['salario'] ?? '';

    // Instancia um objeto Funcionario
    $funcionario = new Funcionario();
    
    // Define os demais dados que serão atualizados
    $funcionario->setNome($nome);
    $funcionario->setCargo($cargo);
    $funcionario->setSalario($salario);
    
    // Chama o método de atualização do modelo
    $sucesso = $funcionario->atualizar();

    // Redireciona de volta para a lista, com uma mensagem de sucesso ou erro (opcional)
    if ($sucesso) {
      // Redireciona com um parâmetro para mostrar que a atualização foi bem-sucedida
      header("Location: index.php");
    } else {
      // Redireciona com um parâmetro de erro
      header("Location: index.php?controller=funcionario&action=listar&status=error");
    }
    exit();
  }

    public function salvar(){
      $nome = $_POST['nome'] ?? '';
      $cargo = $_POST['cargo'] ?? '';
      $salario = $_POST['salario'] ?? '';

      $newFunc = new Funcionario();

      $newFunc->setNome($nome);
      $newFunc->setCargo($cargo);
      $newFunc->setSalario($salario);

      $success = $newFunc->salvar();
      if( $success ){
        $_SESSION['mensagem'] = [
          'tipo'  => 'sucesso',
          'texto' => 'Funcionário salvo com sucesso'
        ];
        header("Location: index.php");
      } else{
        $_SESSION['mensagem'] = [
          'tipo'  => 'erro',
          'texto' => 'Erro ao tentar cadastrar funcionário'
        ];
        header("Location: index.php");
      }
    }

    public function cadastrar(){
      include __DIR__ . "/../pages/cadastro_funcionario.php";
    }
  }
?>