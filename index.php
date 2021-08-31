<?php

error_reporting(E_ALL);
ini_set('display_errors', 'On');

require_once __DIR__ . '/vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
	
if ( strpos($_SERVER['HTTP_HOST'], "localhost") === false )
{
	$to      = "recipient@recipient.com";
	$subject = "Testing";
	
	/* HTML Content */
	$txt     = '<!DOCTYPE html><html><body><h2>Demo HTML Email</h2><form action="http://google.com"><input type="submit" value="Go to Google" /></form></body></html>';
	$headers = "MIME-Version: 1.0" . "\r\n" .
		"Content-type:text/html;charset=UTF-8" . "\r\n" .
		"From: noreply@gmail.com" . "\r\n" .
		"CC: other@guy.com" .
		'Reply-To: webmaster@example.com' . "\r\n" .
		'X-Mailer: PHP/' . phpversion();
		
	/* Text Content */
	/*
	$txt     = 'Demo Text Email';
	$headers = "From: noreply@gmail.com" . "\r\n" .
		"CC: other@guy.com" .
		'Reply-To: webmaster@example.com' . "\r\n" .
		'X-Mailer: PHP/' . phpversion();
	*/
	
	mail($to, $subject, $txt, $headers);
} 
else 
{
	$mail = new PHPMailer;
	$mail->IsSMTP(); 						   // telling the class to use SMTP
	
	$mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
	$mail->SMTPDebug  = 2;     				   // enables SMTP debug information (for testing) 1 = errors and messages, 2 = messages only
	$mail->SMTPAuth   = true;                  // enable SMTP authentication
	$mail->SMTPSecure = "tls";                 // sets the prefix to the server	
	$mail->Port       = 587;                   // set the SMTP port for the GMAIL server
	/*
	$mail->SMTPSecure = "ssl";                 
	$mail->Port       = 465;          
	*/
	$mail->Username   = "*****";  
	$mail->Password   = "*****";          
	$mail->addAddress("recipient@recipient.com", 'Recipient Recipient');
	$mail->Subject = "Testing";
	
	$mail->isHTML(true);
	$mail->setFrom("noreply@gmail.com", 'No Reply');

	// https://stackoverflow.com/questions/1851728/how-to-embed-images-in-html-email
	$mail->AddEmbeddedImage("rocks.png", "my-attach", "rocks.png");
	$mail->Body = 'Your <b>HTML</b> with an embedded Image: <img src="cid:my-attach"> Here is an image!';

	if (!$mail->send()) 
	{
		echo "Cannot send email";
	} 
	else 
	{
		echo "Email sent";			
	}	
}
