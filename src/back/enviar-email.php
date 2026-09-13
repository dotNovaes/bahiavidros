<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require __DIR__ . '/../../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

use Dotenv\Dotenv;
$dotenv = Dotenv::createImmutable(__DIR__ . '/../../');
$dotenv->safeLoad();

 $email_pass = $_ENV['email_pass'] ?? '';
 $email_user = $_ENV['email_user'] ?? '';
 $email_host = $_ENV['email_host'] ?? '';
 $email_SMTPSecure = $_ENV['email_SMTPSecure'] ?? '';
 $email_port = $_ENV['email_port'] ?? '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nome = $_POST['nome'] ?? '';
    $emailCliente = $_POST['email'] ?? '';
    $assunto = $_POST['assunto'] ?? '';
 
    $mail = new PHPMailer(true);

    try {

    $mail->isSMTP();
    $mail->SMTPAuth = true;
    $mail->Username = $email_user;
    $mail->Password = $email_pass;
    $mail->SMTPSecure = $email_SMTPSecure;
    $mail->Host = $email_host;
    $mail->Port = (int) $email_port;

    if (strtolower($email_SMTPSecure) === 'ssl') {
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    } else {
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    }

    // De quem pra onde
    $mail->setFrom($email_user, 'Bahia Vidros');
    $mail->addAddress($emailCliente, $nome); // Quem vai receber a mensagem

    $mail->isHTML(true); 
    $mail->Subject = $assunto;

    $mail->Body = "<b>Olá, $nome ($emailCliente)!</b><br> Vimos que gostaria de conversar sobre $assunto, responda este email para que possamos dar continuidade ;). <br> <br> <b>Atenciosamente,</b> <br> Bahia Vidros";
    $mail->AltBody = "Olá, $nome ($emailCliente)!\n Vimos que gostaria de conversar sobre $assunto, responda este email para que possamos conversar sobre ;). \nAtenciosamente,\nBahia Vidros";


    $mail->send();
        echo "A mensagem foi enviada!";
        header('Location: ../front/php/contatos.php');
        exit;
    } catch (Exception $e) {
        echo "Erro ao enviar a mensagem: " . $mail->ErrorInfo;
    }
} else {
    header('Location: ../front/php/contatos.php');
}
?>