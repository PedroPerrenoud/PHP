O problema é o seguinte: Todas as vezes que utilizo uma funcionalidade (Cadastrar, Editar ou Excluir) o projeto realiza a ação e volta para a página de Login.
Colocando alguns logs:
/pages/login.php
  <?php if(isset($_SESSION['user'])){echo "<script>console.log(" . json_encode($_SESSION['user']) . ");</script>";} else{ echo "<script>console.log(" . json_encode("Nenhuma Session iniciada") . ");</script>";} ?>
    Retorna 'Nenhuma Session iniciada';
  <?php if(isset($_GET['controller'])){ echo "<script>console.log(" . json_encode($_GET['controller']) . ");</script>";} else{ echo "<script>console.log(" . json_encode("Nenhuma Session iniciada") . ");</script>"; } ?>
    Retorna 'Nenhum controller definido';

'Nenhuma Session iniciada': Esperado, é a primeira sessão quando o projeto é executado
'Nenhum controller definido': Estranho, pois logo quando o index.php é executado, temos:
  <?php
    [...Requires...]
    //2. Lê o endpoint da URL 
    $controller = $_GET['controller'] ?? 'user'; // Se controller vazio, usa 'user';
    $action = $_GET['action'] ?? 'login';    // Se action vazio, usa 'login';
    $controller_class = ucfirst($controller) . 'Controller';

Mesmo sendo a primeira passada do programa, os valores padrões de 'user' e 'login' deveriam ser apresentados.
Inserindo informações de Login, somos enviados para a Dashboard. Na Dashboard há uma mensagem no console revelando se existe uma Session:
  if(isset($_SESSION['user'])){echo "<script>console.log(" . json_encode($_SESSION['user']) . ");</script>";}else{ echo "<script>console.log(" . json_encode("Nenhuma Session Cadastrada") . ");</script>"; } 
    Retorna 'Nenhuma Session Cadastrada'

COMO RESOLVER O ERRO: A forma como o cadastro de sessão está sendo feito não é suficiente para armazenar no projeto, em algum lugar ele deixa de existir.
    
  Com a funcionalidade de Cadastrar: 
    Session parece estar funcionando, mesmo não sabendo de onde ela surge no console => Object email:"josesinho@email.com" id:3;
    Ao clicar em salvar:
      'Não é possível aceder a este site
       A página Web em http://localhost/PHP/Atividade_18-09/index.php?controller=funcionario&action=salvar poderá estar temporariamente inactiva ou poderá ter sido movida permanentemente para um novo endereço Web.
       ERR_UNSAFE_REDIRECT'
       Por mais que seja direcionaodp para este erro, a criação de um novo funcionário funciona;


Adicionado ao UserController:
if( $usuario ){
        // A verificação da senha é feita aqui
        if( $senha == $usuario->getSenha() ){
          $_SESSION['user'] = [
            'id' => $usuario->getId(),
            'email'=> $usuario->getEmail()
          ];

          header("Location: pages/dashboard.php");
          exit();
        }else{ //ADICIONADO PARA TRATAMENTO DE ERROS
          $_SESSION['login_error'] = 'Senha incorreta!';
          header("Location: pages/login.php?error=wrong_password");
          exit();
        }
      }
