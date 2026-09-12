<?php
    $protocolo = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? "https://" : "http://";
    $dominio = $_SERVER['HTTP_HOST'];
    $pasta_projeto = str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']);
    if (strpos($pasta_projeto, '/front/php/') !== false) {
        $pasta_projeto = str_replace('front/php/', '', $pasta_projeto);
    }
    $URL_BASE = $protocolo . $dominio . $pasta_projeto;
?>

<br><br><br><br>
<footer class="footer">
    <img src="<?php echo $URL_BASE; ?>imagens/logo-caquinho.png" alt="Logo Caquinho" title="Tudo OK">
    <article class="card"><strong>Horário de funcionamento</strong><br>Segunda a sexta: 08:00 - 18:00<br>Sábado: 08:00 - 12:00</article>
    <article class="card"><strong>Endereço</strong><br>Endereço: Rua dos Bobos, nº 0, Centro<br> - Feira de Santana, Bahia.</article>
    <p>© 2026 Bahia Vidros. Todos os direitos reservados.</p>
</footer>