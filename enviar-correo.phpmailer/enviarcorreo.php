<?php
include '../config/loader.php';
$email = $_POST['email'];
$asunto = $_POST['asunto'];
$mensaje = $_POST['mensaje'];

$body = "Correo: ". $email."<br>Asunto: ".$asunto."<br>Mensaje: ".$mensaje; 

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'Exception.php';
require 'PHPMailer.php';
require 'SMTP.php';


$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = 0;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'paololeguizamon@gmail.com';                     //SMTP username
    $mail->Password   = 'dermann4210761';                               //SMTP password
    $mail->SMTPSecure = 'tls';         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 587;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Recipients
    $mail->setFrom('paololeguizamon@gmail.com','Paolo');
    $mail->addAddress($email, 'Cliente');

    //Attachments
    //$mail->addAttachment($adjunto);         //Add attachments
    //$mail->addAttachment($adjunto['adjunto'], ['name']);    //Optional name

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = $asunto;
    $mail->Body    = $body;
    $mail->CharSet = 'UTF-8';    
    //$mail->AddAttachment($adjunto['adjunto'],$adjunto['tmp_name']); 
    $mail->send();
    echo '<script>alert("Email enviado correctamente");window.location.href="index.php"</script>';
} catch (Exception $e) {
    echo "Error al enviar mensaje: {$mail->ErrorInfo}";
}
?>
