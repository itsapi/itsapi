<?
	$userData = array();
	$userData['firstname'] = $signUp_firstname;
	$userData['lastname'] = $signUp_lastname;
	$userData['email'] = $signUp_email;
	$userData['username'] = $signUp_username;

	$msg .= verify($userData, $verifyCode);
