<?
	$loggingIn_username = htmlspecialchars($_POST['username'], ENT_QUOTES);
	$loggingIn_password = htmlspecialchars($_POST['password'], ENT_QUOTES);
	
	$md5_password = md5($loggingIn_username . md5($loggingIn_password));
	
	$result = mysqli_query($mysqli, "SELECT `verify` FROM `users` WHERE username='{$loggingIn_username}' AND password='{$md5_password}';");
	if (!$result) {
		echo queryError($mysqli);
		$loggedIn = False;
	} else {
		if (mysqli_num_rows($result) == 0) {
			$msg .= wrap('p', $loginFail, 'error');
			$loggedIn = False;
		} else {
			$row = mysqli_fetch_assoc($result);
			if ($row['verify'] == Null) {
				$_SESSION['username'] = $loggingIn_username;
				include($fileNames['loggedIn']);
				$msg .= wrap('p', str_replace('{username}', $username, $loginWelcome));
				if ($_POST['rememberMe'] = 'remember') {
					setcookie('username', $username, time()+60*60*24*30);
				}
			} else {
				$msg .= wrap('p', str_replace('{url}', keepUrl('resend=' . $loggingIn_username), $verifyLogin), 'error');
				$loggedIn = False;
			}
		}
	}
	mysqli_free_result($result);
	if (!$loggedIn) {
		$error = True;
	}
