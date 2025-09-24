<?php
if (isset($_SESSION['user'])) {
    // Se a variável de sessão 'user' não existir,
    // redireciona o usuário para a página de login
    header("Location: /PHP/Atividade_18-09/pages/login.php");
    exit();
}
?>