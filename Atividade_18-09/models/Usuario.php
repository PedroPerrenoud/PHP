<?php
  require_once __DIR__ .  '/../Conexao.php';
  require_once __DIR__ . '/../config/session.php';

  class Usuario{
    private $id;
    private $email;
    private $senha;
    private $db;

    public function __construct(){
      $this->db = Conexao::getConexao();
    }

    public function getId(){ return $this->id; }
    public function setId(int $id){ $this->id = $id; }

    public function getEmail(){ return $this->email; }
    public function setEmail(string $email){ $this->email = $email; }

    public function getSenha(){ return $this->senha; }
    public function setSenha(string $senha){ $this->senha = $senha; }

     public function salvar() : bool {
      try{
        $sql_insert = "INSERT INTO usuarios (email, senha) VALUES (:email, :senha)";
        $stmt_insert = $this->db->prepare($sql_insert);
        
        $stmt_insert->bindValue( ':email', $this->email );
        $stmt_insert->bindValue( ':senha', $this->senha );

        return $stmt_insert->execute(); //Se funcionar, retorna true;
      } catch( PDOException $e ){
        return false;
      }
    }

    public function atualizar() : bool {
      
      try{
        $sql_update = "UPDATE usuarios SET email = :email, senha = :senha WHERE id = :id";

        $stmt_update = $this->db->prepare($sql_update);
        $stmt_update->bindValue(':email', $this->email );
        $stmt_update->bindValue(':senha', $this->senha );
        $stmt_update->bindValue(':id', $this->id );

        return $stmt_update->execute();

      } catch( PDOException $e ){
        return false;
      }
    }

    public function deletar() : bool {
      $sql_delete = "DELETE FROM usuarios WHERE id = :id";

      try{
        $stmt_delete = $this->db->prepare($sql_delete);
        $stmt_delete->bindValue(':id', $this->id );
        
        return $stmt_delete->execute();
        
      } catch(PDOException $e){
        return false;
      }
    }

    public function autenticar($email) : ? Usuario {
      $sql_auth = "SELECT * FROM usuarios WHERE email = :email";
      try {
        $stmt_auth = $this->db->prepare($sql_auth);
        $stmt_auth->bindValue(':email', $email);
        $stmt_auth->execute();

        // O PDO tentará buscar uma linha e preencher o objeto Usuario
        $stmt_auth->setFetchMode(PDO::FETCH_CLASS, 'Usuario');
        $usuario = $stmt_auth->fetch();

        // Retorna o objeto se o usuário for encontrado, ou null se não for
        return ($usuario !== false) ? $usuario : null;

      } catch (PDOException $e) {
          return null;
      }
    }

    public static function buscarPorId($id) : ? Usuario {
      $sql_searchId = "SELECT * FROM usuarios WHERE id = :id";
      $db = Conexao::getConexao();

      try{
        $stmt_searchId = $db->prepare($sql_searchId);
        $stmt_searchId->bindValue(':id', $id );
        $stmt_searchId->execute();

        $stmt_searchId->setFetchMode(PDO::FETCH_CLASS, 'Usuario');

        $usuario = $stmt_searchId->fetch();

        return ($usuario !== false) ? $usuario : null;
      
      }catch(PDOException $e){
        return null;
      }
    }

    public static function buscarTodos() : array {
      $db = Conexao::getConexao();
      $sql_searchAll = "SELECT * FROM usuarios";

      try{
        $stmt_searchAll = $db->prepare( $sql_searchAll );
        $stmt_searchAll->execute();

        $stmt_searchAll->setFetchMode(PDO::FETCH_CLASS, 'Usuario');
        $usuario = $stmt_searchAll->fetchAll();
        return $usuario;

      } catch(PDOException $e){
        return [];
      }
    }

  }
?>