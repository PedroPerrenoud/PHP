<?php

//1. Inclui os Controllers
require_once __DIR__ . '/config/session.php';
require_once __DIR__ . '/controllers/FuncionarioController.php';
require_once __DIR__ . '/controllers/UserController.php';
require_once __DIR__ . '/controllers/ProjectController.php';

//2. Lê o endpoint da URL 
$controller = $_GET['controller'] ?? 'funcionario'; // Controller padrão
$action = $_GET['action'] ?? 'listar';    // Ação padrão
$controller_class = ucfirst($controller) . 'Controller';

//3.  Se for login, executa direto sem checar sessão
if ($controller === 'user' && $action === 'login') {
    if (class_exists($controller_class) && method_exists($controller_class, $action)) {
        $controller_obj = new $controller_class();
        $controller_obj->$action();
    } else {
        echo "Endpoint não encontrado";
    }
    exit();
}

//4. Agora, faz a verificação de login com a exceção
// Se o usuário NÃO está logado E a requisição NÃO é para o login, usuário é redirecionado.
if( !isset($_SESSION['user']) ) {
    header("Location: pages/login.php");
    exit();
}

//5. Se o código chegou até aqui, o usuário está logado OU ele está na página de login.
// Cria o nome da classe do controlador

echo "<script>console.log('Nome da classe: {$controller_class}');</script>";

//6. Verifica se a classe e o método existem
if (class_exists($controller_class) && method_exists($controller_class, $action)) {
    echo "<script>console.log('Verificando a existência do Endpoint... OK');</script>";;
    $controller_obj = new $controller_class();
    $controller_obj->$action();
} else {
    echo "Endpoint não encontrado: " . ucfirst($controller) . "Controller";
}

?>