<?php
$errors         = array();  	// array to hold validation errors
$data 			= array(); 		// array to pass back data
$email          = $_POST['email'];

$to = 'matias@nyu.edu';
$subject = 'LOLA interest';
$message = $_POST['email']." is interested in LOLA!";

$headers = 'MIME-Version: 1.0'.PHP_EOL;
$headers .= 'Content-type: text/html; charset=iso-8859-1'.PHP_EOL;
$headers .= 'From: LOLA'.PHP_EOL; 


// validate the variables ======================================================

	if (empty($email))
		$errors['email'] = 'Email is required.';
	if (!filter_var($email, FILTER_VALIDATE_EMAIL))
		$errors['email'] = 'Please enter a valid email.';


// return a response ===========================================================

	if ( ! empty($errors) ) {

		$data['success'] = false;
		$data['errors']  = $errors;

	} else {

		if(mail($to, $subject, $message, $headers)){
			$data['success'] = true;
			$data['message'] = 'Success!';
		}
		else {

			$data['success'] = false;
			$errors['email'] = 'Error sending email.';
			
		}
	}

	echo json_encode($data);
?>