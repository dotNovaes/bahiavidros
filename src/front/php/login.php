<?php
session_start();
$mensagemErro = $_SESSION['mensagem_erro'] ?? null;
unset($_SESSION['mensagem_erro']);
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login</title>
        <link rel="stylesheet" href="../../front/css/style.css">
    </head>
    <body>

        <?php include "./header.php"; ?>

        <div class="banner"><h1>Login</h1></div>
        <main class="main">
            <div class="cards-form">
                <form class="formulario" action="../../back/login.php" method="POST">
                    <h1>Digite suas credenciais</h1>
                    <div class="campo">
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" placeholder="Digite seu email" required>
                    </div>
                    <div class="campo">
                        <label for="senha">Senha:</label>
                        <input type="password" id="senha" name="senha" placeholder="Digite sua senha" required>
                    </div>
                    <button class="botao-enviar" type="submit">Enviar</button>
                </form>
            
            <article class="card"><h3>Não tem um conta cadastrada?</h3><br><br><a href="./registro.php" class="botao-enviar">Registre-se</a></article>
        </main>

        <?php if ($mensagemErro !== null): ?>
            <script>
                alert(<?= json_encode($mensagemErro, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT) ?>);
            </script>
        <?php endif; ?>

        <?php include "./footer.php"; ?>

    </body>
</html>




