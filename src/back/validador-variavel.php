<?php

function validarNome($entrada){
    if (empty($entrada)) {
        echo "Campo vazio.";
        return false;
    } elseif (!preg_match("/^[a-zA-Z ]*$/", $entrada)) {
        echo "Caracteres invalidos.";
        return false;
    } else {
        return true;
    }
}

function validarTamanho($entrada, $tamanho){
    if (strlen($entrada) > $tamanho) {
        echo "Tamanho excedido.";
        return false;
    } else {
        return true;
    }
}

function validarApenasNumeros($entrada){
    if (!is_numeric($entrada)) {
        echo "Caracteres invalidos.";
        return false;
    } else {
        return true;
    }
}

function validarEmail($entrada){
    if (!filter_var($entrada, FILTER_VALIDATE_EMAIL)) {
        echo "Email invalido.";
        return false;
    } else {
        return true;
    }
}

?>