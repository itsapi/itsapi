<?
	$verifying_code = htmlspecialchars($_GET['verify'], ENT_QUOTES);
	$verifying_user = htmlspecialchars($_GET['user'], ENT_QUOTES);
	
	$result = mysqli_query($mysqli, "UPDATE `main`.`users` SET `verify`=NULL WHERE `users`.`username`='{$verifying_user}' AND `users`.`verify`='{$verifying_code}';");
	if (!$result) {
		echo queryError($mysqli);
	} else {
		if (mysqli_affected_rows($mysqli) != 0) {
			$msg .= wrap('p', str_replace('{username}', $verifying_user, $verifySuccess));
		} else {
			$msg .= wrap('p', $verifyAccount, 'error');
		}
	}
