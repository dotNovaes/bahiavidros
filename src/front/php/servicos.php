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
            <nav>
              <a class="menu-botao">Portas</a>
              <a class="menu-botao">Janelas</a>
              <a class="menu-botao">Box</a>
              <a class="menu-botao">Espelhos</a>
            </nav>
            <br>
      </div>

        <main class="main">
            <div class="cards">
                
                <div class="card">
                    <div class="card-header"><h3>Portas</h3></div>
                    <div class="card-body">
                        <ol>
                            <li>Portas temperadas</li>
                            <li>Porta pivotante</li>
                            <li>Porta de correr</li>
                        </ol>
                    </div>
                    <div class="card-footer"><p>Portas de alta qualidade</p></div>
                </div>

                <div class="card">
                    <div class="card-header"><h3>Janelas</h3></div>
                    <div class="card-body">
                        <ol>
                            <li>Janela temperada</li>
                            <li>Janela com esquadria</li>
                            <li>Janela acústica</li>
                        </ol>
                    </div>
                    <div class="card-footer"><p>Janelas de alta qualidade</p></div>
                </div>


                <div class="card">
                    <div class="card-header"><h3>Box</h3></div>
                    <div class="card-body">
                            <ol>
                                <li>Box de correr</li>
                                <li>Box até o teto</li>
                                <li>Box elegance</li>
                            </ol>
                        </div>
                    <div class="card-footer"><p>Boxes de alta qualidade</p></div>
                </div>    

                <div class="card">
                    <div class="card-header"><h3>Espelhos</h3></div>
                        <div class="card-body">
                            <ol>
                                <li>Espelhos decorativos</li>
                                <li>Espelhos de academia</li>
                                <li>Espelho de banheiro</li>
                            </ol>
                        </div>
                        <div class="card-footer"><p>Espelhos de alta qualidade</p></div>
                    </div>    
                </div>
        </main>
        
        <?php include './footer.php'; ?>
        
    </body>
</html>