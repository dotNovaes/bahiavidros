<?php
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

    #corpo dos emails
    $email_body = "Olá, $nome, <br><br>Agradecemos por entrar em contato conosco! Recebemos sua mensagem e nossa equipe entrará em contato com você dentro de 24 horas úteis. <br><br>Enquanto isso, você pode responder este email com o detalhamento do assunto para que possamos dar continuidade. <br><br>Atenciosamente, <br>Bahia Vidros";
    $email_altBody = "Olá, $nome, \n\nAgradecemos por entrar em contato conosco! Recebemos sua mensagem e nossa equipe entrará em contato com você dentro de 24 horas úteis. \n\nEnquanto isso, você pode responder este email com o detalhamento do assunto que gostaria de discutir. \n\nAtenciosamente, \nBahia Vidros";

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

    $mail->setFrom($email_user, 'Bahia Vidros'); // quem envia
    $mail->addAddress($emailCliente, $nome); // quem recebe

    $mail->CharSet = 'UTF-8';
    $mail->isHTML(true); 
    $mail->Subject = 'Contato - ' . $assunto;
    $mail->Body = $email_body;
    $mail->AltBody = $email_altBody;

    $mail->send();
        echo "A mensagem foi enviada!";
        header('Location: ../front/php/contatos.php');
        exit;
    } catch (Exception $e) {
        echo "Erro ao enviar a mensagem: " . $mail->ErrorInfo;
    }
} else {
    header('Location: ../front/php/contatos.php');
    exit;
}
?>