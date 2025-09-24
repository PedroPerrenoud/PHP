<?php
  class Projeto{
    private $id;
    private $nome;
    private $descricao;
    private $estatus;
    private $db;

    public function __construct(
      string $nome = '',
      string $descricao = '',
      string $estatus = ''
    )
    {
      $this->nome = $nome;
      $this->descricao = $descricao;
      $this->estatus = $estatus;
      $this->db = Conexao::getConexao();
    }

    
    public function getNome(){ return $this->nome; }
    public function setNome(string $nome){ $this->nome = $nome; }

    public function getDescricao(){ return $this->descricao; }
    public function setDescricao(string $descricao){ $this->descricao = $descricao; }

    public function getStatus(){ return $this->estatus; }
    public function setStatus(string $estatus){ $this->estatus = $estatus; }

    public function salvar() : bool {
      try{
        $sql_verify = "SELECT from projeto WHERE nome = :nome"; 
        $stmt_verify = $this->db->prepare($sql_verify); 
        $stmt_verify->bindValue( ':nome', $this->nome ); 
        $stmt_verify->execute();

        if($stmt_verify->rowCount() > 0){
          return false;
        }

        $sql_insert = "INSERT INTO projetos (nome, descricao, estatus) VALUES (:nome, :descricao, :estatus)";
        $stmt_insert = $this->db->prepare($sql_insert);
        
        $stmt_insert->bindValue( ':nome', $this->nome );
        $stmt_insert->bindValue( ':descricao', $this->descricao );
        $stmt_insert->bindValue( ':estatus', $this->estatus );

        return $stmt_insert->execute(); //Se funcionar, retorna true;
      } catch( PDOException $e ){
        return false;
      }
    }

    public function atualizar() : bool {
      
      try{
        $sql_update = "UPDATE projetos SET nome = :nome, descricao = :descricao estatus = :estatus WHERE id = :id";

        $stmt_update = $this->db->prepare($sql_update);
        $stmt_update->bindValue(':nome', $this->nome );
        $stmt_update->bindValue(':descricao', $this->descricao );
        $stmt_update->bindValue(':estatus', $this->estatus );
        $stmt_update->bindValue(':id', $this->id );

        return $stmt_update->execute();

      } catch( PDOException $e ){
        return false;
      }
    }

    public function deletar() : bool {
      $sql_delete = "DELETE FROM projetos WHERE id = :id";

      try{
        $stmt_delete = $this->db->prepare($sql_delete);
        $stmt_delete->bindValue(':id', $this->id );
        
        return $stmt_delete->execute();
        
      } catch(PDOException $e){
        return false;
      }
    }

    public function buscarPorId() : ? Projeto {
      $sql_searchId = "SELECT * FROM projetos WHERE id = :id";

      try{
        $stmt_searchId = $this->db->prepare($sql_searchId);
        $stmt_searchId->bindValue(':id', $this->id );
        $stmt_searchId->execute();

        $stmt_searchId->setFetchMode(PDO::FETCH_CLASS, 'Projeto');

        $projeto = $stmt_searchId->fetch();

        return ($projeto !== false) ? $projeto : null;
      
      }catch(PDOException $e){
        return null;
      }
    }

    public static function buscarTodos() : array {
      $db = Conexao::getConexao();
      $sql_searchAll = "SELECT * FROM projetos";

      try{
        $stmt_searchAll = $db->prepare( $sql_searchAll );
        $stmt_searchAll->execute();

        $stmt_searchAll->setFetchMode(PDO::FETCH_CLASS, 'Projeto');
        $projetos = $stmt_searchAll->fetchAll();
        return $projetos;

      } catch(PDOException $e){
        return [];
      }
    }

  }
?>