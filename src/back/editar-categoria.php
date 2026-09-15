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

$idcategoria = filter_var($_POST['idcategoria'] ?? null, FILTER_VALIDATE_INT);
$nome = trim((string) ($_POST['nome'] ?? ''));

if ($idcategoria === false || $idcategoria < 1 || $nome === '') {
    http_response_code(422);
    echo json_encode(['erro' => 'Dados inválidos para editar a categoria.']);
    exit;
}

try {
    $pdo = conectarComBanco();
    $sql = 'UPDATE categorias SET nome = ? WHERE idcategoria = ?';
    $stmt = $pdo->prepare($sql);
    $sucesso = $stmt->execute([$nome, $idcategoria]);

    if ($sucesso) {
        echo json_encode(['sucesso' => true]);
        exit;
    }

    http_response_code(500);
    echo json_encode(['erro' => 'Não foi possível atualizar a categoria.']);
    exit;
} catch (Throwable $erro) {
    http_response_code(500);
    echo json_encode(['erro' => 'Erro ao atualizar a categoria.']);
    exit;
}
