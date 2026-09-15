<?php
require_once __DIR__ . '/autenticacao.php';
require_once __DIR__ . '/banco/connection.php';

iniciarSessao();
header('Content-Type: application/json; charset=utf-8');

if ((int) ($_SESSION['usuario']['tipo'] ?? 0) !== 2) {
    http_response_code(403);
    echo json_encode(['erro' => 'Acesso restrito ao administrador.']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['erro' => 'Método não permitido.']);
    exit;
}

$id = (int) ($_POST['idprodutos'] ?? 0);
$nome = trim($_POST['nome'] ?? '');
$valor = filter_var($_POST['valor'] ?? null, FILTER_VALIDATE_FLOAT);
$formato = trim($_POST['formato'] ?? '');
$espessura = filter_var($_POST['espessura'] ?? null, FILTER_VALIDATE_FLOAT);
$largura = filter_var($_POST['largura'] ?? null, FILTER_VALIDATE_FLOAT);
$altura = filter_var($_POST['altura'] ?? null, FILTER_VALIDATE_FLOAT);
$idcategoria = filter_var($_POST['idcategoria'] ?? null, FILTER_VALIDATE_INT);

if ($id < 1 || $nome === '' || $formato === '' || $valor === false ||
    $espessura === false || $largura === false || $altura === false ||
    $idcategoria === false || $idcategoria < 1) {
    http_response_code(422);
    echo json_encode(['erro' => 'Preencha os dados do produto corretamente.']);
    exit;
}

try {
    $pdo = conectarComBanco();
    $consulta = $pdo->prepare(
        'UPDATE produtos
         SET nome = :nome, valor = :valor, formato = :formato,
             espessura = :espessura, largura = :largura, altura = :altura,
             idcategoria = :idcategoria
         WHERE idprodutos = :id'
    );
    $consulta->execute([
        'id' => $id,
        'nome' => $nome,
        'valor' => $valor,
        'formato' => $formato,
        'espessura' => $espessura,
        'largura' => $largura,
        'altura' => $altura,
        'idcategoria' => $idcategoria,
    ]);

    echo json_encode(['sucesso' => true]);
} catch (Throwable $erro) {
    http_response_code(500);
    echo json_encode(['erro' => 'Não foi possível editar o produto.']);
}
