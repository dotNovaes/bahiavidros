<?php 


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $senha = $_POST["senha"];

    if (validarEmail($email) === false) {
        
    }


}



?>