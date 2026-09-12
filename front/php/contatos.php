<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../front/css/style.css">
    <title>Contatos</title>
</head>
<body>
    
    <?php include './header.php'; ?>

    <div class="banner">
      <h2> Contatos </h2>
    </div>

    <main class="main">
      <div class="cards">

        <div class="card">
          <div class="card-header"><h3>Telefone</h3></div>
            <div class="card-body">
              <ol>
                <li>Fixo: +55 (75) 3001-1234</li>
                <li>WhatsApp: +55 (75) 3001-1234</li>
              </ol>
            </div>
            <div class="card-footer"><p>Estamos a sua disposição!</p></div>
        </div>


        <div class="card">
          <div class="card-header"><h3>Email</h3></div>
            <div class="card-body">
              <ol>
                <li>bahiavidrosoficial@gmail.com</li>
              </ol>
            </div>
            <div class="card-footer"><p>Estamos a sua disposição!</p></div>
        </div>

        <div class="card">
          <div class="card-header"><h3>Redes Sociais</h3></div>
            <div class="card-body">
              <ol>
                <li>Instagram: @bahia.vidroos</li>
                <li>Facebook: @bahia.vidroos </li> 
                <li>Tiktok: @vidrosbahia </li>
              </ol>
            </div>
            <div class="card-footer"><p>Venha nos conhecer melhor!</p></div>
        </div>


        <div class="card">
            <div><h3> Formulário de contato<h3></div>
                <div class="card-body">  
                    <form action="../../back/email/enviar-email.php" method="POST">
                        <label for="nome">Nome:</label><br>
                        <input type="text" id="nome" name="nome" required><br>

                        <label for="email">E-mail:</label><br>
                        <input type="email" id="email" name="email" required><br>
                
                        <label for="assunto">Assunto:</label><br>
                        <select>
                            <option value="duvida">Dúvida</option>
                            <option value="sugestao">Sugestão</option>
                            <option value="reclamacao">Reclamação</option>
                        </select><br>
                        <input type="submit" value="Enviar">
                    </form>
                </div>
                <div class="card-footer"><p>Fale Conosco!</p></div>\
            </div>

    </main>

    <?php include './footer.php'; ?>

</body>
</html>