<?php
require 'PHPMailerAutoload.php';

$mail = new PHPMailer;

//$mail->SMTPDebug = 3;                               // Enable verbose debug output

$mail->SMTPDebug = 3;
$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.sertelinfo.com.br';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'contato@sertelinfo.com.br';                 // SMTP username
$mail->Password = '2016@contato';                           // SMTP password
$mail->SMTPSecure = 'false';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;                                    // TCP port to connect to
$mail->setLanguage('br');

$mail->SMTPOptions = array(
       'ssl' => array(
           'verify_peer' => false,
           'verify_peer_name' => false,
           'allow_self_signed' => true
        )
);

//$mail->addReplyTo('eduardof.microlins@gmail.com', 'gmail');
//$mail->sender = 'eduardof.microlins@gmail.com';

$mail->setFrom('eduardo@sertelinfo.com.br', 'Eduardo Ferreira');
$mail->addAddress('eduardo.junior.contato@hotmail.com', 'Eu');     // Add a recipient
//$mail->addAddress('ellen@example.com');               // Name is optional
//$mail->addCC('cc@example.com');
// $mail->addBCC('bcc@example.com');

// $mail->addAttachment(key($arquivo));    // Optional name
// $mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = 'Assunto';
$mail->Body    = 'Alô ! <b>tá me ouvindo?!</b>';
$mail->AltBody = ': )';

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message has been sent';
}