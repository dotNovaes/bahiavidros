<header class="header">
  <div class="logo">
      <img src="../../imagens/o-caquinho.png" alt="Logo Caquinho" title="Tudo OK">
      <h1>Bahia Vidros</h1>
  </div>

  <nav>
    <ul class="menu">
        <li><a href="./index.php" class="menu-botao">Início</a></li>
        <li><a href="./sobre.php" class="menu-botao">Sobre</a></li>
        <li><a href="./servicos.php" class="menu-botao">Serviços</a></li>
        <li><a href="./contatos.php" class="menu-botao">Contatos</a></li>
    </ul>
  </nav>
  
  <nav>
    <ul class="menu">
     <?php if (isset($_SESSION['usuario'])): ?>
       <li><span class="usuario"><?= htmlspecialchars($_SESSION['usuario']['nome'], ENT_QUOTES, 'UTF-8') ?></span></li>
       <li><a href="../../back/logout.php" class="menu-botao">Sair</a></li>
     <?php else: ?>
       <li><a href="./login.php" class="menu-botao">Login</a></li>
       <li><a href="./registro.php" class="menu-botao">Registro</a></li>
     <?php endif; ?>
    </ul>
  </nav>
</header>