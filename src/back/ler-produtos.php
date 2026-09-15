<?php 
# ini_set('display_errors', 1);
# ini_set('display_startup_errors', 1);
# error_reporting(E_ALL);
include 'banco/connection.php';
$pdo = conectarComBanco();

$produtos = [];
$buscou = false;
$buscouUnidade = false;

if (isset($_GET['carregar'])) {
    $buscou = true;
    try {
        $sql = "SELECT * FROM produtos";
        $stmt = $pdo->query($sql);
        $produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Erro ao buscar produtos: " . $e->getMessage();
        exit;
    }
}

if (isset($_POST["idBuscar"])) {
    $buscouUnidade = true;
    try {
        $sql = "SELECT * FROM produtos WHERE idprodutos=";
        $stmt = $pdo->query($sql);
        $produtoUnico = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Erro ao buscar produtos: " . $e->getMessage();
        exit;
    }

}



require __DIR__ . '../../../ler-produtos-view.php'; ## aqui vai por a pasta onde fica a leitura de produtos


?>