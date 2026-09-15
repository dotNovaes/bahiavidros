<?php
session_start();

if ((int) ($_SESSION['usuario']['tipo'] ?? 0) !== 2) {
    header('Location: ./index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuários</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <?php include './header.php'; ?>

    <div class="banner">
        <h1>Gerenciar usuários</h1>
    </div>

    <main class="main">
        <section class="admin-usuarios">
            <form id="form-novo-usuario" class="formulario formulario-usuario">
                <h2>Novo usuário</h2>
                <div class="campo">
                    <label for="novo-nome">Nome:</label>
                    <input id="novo-nome" name="nome" required maxlength="100">
                </div>
                <div class="campo">
                    <label for="novo-email">E-mail:</label>
                    <input id="novo-email" name="email" type="email" required maxlength="50">
                </div>
                <div class="campo">
                    <label for="novo-senha">Senha:</label>
                    <input id="novo-senha" name="senha" type="password" minlength="6" required>
                </div>
                <div class="campo">
                    <label for="novo-tipo">Tipo:</label>
                    <select id="novo-tipo" name="tipo" required>
                        <option value="1">Usuário</option>
                        <option value="2">Administrador</option>
                    </select>
                </div>
                <button class="botao-enviar" type="submit">Cadastrar usuário</button>
            </form>

            <section data-id-atual="<?= (int) $_SESSION['usuario']['idusuario'] ?>">
                <h2>Usuários cadastrados</h2>
                <div id="lista-usuarios" class="tabela-usuarios">Carregando usuários...</div>
            </section>
        </section>
    </main>

    <?php include './footer.php'; ?>
    <script src="../javascript/usuarios.js"></script>
</body>
</html>
