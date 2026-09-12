<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'src/Exception.php';
require 'src/PHPMailer.php';
require 'src/SMTP.php';
$mail = new PHPMailer(true);


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $emailCliente = $_POST['email'];
    $assunto = $_POST['assunto'];
    $mail = new PHPMailer(true);

try
{
    $mail->isSMTP();
    $mail->SMTPAuth = true;
    $mail->Username = 'bahiavidrosoficial@gmail.com';
    $mail->Password = 'ftec quwj cpxt hbtk';
    $mail->SMTPSecure = 'tls';
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = 587;
    $mail->setFrom('bahiavidrosoficial@gmail.com', 'Bahia Vidros');

// Remetente e Destinatário
        $mail->addAddress('destinatario@dominio.com', 'Seu Nome'); // Quem vai receber a mensage

    // Conteúdo da mensagem
    $mail->isHTML(true);  // Seta o formato do e-mail para aceitar conteúdo HTML
    $mail->Subject = '$assunto - Bahia Vidros';
    $mail->Body    = '<b>Olá, $nome!<b> Vimos que gostaria de conversar sobre $assunto, responda este email para que possamos conversar sobre ;). <br> <br> <b>Atenciosamente,</b> <br> Bahia Vidros';
    $mail->AltBody = 'Olá! Vimos que gostaria de conversar sobre $assunto, responda este email para que possamos conversar sobre ;). Atenciosamente, Bahia Vidros';
    // Enviar
    $mail->send();
    echo 'A mensagem foi enviada!';
}
catch (Exception $e)
{
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

} else {
    echo "Metodo invalido.";
}

?>