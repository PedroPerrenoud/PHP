<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    $path = '/PHP/Atividade_18-09/';
    $_SESSION['path'] = $path;
?>