<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require __DIR__ . '/../../../vendor/autoload.php';
use Dotenv\Dotenv;
$dotenv = Dotenv::createImmutable(__DIR__ . '/../../../');
$dotenv->safeLoad();

    function conectarComBanco() {
    $host = $_ENV['db_host'];    
    $port = $_ENV['db_port']; 
    $database = $_ENV['db_database'];
    $user = $_ENV['db_user'];
    $password = $_ENV['db_pass'];
    $sslmode = $_ENV['db_sslmode'] ?? 'require';

    $dsn = "pgsql:host=$host;port=$port;dbname=$database;sslmode=$sslmode";

    try {
        $pdo = new PDO($dsn, $user, $password, [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ]);
        return $pdo;
    } catch (PDOException $e) {
        echo "Erro na conexão do banco: " . $e->getMessage();
        return null;
    }}      
?>