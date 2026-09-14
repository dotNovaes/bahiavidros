<?php session_start(); ?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="../../front/css/style.css">
      <script src="../../front/javascript/validar-variavel.js" defer></script>
      <title>Contatos</title>
  </head>
  <body>
      
      <?php include './header.php'; ?>

      <div class="banner">
        <h1> Contatos </h1>
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
            <div class="card-header"><h3>Filais</h3></div>
              <div class="card-body">
                <ol>
                  <li>Araguaina</li>
                  <li>São Paulo</li> 
                  <li>Belo Horizonte</li>
                </ol>
              </div>
              <div class="card-footer"><p>Venha nos conhecer melhor!</p></div>
        </div>
        </main>
        <br><br>
        <main>
        
          <form id="receba-email" class="formulario" action="../../back/enviar-email.php" method="POST">
            <h1>Receba um email nosso!</h1>
            <div class="campo">
              <label for="nome">Nome:</label>
              <input type="text" id="nome" name="nome" placeholder="Digite seu nome">
            </div>
            <div class="campo">
              <label for="assunto">Assunto:</label>
              <select type="select" id="assunto" name="assunto" placeholder="Selecione um assunto" required>
                <option value="informacoes">Dúvidas</option>
                <option value="sugestoes">Sugestões</option>
                <option value="reclamacoes">Reclamações</option>
              </select>
            </div>
            <div class="campo">
              <label for="email">Email:</label>
              <input type="email" id="email" name="email" placeholder="Digite seu email">
            </div>
              <button class="botao-enviar" type="submit">Enviar</button>
          </form>

      </main>

      <?php include './footer.php'; ?>

  </body>
</html>