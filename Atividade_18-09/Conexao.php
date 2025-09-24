<?php
  class Conexao{
    private static $host = 'localhost';
    private static $database = 'empresa_tech';
    private static $user = 'root';
    private static $passwrod = 'aluno';

    public static function getConexao(){
      try{
        //self:: é a substituição do $this-> para variaveis estáticas. 
        // '.' é usado para demonstrar onde acontece a inserção de uma variável dentro da string ""
        $conect = new PDO( "mysql:host=" . self::$host . "; dbname=" . self::$database, self::$user, self::$passwrod );
        $conect -> setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
        return $conect; //Para criar uma conexão ele precisa retornar esse objeto PDO;

      }catch( PDOException $erro ){
        throw new Exception( "Falha na conexão com o banco: " .  $erro->getMessage() );
      }
    }
  }
?>