<?php 
# ini_set('display_errors', 1);
# ini_set('display_startup_errors', 1);
# error_reporting(E_ALL);
include 'banco/connection.php';
$pdo = conectarComBanco();

$produtos = [];
$buscou = false;

if (isset($_GET['carregar'])) {
    try {
        $sql = "SELECT p.idprodutos, p.nome, p.valor, p.formato, p.espessura,
                       p.largura, p.altura, p.idcategoria, c.nome AS categoria
                FROM produtos p
                LEFT JOIN categorias c ON c.idcategoria = p.idcategoria
                ORDER BY p.idprodutos";
        $stmt = $pdo->query($sql);
        $produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);

        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($produtos, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        exit;
    } catch (PDOException $e) {
        http_response_code(500);
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode(['erro' => 'Não foi possível carregar os produtos.']);
        exit;
    }
}

require __DIR__ . '../../../ler-produtos-view.php'; ## aqui vai por a pasta onde fica a leitura de produtos


?>