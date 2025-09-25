<?php

  class CodeBar {

    private $code;
    private $digitVerify;

    public function getCodigo(){ return $this->code; }
    public function setCodigo( $newCode ){ 
      $this->code = $newCode;
    }
    
    public function getDigitVerify(){ return $this->digitVerify; }
    public function setDigitVerify( $newDigitVerify ){ 
      $this->digitVerify = $newDigitVerify;
    }

    public function verify() : bool {
      //Soma os valores
      $count;
      foreach( $digit as $this->code ){
        $count += $digit;
      }
    }

  }
  

?>