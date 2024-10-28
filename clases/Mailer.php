<?php 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class MAiler {
    function enviarEmail($email, $asunto, $cuerpo) {
        require_once __DIR__ . '/../config/config.php'; 
        require __DIR__ . '/../phpmailer/src//PHPMailer.php';
        require __DIR__ . '/../phpmailer/src/SMTP.php';
        require __DIR__ . '/../phpmailer/src/Exception.php';

        $mail = new PHPMailer(true);
try {
    //Server settings
    //$mail->SMTPDebug = SMTP::DEBUG_SERVER; //SMTP::DEBUG_OFF;
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = MAIL_HOST;                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = MAIL_USER;                     //SMTP username
    $mail->Password   = MAIL_PASS;                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = MAIL_PORT;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('egamingshopsv@gmail.com', 'Activacion de cuenta');
    $mail->addAddress($email, ''); // Agregar el destinatario (el nombre es opcional)

   
    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = $asunto;

    $cuerpo = $cuerpo;

    $mail->Body    =  utf8_decode($cuerpo);

    $mail->setLanguage('es', 'phpmailer../language/phpmailer.lang-es.php');

   if ($mail->send()){
    return true;
   }else{
       return false;
   }
    //echo 'Message has been sent'
} catch (Exception $e) {
    echo "Error al enviar el correo electronico no de la cuenta: {$mail->ErrorInfo}";
    return false;
}
    }
}
?>