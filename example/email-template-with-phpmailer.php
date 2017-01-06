<?php
/**
 * sending a message using a local sendmail binary.
	template file is mail.tpl.html
 */

require dirname(__FILE__).'/PHPMailer/PHPMailerAutoload.php';

require dirname(__FILE__).'/../src/Template.php';

$template_file = dirname(__FILE__).'/mail.tpl.html';

$template = new Template($template_file);

$TPLVAR = array();

$TPLVAR['username'] = $username;

$TPLVAR['email'] = $email;

$mail_body = $template->make($TPLVAR) ;

//Create a new PHPMailer instance
$mail = new PHPMailer;

//Set who the message is to be sent from
$mail->setFrom('sender@example.com', 'Sender Name',true);

//Set who the message is to be sent to
$mail->addAddress($email, $username);

//Set the subject line
$mail->Subject = 'Thank you for Subscribing';

//convert HTML into a basic plain-text alternative body
$mail->msgHTML( $mail_body );

//Replace the plain text body with one created manually
$mail->AltBody = 'This is a plain-text message body';

//Attach an image file
//$mail->addAttachment('images/phpmailer_mini.png');

//send the message, check for errors
if (!$mail->send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
} else {
    echo "Message sent!";
}
