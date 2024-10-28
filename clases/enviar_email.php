<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../phpmailer/src/PHPMailer.php';
require '../phpmailer/src/SMTP.php';
require '../phpmailer/src/Exception.php';

$mail = new PHPMailer(true);

try {
    // Configuración del servidor SMTP
    // $mail->SMTPDebug = SMTP::DEBUG_SERVER;
    $mail->isSMTP();
    $mail->Host       = MAIL_HOST;
    $mail->SMTPAuth   = true;
    $mail->Username   = MAIL_USER;
    $mail->Password   = MAIL_PASS;
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port       = MAIL_PORT;

    // Configuración de remitente y destinatario
    $mail->setFrom('egamingshopsv@gmail.com', 'Ticket de compra');
    $mail->addAddress('salinas221133@gmail.com', 'Joe User');

    // Contenido del correo
    $mail->isHTML(true);
    $mail->Subject = 'Detalle de compra';
    $cuerpo = '<h4>Gracias por su compra</h4>';
    $cuerpo .= '<p>El ID de su compra es: <b>' . $id_transaccion . '</b></p>';

    $mail->Body    = $cuerpo;
    $mail->AltBody = 'Le enviamos los detalles de su compra';

    // Idioma para errores
    $mail->setLanguage('es', '../phpmailer/language/phpmailer.lang-es.php');

    // Enviar correo
    $mail->send();
    echo "Correo enviado correctamente";
} catch (Exception $e) {
    echo "Error al enviar el correo electrónico: {$mail->ErrorInfo}";
}
