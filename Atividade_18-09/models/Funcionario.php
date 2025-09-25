<?php
  require_once __DIR__ . '/../Conexao.php';
  require_once __DIR__ . '/../config/session.php';

  class Funcionario{
    private $id;
    private $nome;
    private $cargo;
    private $salario;
    private $db;

    public function __construct(){
      $this->db = Conexao::getConexao();
    }

    public function getId(){ return $this->id; }
    public function setId(int $id){ $this->id = $id; }

    public function getNome(){ return $this->nome; }
    public function setNome(string $nome){ $this->nome = $nome; }

    public function getCargo(){ return $this->cargo; }
    public function setCargo(string $cargo){ $this->cargo = $cargo; }

    public function getSalario(){ return $this->salario; }
    public function setSalario(float $salario){ $this->salario = $salario; }

    public function salvar() : bool {
      try{
        $sql_insert = "INSERT INTO funcionarios (nome, cargo, salario) VALUES (:nome, :cargo, :salario)";
        $stmt_insert = $this->db->prepare($sql_insert);
        
        $stmt_insert->bindValue( ':nome', $this->nome );
        $stmt_insert->bindValue( ':cargo', $this->cargo );
        $stmt_insert->bindValue( ':salario', $this->salario );

        return $stmt_insert->execute(); //Se funcionar, retorna true;
      } catch( PDOException $e ){
        return false;
      }
    }

    public function atualizar() : bool {
      $db = Conexao::getConexao();
      $sql_update = "UPDATE funcionarios SET nome = :nome, cargo = :cargo, salario = :salario WHERE id = :id";
      
      try{
        $stmt_update = $db->prepare($sql_update);
        $stmt_update->bindValue(':id', $this->id );
        $stmt_update->bindValue(':nome', $this->nome );
        $stmt_update->bindValue(':cargo', $this->cargo );
        $stmt_update->bindValue(':salario', $this->salario );
        
        return $stmt_update->execute();

      } catch( PDOException $e ){
        return false;
      }
    }

    public static function deletar($id) : bool {
      $sql_delete = "DELETE FROM funcionarios WHERE id = :id";
      $db = Conexao::getConexao();

      try{
        $stmt_delete = $db->prepare($sql_delete);
        $stmt_delete->bindValue(':id', $id );
        
        return $stmt_delete->execute();
        
      } catch(PDOException $e){
        return false;
      }
    }

    public static function buscarPorId($id) : ? Funcionario {
      $sql_searchId = "SELECT * FROM funcionarios WHERE id = :id";
      $db = Conexao::getConexao();

      try{
        $stmt_searchId = $db->prepare($sql_searchId);
        $stmt_searchId->bindValue(':id', $id );
        $stmt_searchId->execute();

        $stmt_searchId->setFetchMode(PDO::FETCH_CLASS, 'Funcionario'); //Define o modo como será trago o conteúdo do Banco
        //PDO::FETCH_CLASS = Esta é uma constante do PDO que informa "eu quero que você me retorne uma nova instância de uma classe";
        //'Funcionarios' = A classe que queremos ter instanciada;

        $funcionario = $stmt_searchId->fetch();
        //O método fetch() é quem realmente "pega" uma linha do resultado da consulta que está no banco de dados.
        //Já executamos a consulta e já decidimos qual será a classe que quero retornar, então fetch pega os dados e transforma em uma instância da classe.

        // Isso substitui no código o que geralmente é feito:
        // $dados = $stmt->fetch(PDO::FETCH_ASSOC);
        // $funcionario = new Funcionario();
        // $funcionario->id = $dados['id'];
        // $funcionario->nome = $dados['nome'];

        return ($funcionario !== false) ? $funcionario : null;
      
      }catch(PDOException $e){
        return null;
      }
    }

    public static function buscarTodos() : array {
      $db = Conexao::getConexao();
      $sql_searchAll = "SELECT * FROM funcionarios";

      try{
        $stmt_searchAll = $db->prepare( $sql_searchAll );
        $stmt_searchAll->execute();

        $stmt_searchAll->setFetchMode(PDO::FETCH_CLASS, 'Funcionario');
        $funcionarios = $stmt_searchAll->fetchAll();
        return $funcionarios;

      } catch(PDOException $e){
        return [];
      }
    }

  }
?>