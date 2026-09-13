<?php

#    $host = $_SERVER['db_host'];    
#    $port = $_SERVER['db_port']; 
#    $database = $_SERVER['db_database'];
#    $user = $_SERVER['db_user'];
#    $password = $_SERVER['db_pass'];
#
#    $banco = "pgsql:host=$host;dbname=$database;port=$port";
#
#    try {
#        $pdo = new PDO($banco, $user, $password);
#        echo "Conectado ao banco";
#    } catch (PDOException $e) {
#        echo "Erro na conexão: " . $e->getMessage();
#    }


    function conectarComBanco() {
    $host = $_SERVER['db_host'];    
    $port = $_SERVER['db_port']; 
    $database = $_SERVER['db_database'];
    $user = $_SERVER['db_user'];
    $password = $_SERVER['db_pass'];

    $banco = "pgsql:host=$host;port=$port;dbname=$database";

    try {
        $pdo = new PDO($banco, $user, $password, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);
        echo "Conectado ao banco";
        return $pdo;
    } catch (PDOException $e) {
        echo "Erro na conexão: " . $e->getMessage();
    }}        
?>