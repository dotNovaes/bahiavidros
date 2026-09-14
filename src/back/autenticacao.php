<?php

function iniciarSessao(): void
{
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }
}

function voltarPara(string $pagina, string $mensagem): never
{
    header('Location: ../front/php/' . $pagina . '?erro=' . urlencode($mensagem));
    exit;
}
?>