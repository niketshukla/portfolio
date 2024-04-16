<?php

require_once './vendor/autoload.php';

$name = strip_tags($_POST['name']);
$email = strip_tags($_POST['email']);
$subject = strip_tags($_POST['subject']);
$description = strip_tags($_POST['message']);


$to = "info@nextdecipher.com";
$subject = $subject;
$emailBody = "<html>
					<head>
					<title>HTML email</title>
					</head>
					<body>
					<p>New Contact Request came from site Next Decipher</p>
					<p>Details:<p>
					Name: $name <br>
					Email: $email <br>
					Subject: $subject <br>
					Message: $description <br>
					</body>
					</html>";

$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

try {
	// Create the Transport
	$transport = (new Swift_SmtpTransport('smtp.gmail.com', 465, 'ssl'))
		->setUsername('nextdecipher@gmail.com')
		->setPassword('this@decode04');

	// Create the Mailer using your created Transport
	$mailer = new Swift_Mailer($transport);

	// Create a message
	$message = (new Swift_Message())
		->setSubject($subject)
		->setFrom(['nextdecipher@gmail.com' => $name])
		->setTo([$to => 'Niket Shukla'])
		->setBody($emailBody, 'text/html');

	// Send the message
	$result = $mailer->send($message);
	
	if($result) {
		echo json_encode([
			'success' => true,
			'message' => 'Request sent Successfully!',
			'result' => $result,
		]);
	} else {
		echo json_encode([
			'success' => false,
			'message' => 'Failed to send email!',
			'result' => 'no error message',
		]);	
	}
} catch (Exception $e) {
	echo json_encode([
		'success' => false,
		'message' => 'Failed to send email!',
		'result' => $e->getMessage(),
	]);
}

?>
