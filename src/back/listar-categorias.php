<?php
require_once __DIR__ . '/banco/connection.php';

header('Content-Type: application/json; charset=utf-8');

try {
    $pdo = conectarComBanco();
    $consulta = $pdo->query(
        'SELECT idcategoria, nome FROM categorias ORDER BY nome'
    );

    echo json_encode(
        $consulta->fetchAll(PDO::FETCH_ASSOC),
        JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES
    );
} catch (Throwable $erro) {
    http_response_code(500);
    echo json_encode(['erro' => 'Não foi possível carregar as categorias.']);
}