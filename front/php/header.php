<?php
    $protocolo = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? "https://" : "http://";
    $dominio = $_SERVER['HTTP_HOST'];
    $pasta_projeto = str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']);
    if (strpos($pasta_projeto, '/front/php/') !== false) {
        $pasta_projeto = str_replace('front/php/', '', $pasta_projeto);
    }
    $URL_BASE = $protocolo . $dominio . $pasta_projeto;
?>

<header class="header">
  <div class="logo">
    <img src="<?php echo $URL_BASE; ?>imagens/logo-caquinho.png" alt="Logo Caquinho" title="Tudo OK">
    <h1>Bahia Vidros</h1>
  </div>

  <nav>
    <ul class="menu">
      <li><a href="./front/php/index.php" class="menu-botao">Início</a></li>  
      <li><a href="./front/php/sobre.php" class="menu-botao">Sobre</a></li>
      <li><a href="./front/php/servicos.php" class="menu-botao">Serviços</a></li>
      <li><a href="./front/php/contatos.php" class="menu-botao">Contatos</a></li>
    </ul>
  </nav>

  <nav>
    <ul class="menu">
     <li><a href="./front/php/login.php" class="menu-botao">Login</a></li>
     <li><a href="./front/php/cadastro.php" class="menu-botao">Registro</a></li>
    </ul>
  </nav>
</header>