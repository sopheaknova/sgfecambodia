<?php
	$email_text = array();
	foreach($_POST as $key => $value){
		if($value != ""){
			$email_text[str_replace("_", " ",$key)] = stripcslashes($value);					
		}
	}
	$name = $email_text['name'];
	$email = $email_text['email'];
	$subject = $email_text['subject'];
	$to = "info@sgfe-cambodia.com";
	$message = $email_text['message'];
	$header = "From: ". $name . " <" . $email . ">\r\n";
	
	
	if(mail($to, $subject, $message, $header))
	{
		echo '<h4 align="center">Thank you for your enquiry. We will get back to you as soon as possilbe</h4>';
	}else{
		echo "Couldn\'t send email. Please try emailing me from your own account. Thank you.";
	}

?>