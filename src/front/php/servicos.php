<?php session_start(); ?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Serviços</title>
        <link rel="stylesheet" href="../../front/css/style.css">
    </head>
    <body>
       
      <?php include "./header.php";?>
      
      <div class="banner">
            <h1>Venha conheçer nossos Serviços!</h1>
            <h2>Tratamos da confecção de materiais e distribuição para empresas parceiras.</h2>
            <br>
            <h3>Oferecemos:</h3>
            <br>
            <nav id="filtro-categorias" aria-label="Filtro de categorias"></nav>
            <br>
      </div>
 
        <main class="main">
            <?php if (isset($_SESSION['usuario']) && (int) $_SESSION['usuario']['tipo'] === 2): ?>
                <div class="main-admin-acoes">
                    <button type="button" class="botao-produto" id="btn-criar-categoria">Criar categoria</button>
                </div>
            <?php endif; ?>

            <div id="container-produtos" class="cards" data-admin="<?= (isset($_SESSION['usuario']['tipo']) && (int) $_SESSION['usuario']['tipo'] === 2) ? 'true' : 'false' ?>">
                <p>Carregando produtos...</p>
            </div>
        </main>
        
        <?php include './footer.php'; ?>
        <script src="../javascript/buscarproduto.js"></script>
        <script src="../javascript/filtro-produto.js"></script>
 
    </body>
</html>