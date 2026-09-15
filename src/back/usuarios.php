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

$metodo = $_SERVER['REQUEST_METHOD'];
$acao = $_GET['acao'] ?? '';

try {
    $pdo = conectarComBanco();

    if ($metodo === 'GET') {
        $consulta = $pdo->query(
            'SELECT idusuario, nome, email, tipo FROM usuarios ORDER BY idusuario'
        );
        echo json_encode($consulta->fetchAll(PDO::FETCH_ASSOC), JSON_UNESCAPED_UNICODE);
        exit;
    }

    if ($metodo !== 'POST') {
        http_response_code(405);
        echo json_encode(['erro' => 'Método não permitido.']);
        exit;
    }

    $id = (int) ($_POST['idusuario'] ?? 0);

    if ($acao === 'excluir') {
        if ($id < 1 || $id === (int) $_SESSION['usuario']['idusuario']) {
            http_response_code(422);
            echo json_encode(['erro' => 'Não é possível excluir este usuário.']);
            exit;
        }

        $exclusao = $pdo->prepare('DELETE FROM usuarios WHERE idusuario = :id');
        $exclusao->execute(['id' => $id]);
        echo json_encode(['sucesso' => true]);
        exit;
    }

    $nome = trim($_POST['nome'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $tipo = filter_var($_POST['tipo'] ?? null, FILTER_VALIDATE_INT);
    $senha = $_POST['senha'] ?? '';

    if ($nome === '' || !filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($email) > 50 ||
        $tipo === false || !in_array($tipo, [1, 2], true)) {
        http_response_code(422);
        echo json_encode(['erro' => 'Preencha os dados do usuário corretamente.']);
        exit;
    }

    if ($acao === 'criar') {
        if (strlen($senha) < 6) {
            http_response_code(422);
            echo json_encode(['erro' => 'A senha deve ter pelo menos 6 caracteres.']);
            exit;
        }

        $consulta = $pdo->prepare('SELECT 1 FROM usuarios WHERE email = :email');
        $consulta->execute(['email' => $email]);
        if ($consulta->fetchColumn()) {
            http_response_code(409);
            echo json_encode(['erro' => 'Este e-mail já está cadastrado.']);
            exit;
        }

        $insercao = $pdo->prepare(
            'INSERT INTO usuarios (nome, email, senha, tipo)
             VALUES (:nome, :email, :senha, :tipo)'
        );
        $insercao->execute([
            'nome' => $nome,
            'email' => $email,
            'senha' => password_hash($senha, PASSWORD_DEFAULT),
            'tipo' => $tipo,
        ]);

        echo json_encode(['sucesso' => true]);
        exit;
    }

    if ($acao === 'editar') {
        if ($id < 1) {
            http_response_code(422);
            echo json_encode(['erro' => 'Usuário inválido.']);
            exit;
        }

        if ($id === (int) $_SESSION['usuario']['idusuario'] && $tipo !== 2) {
            http_response_code(422);
            echo json_encode(['erro' => 'Você não pode remover seu próprio acesso de administrador.']);
            exit;
        }

        $parametros = [
            'id' => $id,
            'nome' => $nome,
            'email' => $email,
            'tipo' => $tipo,
        ];
        $sql = 'UPDATE usuarios SET nome = :nome, email = :email, tipo = :tipo';

        if ($senha !== '') {
            if (strlen($senha) < 6) {
                http_response_code(422);
                echo json_encode(['erro' => 'A senha deve ter pelo menos 6 caracteres.']);
                exit;
            }
            $sql .= ', senha = :senha';
            $parametros['senha'] = password_hash($senha, PASSWORD_DEFAULT);
        }

        $sql .= ' WHERE idusuario = :id';
        $atualizacao = $pdo->prepare($sql);
        $atualizacao->execute($parametros);
        echo json_encode(['sucesso' => true]);
        exit;
    }

    http_response_code(400);
    echo json_encode(['erro' => 'Ação inválida.']);
} catch (Throwable $erro) {
    http_response_code(500);
    echo json_encode(['erro' => 'Não foi possível concluir a operação.']);
}
