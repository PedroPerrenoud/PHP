<?php
  require_once __DIR__ . '/../config/session.php';
  require_once __DIR__ . '/../config/configPaths.php';
  require_once __DIR__ . '/../models/Funcionario.php';

  class FuncionarioController{

    //Traz uma lista com todos os funcionários.
    public static function listar(){
      //Include permite passar uma variável para o arquivo em seu include
      include __DIR__ . '/../pages/dashboard.php';
    }
    
    public function excluir() {
      // Pega o ID do funcionário da URL
      $id = $_GET['id'] ?? null;
      if ($id) {
        // Chama um método no seu modelo para excluir o funcionário
        Funcionario::deletar($id);
      }

      // Redireciona de volta para a lista de funcionários
      header("Location: " . ROOT_PATH ."index.php?controller=funcionario&action=listar");
      exit();
    }

    public function atualizar(){
      $id = $_POST['id'] ?? '';
      $nome = $_POST['nome'] ?? '';
      $cargo = $_POST['cargo'] ?? '';
      $salario = $_POST['salario'] ?? '';

      $funcionario = new Funcionario();
      if( $id ){
        $funcionario->setId($id);
      } else {
        $_SESSION['mensagem'] = [
          'tipo' => 'erro',
          'texto' => 'ERRO: Id inexistente'
        ];
        header("Location: " . ROOT_PATH ."index.php?controller=funcionario&action=listar&status=error");
        exit();
      }


      $funcionario->setNome($nome);
      $funcionario->setCargo($cargo);
      $funcionario->setSalario($salario);
      
      // Chama o método de atualização do modelo
      $sucesso = $funcionario->atualizar();

      // Redireciona de volta para a lista, com uma mensagem de sucesso ou erro (opcional)
      if ($sucesso) {
        $_SESSION['mensagem'] = [
          'tipo'  => 'sucesso',
          'texto' => 'Funcionário atualizado com sucesso'
        ];
        header("Location: " . ROOT_PATH ."index.php");

      } else {
        $_SESSION['mensagem'] = [
          'tipo'  => 'erro',
          'texto' => 'ERRO: Falha ao adicionar funcionario'
        ];
        header("Location: " . ROOT_PATH ."index.php?controller=funcionario&action=listar&status=error");
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
        header("Location: " . ROOT_PATH ."index.php");
      } else{
        $_SESSION['mensagem'] = [
          'tipo'  => 'erro',
          'texto' => 'Erro ao tentar cadastrar funcionário'
        ];
        header("Location: " . ROOT_PATH ."index.php");
      }
    }

    public function cadastrar(){
      include __DIR__ . "/../pages/cadastro_funcionario.php";
    }

    public function editar(){
      $id = $_GET['id'] ?? null;
      if (!$id) {
        $_SESSION['mensagem'] = [
          'tipo' => 'erro',
          'texto' => 'ERRO: Id Nullo!'
        ];
        header("Location: " . ROOT_PATH ."index.php?controller=funcionario&action=listar");
        exit();
      }

      $funcionario = Funcionario::buscarPorId($id);
      if ($funcionario) {
        include  __DIR__ . '/../pages/editar_funcionario.php';
      }
    }
  }
?>