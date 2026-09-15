<?php
 ini_set('display_errors', 1);
 ini_set('display_startup_errors', 1);
 error_reporting(E_ALL);

include 'banco/connection.php';
require_once __DIR__ . '/autenticacao.php';

iniciarSessao();
if ((int) ($_SESSION['usuario']['tipo'] ?? 0) !== 2) {
    http_response_code(403);
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode(['erro' => 'Acesso restrito ao administrador.']);
    exit;
}

$pdo = conectarComBanco();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = (int) ($_POST["idDelete"] ?? 0);
    
    try {
        $sql = "DELETE FROM produtos WHERE idprodutos = ?";
        $stmt = $pdo->prepare($sql);
        $sucesso = $stmt->execute([$id]);

    # teste de sucesso, cai na de leitura    
    if ($sucesso) {
            if (($_SERVER['HTTP_ACCEPT'] ?? '') === 'application/json') {
                header('Content-Type: application/json; charset=utf-8');
                echo json_encode(['sucesso' => true]);
                exit;
            }
            header("Location: ../../../ler-produtos-view.php");
            exit;
    }
        } catch (PDOException $e) {
            echo "Erro ao excluir produto: " . $e->getMessage();
        }
    }