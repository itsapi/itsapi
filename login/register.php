<?
	$signUp_firstname = htmlspecialchars($_POST['firstname'], ENT_QUOTES);
	$signUp_lastname = htmlspecialchars($_POST['lastname'], ENT_QUOTES);
	$signUp_username = htmlspecialchars($_POST['username'], ENT_QUOTES);
	$signUp_password = htmlspecialchars($_POST['password'], ENT_QUOTES);
	$signUp_Vpassword = htmlspecialchars($_POST['Vpassword'], ENT_QUOTES);
	$signUp_email = htmlspecialchars($_POST['email'], ENT_QUOTES);

	if ($signUp_firstname == '') {
		$msg .= $errorMsgs['firstname'];
		$error = True;
	}
	if ($signUp_lastname == '') {
		$msg .= $errorMsgs['lastname'];
		$error = True;
	}
	if ($signUp_username == '') {
		$msg .= $errorMsgs['username'];
		$error = True;
	}
	if (strlen($signUp_username) < $userLength) {
		$msg .= $errorMsgs['shortUsername'];
		$error = True;
	}
	if ($signUp_password != $signUp_Vpassword) {
		$msg .= $errorMsgs['password'];
		$error = True;
	}
	if (strlen($signUp_password) < $passLength) {
		$msg .= $errorMsgs['shortPassword'];
		$error = True;
	}
	if ($signUp_password == '') {
		$msg .= $errorMsgs['noPassword'];
		$error = True;
	}
	if ($signUp_email == '') {
		$msg .= $errorMsgs['email'];
		$error = True;
	}

	if (!$error) {
		$result = mysqli_query($mysqli, "SELECT `username` FROM `users` WHERE username='{$signUp_username}';");
		if (!$result) {
			echo queryError($result);
		} else {
			if (mysqli_num_rows($result) == 0) {
				mysqli_free_result($result);
				$verifyCode = RandNumber($verifyCodeLength);
				$md5_password = md5($signUp_username . md5($signUp_password));
				$result = mysqli_query($mysqli, "INSERT INTO `users` (`uid`, `username`, `firstname`, `lastname`, `password`, `email`, `verify`) VALUES (NULL, '{$signUp_username}', '{$signUp_firstname}', '{$signUp_lastname}', '{$md5_password}', '{$signUp_email}', '{$verifyCode}');");
				if (!$result) {
					echo queryError($mysqli);
				} else {
					$msg .= wrap('p',str_replace('{username}', $signUp_username, $registerWelcome));
					include('verifying.php');
				}
			} else {
				$msg .= $errorMsgs['takenUsername'];
				$error = True;
			}
		}
	}
