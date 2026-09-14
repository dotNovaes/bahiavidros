<?php session_start(); ?>
<!DOCTYPE html>
<html lang="pt-BR">
  <head>
    <meta charset="UTF-8">
    <title>Bahia Vidros</title>
    <link rel="stylesheet" href="../css/style.css">
  </head>
  <body>

    <?php include './header.php'; ?>

    <section class="banner">
      <h1>Bem-vindo a Bahia Vidros!</h1>
      <h2>Trabalhamos com transparência</h2>
    </section>

    <main class="main">

      <section class="cards-grid">
        <h2>Mais vendidos</h2>

        <div class="cards">

          <div class="card">
            <div class="card-header"><h3>Vidro</h3></div>
            <div class="card-body"><img src="../../imagens/vidros-empilhados.webp" alt="Vidro"></div>
            <div class="card-footer"><p>O mais procurado</p></div>
          </div>

          <div class="card">
            <div class="card-header"><h3>Espelho</h3></div>
            <div class="card-body"><img src="../../imagens/espelho.webp" alt="Espelho"></div>
            <div class="card-footer"><p>Para que você possa refletir</p></div>
          </div>

          <div class="card">
            <div class="card-header"><h3>Box</h3></div>
            <div class="card-body"><img src="../../imagens/box.webp" alt="Box"></div>
            <div class="card-footer"><p>Caixa</p></div>
          </div>

          <article class="card"><strong>Outras notícias</strong><br>Novo tipo de vidro que revolucionou mercado foi feito pela Bahia Vidros</article>
          <article class="card">Vidro 2 é criado pela a Bahia Vidros©</article>
          <article class="card">Vidro reforçado da Bahia Vidros© é aprova de balas</article>
          <article class="card">Bahia Vidros© criou o primeiro vidro ecologicamente correto</article>
          <article class="card">Janelas de vidro raio-X criada pela Bahia Vidros©</article>
            
        </div>
    </section>
    </main>

    <?php include './footer.php'; ?>

  </body>
</html>

<?php
  require_once __DIR__ . '/vendor/autoload.php';
  
  #iniciar o dotenv
  $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
  $dotenv->load();
?>

