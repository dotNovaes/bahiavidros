<?php
require __DIR__ . '/../../vendor/autoload.php';
use Dotenv\Dotenv;
$dotenv = Dotenv::createImmutable(__DIR__ . '/../../');
$dotenv->safeLoad();




    $host = $_ENV['db_host'];    
    $port = (int) $_ENV['db_port']; 
    $database = $_ENV['db_database'];
    $user = $_ENV['db_user'];
    $password = $_ENV['db_pass'];

    $banco = "pgsql:host=$host;dbname=$database;port=$port";

    try {
        $pdo = new PDO($banco, $user, $password);
        echo "Conectado ao banco";
    } catch (PDOException $e) {
        echo "Erro na conexão: " . $e->getMessage();
    }


    function conectarComBanco() {
    $host = $_ENV['db_host'];    
    $port = $_ENV['db_port']; 
    $database = $_ENV['db_database'];
    $user = $_ENV['db_user'];
    $password = $_ENV['db_pass'];

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