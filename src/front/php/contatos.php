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
            <?php
              $flash = $_SESSION['contato_flash'] ?? null;
              unset($_SESSION['contato_flash']);
              if (is_array($flash) && !empty($flash['texto'])):
                $ok = ($flash['tipo'] ?? '') === 'ok';
            ?>
              <p style="margin:0 0 12px;padding:10px 12px;border-radius:6px;<?= $ok
                ? 'background:#e8f6ee;color:#1b5e3b;border:1px solid #b7e0c5;'
                : 'background:#fdecea;color:#8a1f11;border:1px solid #f5c2c0;' ?>">
                <?= htmlspecialchars((string) $flash['texto'], ENT_QUOTES, 'UTF-8') ?>
              </p>
            <?php endif; ?>
            <div class="campo">
              <label for="nome">Nome:</label>
              <input type="text" id="nome" name="nome" placeholder="Digite seu nome">
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