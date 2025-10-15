<?php
	$to = 'daanphin@gmail.com';
	$name = $email = $message = '';
	$subject = $headers = '';
	$nameError = $emailError = $messageError = $sendError = '';

	if (isset($_POST['submit'])){
		if(!empty($_POST['name'])){
			$name = htmlspecialchars($_POST['name']);
		}	
		else{
      $nameError = 'Naam is verplicht.';
    }
		if(!empty($_POST['email'])) {
			$email = htmlspecialchars($_POST['email']);
			if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
				$emailError = 'Dit is een ongeldige email.';
			}
		}
		else{
			$emailError = 'Email is verplicht.';
		}
		if(!empty($_POST['message'])) {
			$message = htmlspecialchars($_POST['message']);
		}
		else{
			$messageError = 'Geen bericht ingevuld.';
		}

		if(empty($nameError) && empty($emailError) && empty($messageError)){
			$subject = 'Message from: '.$name;
			$headers = "From: no-reply@yourdomain.com\r\nReply-To: $email";

			if(mail($to, $subject, $message, $headers)){
				header("Location: index.php?success=1#contact-section");
				exit;
      } else {
        $sendError = 'Er is iets misgegaan bij het verzenden.';
      }
		}
	}
?>