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
              <div class="card-header"><h3> Formulário de contato<h3></div>
                  <div class="card-body">

                    <div class="form">
                      <form action="../../back/enviar-email.php" method="POST">

                          <label for="nome">Seu Nome:</label>
                          <input type="text" id="nome" name="nome" required>

                          <label for="email">Seu E-mail:</label>
                          <input type="email" id="email" name="email" required>
                  
                          <label for="assunto">Assunto:</label>

                          <div class="form-select-input">
                            <select name="assunto" id="assunto" required>
                                <option value="Duvida">Dúvida</option>
                                <option value="Sugestao">Sugestão</option>
                                <option value="Reclamacao">Reclamação</option>
                            </select>
                            <input type="submit" value="Enviar">
                          </div>
                          
                      </form>
                    </div> 

                  </div>
                  <div class="card-footer"><p>Fale Conosco!</p></div>
              </div>

      </main>

      <?php include './footer.php'; ?>

  </body>
</html>

<!-- rapaziada isso aqui era pra retornar um erro na tela, o erro sai do post com esse $erro, dai voces veem como faz...-->
    <?php if (!empty($erro)): ?>
        <javascript>
            alert(<?php echo $erro; ?>);
        </javascript>  
    <?php endif; ?>