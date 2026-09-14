<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Registro</title>
        <link rel="stylesheet" href="../../front/css/style.css">
    </head>
    <body>

        <?php include "./header.php"; ?>

        <div class="banner"><h1>Registro</h1></div>
        <main class="main">
            <div class="cards-form">
                <?php if (isset($_GET['erro'])): ?>
                    <p><?= htmlspecialchars($_GET['erro'], ENT_QUOTES, 'UTF-8') ?></p>
                <?php endif; ?>
                <form class="formulario" action="../../back/registro.php" method="POST">
                    <h1>Digite suas credenciais</h1>
                    <div class="campo">
                        <label for="nome">Nome:</label>
                        <input type="text" id="nome" name="nome" placeholder="Digite seu nome" required>
                    </div>
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
            
            <article class="card"><h3>Você já possui uma conta? Experimente:</h3><br><br><a href="./login.php" class="botao-enviar">Fazer Login</a></article>
        </main>
                    
        <?php include "./footer.php"; ?>

    </body>
</html>