<?php
session_start();

if (!isset($_SESSION['usuario']) || (int) $_SESSION['usuario']['tipo'] !== 2) {
    http_response_code(403);
    if (strpos($_SERVER['HTTP_ACCEPT'] ?? '', 'application/json') !== false) {
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode(['erro' => 'Acesso não autorizado.']);
    } else {
        echo 'Acesso não autorizado.';
    }
    exit;
}

# ini_set('display_errors', 1);
# ini_set('display_startup_errors', 1);
# error_reporting(E_ALL);

include 'banco/connection.php';
$pdo = conectarComBanco();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
$nome = $_POST["nome"];
$valor =(float) $_POST["valor"];
$formato = $_POST["formato"];
$espessura =(float) $_POST["espessura"];
$largura = (float)$_POST["largura"];
$altura = (float) $_POST["altura"];
$idcategoria = (int) $_POST["idcategoria"];

try {
        $sql = "INSERT INTO produtos (idprodutos, nome, valor, formato, espessura, largura, altura, idcategoria) 
                VALUES (default, ?, ?, ?, ?, ?, ?, ?)";
        
        $stmt = $pdo->prepare($sql); 

        $sucesso = $stmt->execute([
            $nome, 
            $valor, 
            $formato, 
            $espessura, 
            $largura, 
            $altura, 
            $idcategoria
        ]);
    # teste de sucesso, cai na de leitura    
    if ($sucesso) {
            if (strpos($_SERVER['HTTP_ACCEPT'] ?? '', 'application/json') !== false) {
                header('Content-Type: application/json; charset=utf-8');
                echo json_encode(['sucesso' => true]);
            } else {
                header("Location: ../../../ler-produtos-view.php");
            }
            exit;
        }
    } catch (PDOException $e) {
        echo "Erro ao cadastrar produto: " . $e->getMessage();
        exit;
    }
}
?>