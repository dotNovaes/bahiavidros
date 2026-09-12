<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'src/Exception.php';
require 'src/PHPMailer.php';
require 'src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $emailCliente = $_POST['email'];
    $mensagem = $_POST['mensagem'];

    $mail = new PHPMailer(true);

    try {

    $mail->isSMTP();
    $mail->SMTPAuth = true;
    $mail->Username = 'bahiavidrosoficial@gmail.com';
    $mail->Password = 'ftec quwj cpxt hbtk';
    $mail->SMTPSecure = 'tls';
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = 587;
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;

    // De quem pra onde
    $mail->setFrom('bahiavidrosoficial@gmail.com', 'Bahia Vidros');
    $mail->addAddress('$emailCliente, $nome'); // Quem vai receber a mensagem

    $mail->isHTML(true); 
    $mail->Body = "<b>Olá, $nome ($emailcliente)!<b> Vimos que gostaria de conversar sobre $assunto, responda este email para que possamos conversar sobre ;). <br> <br> <b>Atenciosamente,</b> <br> Bahia Vidros";
    $mail->AltBody = "Olá, $nome ($emailcliente)!\n Vimos que gostaria de conversar sobre $assunto, responda este email para que possamos conversar sobre ;). \nAtenciosamente,\nBahia Vidros";

    $mail->send();

    echo 'A mensagem foi enviada!';
    } catch (Exception $e) {
        echo "Erro ao enviar a mensagem: {$mail->ErrorInfo}";
    }
} else {
    header("Location: index.html");
}
