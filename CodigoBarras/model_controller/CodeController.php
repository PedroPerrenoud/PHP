<?php
  include 'CodeBar.php';

  if(isset($_POST['code'])){
    $completeInput = $_POST['code'];
    $separateCode = str_split(" ", $completeInput);
    
    //Verifica se o tamanho do código tem 13 dígitos
    if( count($separateCode) !== 13){
      header('Location: ./../index.php?code=erro');
    }

    //Cria um novo códigoDeBarras
    $code = new CodeBar();
    $verifyCode = $separateCode[12];
    $entireCode = array_slice($separateCode, 0, 11);
    $code->setCodigo($entireCode);
    $code->setDigitVerify($verifyCode);

    //Faz a verificação
    $verification = $code->verify();
    
  }
?>