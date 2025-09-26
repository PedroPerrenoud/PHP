<?php
  if (session_status() == PHP_SESSION_NONE) {
    session_start();
  }

  include 'CodeBar.php';

  if(isset($_POST['code'])){
    $completeInput = $_POST['code'];
    $separateCode = str_split($completeInput, 1 );
    
    //Verifica se o tamanho do código tem 13 dígitos
    if( count($separateCode) > 13 || count($separateCode) <=0){
      header('Location: ./../index.php?code=erro');
    }

    //Cria um novo códigoDeBarras
    $code = new CodeBar(); // Instancia um novo código de barras
    $verifyCode = $separateCode[12]; //Pega o último dígito para guardar em um código de verificação
    $entireCode = array_slice($separateCode, 0, 11); //Separa cada dígito do código em um array
    $code->setCodigo($entireCode); // Insere esse array de digitos como um código
    $code->setDigitVerify($verifyCode); // Insere o dígito de verificação

    //Faz a verificação
    if( $verification = $code->verify() ){
      $_SESSION['mensagem'] = [
        'tipo' => 'sucesso',
        'texto' => 'O código é válido!'
      ];
      header("Location: ../index.php?sucesso=true");
      exit();
    } else {
      // Pega os dados de debug gerados pela função verify()
    $debug = $code->getDebugLog();
    
    // Converte o array de dados processados em uma string para exibição
    $dados_processados = implode(' ', $debug['dados_processados']);

    // Monta a string de debug detalhada
    $debug_info = "DETALHES DO ERRO: ";
    $debug_info .= "| Dados Processados (12): <string>{$dados_processados}</string> || ";
    $debug_info .= "Soma das Multiplicações: <strong>{$debug['soma_inicial']}</string> || ";
    $debug_info .= "Dígito Verificador (Esperado): <string>{$debug['digito_esperado']}</string> || ";
    $debug_info .= "Dígito Verificador (Real): <string>{$debug['digito_real']}</string>";

    // Insere o log na sessão
    $_SESSION['mensagem'] = [
        'tipo' => 'erro',
        // Adiciona a informação de debug ao texto da mensagem de erro
        'texto' => 'O código não é VÁLIDO! || ' . $debug_info 
    ];
    
    // Lembre-se de corrigir o header! Use um caminho consistente e sem parâmetros.
    header("Location: ./../index.php"); 
    exit();
    }
    
  }
?>