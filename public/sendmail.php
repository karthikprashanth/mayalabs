<?php
 
require_once($_SERVER['DOCUMENT_ROOT'].'/mailer/class.phpmailer.php');
$mail = new PHPMailer();
$mail->IsSMTP();
$mail->Host = 'ssl://smtp.gmail.com:465';
$mail->SMTPAuth = TRUE;
$mail->Username = "admin@hiveusers.com";
$mail->Password = "swordfish";
$mail->From = "admin@hiveusers.com";
$mail->FromName = "Srivathsa";
$body="html content";
$text_body="alternate text content";
$mail->Body = $body;
$mail->AltBody = $text_body;
$mail->AddAddress("pv.srivathsa@gmail.com", 'Srivathsa');
if(!$mail->Send())
echo "There has been a mail error sending to " . $row[3] . // Clear all addresses and attachments for next loop
$mail->ClearAddresses();
?>