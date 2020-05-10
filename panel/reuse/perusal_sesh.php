<?php
    session_name('perusal_sesh');
    session_start();

    require_once('../vendor/autoload.php');
    $loader = new \Twig\Loader\FilesystemLoader('templates');
    $twig = new \Twig\Environment($loader);
?>