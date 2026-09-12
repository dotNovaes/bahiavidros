<?php
include('./validador-variavel.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require './email/src/Exception.php';
require './email/src/PHPMailer.php';
require './email/src/SMTP.php';


# $email_pass = $_SERVER['email_pass'];
# $email_user = $_SERVER['email_user'];

$email_user = 'bahiavidrosoficial@gmail.com';
$email_pass = 'ftec quwj cpxt hbtk';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $emailCliente = $_POST['email'];
    $assunto = $_POST['assunto'];

    $mail = new PHPMailer(true);


    if(validarNome($nome) === false) {
        $erro='Nome inválido.';
        header('Location: ../front/php/contatos.php');
        exit;
    }
 
    try {



    $mail->isSMTP();
    $mail->SMTPAuth = true;
    $mail->Username = $email_user;
    $mail->Password = $email_pass;
    $mail->SMTPSecure = 'tls';
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = 587;
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;

    // De quem pra onde
    $mail->setFrom('bahiavidrosoficial@gmail.com', 'Bahia Vidros');
    $mail->addAddress($emailCliente, $nome); // Quem vai receber a mensagem

    $mail->isHTML(true); 
    $mail->Body = "<b>Olá, $nome ($emailCliente)!</b><br> Vimos que gostaria de conversar sobre $assunto, responda este email para que possamos dar continuidade ;). <br> <br> <b>Atenciosamente,</b> <br> Bahia Vidros";
    $mail->AltBody = "Olá, $nome ($emailCliente)!\n Vimos que gostaria de conversar sobre $assunto, responda este email para que possamos conversar sobre ;). \nAtenciosamente,\nBahia Vidros";
    $mail->Subject = $assunto;

    $mail->send();

        echo 'A mensagem foi enviada!';
        header('Location: ../front/php/contatos.php');
    } catch (Exception $e) {
        echo "Erro ao enviar a mensagem: {$mail->ErrorInfo}";
    }
} else {
    header('Location: ../front/php/contatos.php');
}
?>