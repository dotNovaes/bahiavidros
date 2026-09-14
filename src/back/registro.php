<?php

require_once __DIR__ . '/autenticacao.php';
require_once __DIR__ . '/banco/connection.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../front/php/registro.php');
    exit;
}

$nome = trim($_POST['nome'] ?? '');
$email = trim($_POST['email'] ?? '');
$senha = $_POST['senha'] ?? '';

if ($nome === '' || $email === '' || $senha === '') {
    voltarPara('registro.php', 'Preencha todos os campos.');
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    voltarPara('registro.php', 'Digite um e-mail válido.');
}

if (strlen($senha) < 6) {
    voltarPara('registro.php', 'A senha deve ter pelo menos 6 caracteres.');
}

try {
    $pdo = conectarComBanco();
    $consulta = $pdo->prepare('SELECT idusuario FROM usuarios WHERE email = :email');
    $consulta->execute(['email' => $email]);

    if ($consulta->fetch()) {
        voltarPara('registro.php', 'Este e-mail já está registrado.');
    }

    $senhaHash = password_hash($senha, PASSWORD_DEFAULT);
    $insercao = $pdo->prepare(
        'INSERT INTO usuarios (nome, email, senha) VALUES (:nome, :email, :senha)'
    );
    $insercao->execute([
        'nome' => $nome,
        'email' => $email,
        'senha' => $senhaHash,
    ]);

    iniciarSessao();
    $_SESSION['usuario'] = [
        'idusuario' => $pdo->lastInsertId(),
        'nome' => $nome,
        'email' => $email,
    ];

    header('Location: ../front/php/index.php');
    exit;
} catch (Throwable $erro) {
    voltarPara('registro.php', 'Não foi possível concluir o registro.');
}
