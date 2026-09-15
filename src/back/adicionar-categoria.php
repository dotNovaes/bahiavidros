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

$nome = trim((string) ($_POST['nome'] ?? ''));

if ($nome === '') {
    http_response_code(400);
    echo json_encode(['erro' => 'Informe o nome da categoria.']);
    exit;
}

try {
    $pdo = conectarComBanco();
    $sql = 'INSERT INTO categorias (idcategoria, nome) VALUES (DEFAULT, ?)';
    $stmt = $pdo->prepare($sql);
    $sucesso = $stmt->execute([$nome]);

    if ($sucesso) {
        echo json_encode(['sucesso' => true, 'categoria' => $nome]);
        exit;
    }

    http_response_code(500);
    echo json_encode(['erro' => 'Não foi possível criar a categoria.']);
    exit;
} catch (Throwable $erro) {
    http_response_code(500);
    echo json_encode(['erro' => 'Erro ao cadastrar categoria.']);
    exit;
}
