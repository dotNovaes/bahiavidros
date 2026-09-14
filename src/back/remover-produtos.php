<?php
 ini_set('display_errors', 1);
 ini_set('display_startup_errors', 1);
 error_reporting(E_ALL);

include 'banco/connection.php';
$pdo = conectarComBanco();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = (int) ($_POST["idDelete"] ?? 0);
    
    try {
        $sql = "DELETE FROM produtos WHERE idprodutos = ?";
        $stmt = $pdo->prepare($sql);
        $sucesso = $stmt->execute([$id]);

    # teste de sucesso, cai na de leitura    
#    if ($sucesso) {
#            header("Location: ../../../ler-produtos-view.php");
#            exit;
#    }
        } catch (PDOException $e) {
            echo "Erro ao excluir produto: " . $e->getMessage();
        }
    }