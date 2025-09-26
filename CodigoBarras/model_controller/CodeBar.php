<?php
  class CodeBar {

    private $code;
    private $digitVerify;
    private $debugLog = []; // Para apuração de erros.

    public function getCodigo(){ return $this->code; }
    public function setCodigo( $newCode ){ 
      $this->code = $newCode;
    }
    
    public function getDigitVerify(){ return $this->digitVerify; }
    public function setDigitVerify( $newDigitVerify ){ 
      $this->digitVerify = $newDigitVerify;
    }

    public function getDebugLog(){ return $this->debugLog; }

    public function verify() : bool {
      //Multiplica os valores
      $iniCount = 0;
      $times = 1;
      foreach( $this->code as $digitString ){
       $digit = (int)$digitString;
       
       $result = $digit * $times;
       $iniCount += $result;
      
       // Alterna entre 1 e 3;
       $times = ($times === 1) ? 3 : 1;
      }

      $count = $iniCount/10;  // Divide por 10;
      $count = floor($count); // Arredonda para baixo;
      $count += 1;            // Soma mais 1 ao valor;
      $count *= 10;           // Multiplica por 10
      $count -= $iniCount;    // Subtrai a conta inicial

      $this->debugLog['soma_inicial'] = $iniCount;
      $this->debugLog['digito_esperado'] = $count;
      $this->debugLog['digito_real'] = (int)$this->digitVerify;
      $this->debugLog['dados_processados'] = $this->code; // Os 12 dígitos de dados

      if( (int)$count === (int)$this->digitVerify ){
        return true;
        exit();
      }

      return false;
    }
  }
  

?>