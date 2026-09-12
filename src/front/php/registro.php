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

            <div class="card-center">
                <div class="cards">

                    <div class="card">
                        <div class="card-header"><h3> Digite suas credenciais</h3></div>
                            <div class="card-body"> 
                           
                                <div class="form-login-registro">
                                    <form action="../../back/validador-login.php" method="post">   <!-- validador-login.php vai validar o login do usuário -->
                                        <label for="email">Email:</label>
                                        <input type="email" id="email" name="email" required>
                                        <label for="senha">Senha:</label>
                                        <input type="password" id="senha" name="senha" required>
                                        <button type="submit">Registrar</button>
                                    </form>
                                </div>

                            </div>
                        </div>
                        <article class="card">Registre-se para fazer parte da Bahia Vidros!</article>
                    </div>
                </div>    
            </div>
                    
        </main>

        <?php include "./footer.php"; ?>

    </body>
</html>