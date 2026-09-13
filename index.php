<?php
    header('Location: ./src/front/php/index.php');
# inicia o dotenv
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
    $dotenv->load();
?>