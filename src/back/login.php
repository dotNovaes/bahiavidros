<?php

require_once __DIR__ . '/autenticacao.php';
require_once __DIR__ . '/banco/connection.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../front/php/login.php');
    exit;
}

$email = trim($_POST['email'] ?? '');
$senha = $_POST['senha'] ?? '';

if ($email === '' || $senha === '') {
    voltarPara('login.php', 'Preencha todos os campos.');
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    voltarPara('login.php', 'Digite um e-mail válido.');
}

try {
    $pdo = conectarComBanco();
    $consulta = $pdo->prepare(
        'SELECT idusuario, nome, email, senha FROM usuarios WHERE email = :email'
    );
    $consulta->execute(['email' => $email]);
    $usuario = $consulta->fetch();

    if (!$usuario || !password_verify($senha, $usuario['senha'])) {
        voltarPara('login.php', 'E-mail ou senha inválidos.');
    }

    iniciarSessao();
    session_regenerate_id(true);
    $_SESSION['usuario'] = [
        'idusuario' => $usuario['idusuario'],
        'nome' => $usuario['nome'],
        'email' => $usuario['email'],
    ];

    header('Location: ../front/php/index.php');
    exit;
} catch (Throwable $erro) {
    voltarPara('login.php', 'Não foi possível realizar o login.');
}
