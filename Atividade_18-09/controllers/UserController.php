<?php
  require_once __DIR__ . '/../config/session.php';
  require_once __DIR__ . '/../models/Usuario.php';

  class UserController {
      
    public function login(){
      $email = $_POST['user_email'];
      $senha = $_POST['user_passwd'];
      
      $userModel = new Usuario();

      $usuario = $userModel->autenticar($email);
    
      if( $usuario ){
        // A verificação da senha é feita aqui
        if( $senha == $usuario->getSenha() ){
          $_SESSION['user'] = [
            'id' => $usuario->getId(),
            'email'=> $usuario->getEmail()
          ];

          header("Location: pages/dashboard.php");
          exit();
        }
      }
      
      // Se a autenticação falhou (o email não existe ou a senha está incorreta)
      header("location: pages/login.php?error=invalid_credentials");
      exit();
    }
  }