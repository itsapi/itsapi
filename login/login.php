<?
	session_start();
	
	$msg = "";
	$error = False;
	
	if ((isset($_SESSION['username']) OR isset($_COOKIE['username']))) { // Logged on:
		if (isset($_SESSION['username'])) {
			if (mysqli_num_rows(query_DB($mysqli, "SELECT uid FROM users WHERE username='" . htmlspecialchars($_SESSION['username'], ENT_QUOTES) . "'")) != 0) {
				include('login/loggedIn.php');
				$username = $_SESSION['username'];
				$notLoggedIn = False;
			} else {
				$notLoggedIn = True;
			}
		} else {
			if (mysqli_num_rows(query_DB($mysqli, "SELECT uid FROM users WHERE username='" . htmlspecialchars($_COOKIE['username'], ENT_QUOTES) . "'")) != 0) {
				include('login/loggedIn.php');
				$username = $_COOKIE['username'];
				$notLoggedIn = False;
			} else {
				$notLoggedIn = True;
			}
		}
		if (isset($username)) { query_DB($mysqli, "UPDATE users SET lastActivity='" . time() . "' WHERE username='" . $username . "'"); }
	} else {
		$notLoggedIn = True;
	}
	
	if ($notLoggedIn) { // Not logged on:
		if (isset($_POST['login'])) { // Logging in:
			include('login/loggingIn.php');
		} else {
			$loggedIn = False;
		}
		if (isset($_POST['signup'])) { // Registering script:
			include('login/register.php');
		}
		if (isset($_POST['forgotPass'])) {
			$msg .= forgotPass($mysqli, htmlspecialchars($_POST['forgotPassUser'], ENT_QUOTES));
		}
		if (isset($_GET['resend'])) {
			$resend_userData = userData(htmlspecialchars($_GET['resend'], ENT_QUOTES), $mysqli);
			$msg .= verify($resend_userData, $resend_userData['verify']);
		}
		if (isset($_GET['resendPass'])) {
			$msg .= forgotPass(mysqli, htmlspecialchars($_GET['resendPass'], ENT_QUOTES));
		}
		if (isset($_POST['resetPass'])) {
			$msg .= resetPass($mysqli, htmlspecialchars($_POST['resetPassUser'], ENT_QUOTES), htmlspecialchars($_POST['password'], ENT_QUOTES), htmlspecialchars($_POST['Vpassword'], ENT_QUOTES), htmlspecialchars($_POST['resetPassCode'], ENT_QUOTES));
		}
		if (isset($_GET['verify'])) {
			include('login/verify.php');
		}
	}

	if (isset($_GET['changeEmail']) && isset($_GET['user']) && isset($_GET['email'])) {
		$user = htmlspecialchars($_GET['user'] ,ENT_QUOTES);
		$changeEmail = htmlspecialchars($_GET['changeEmail'] ,ENT_QUOTES);
		$email = htmlspecialchars($_GET['email'] ,ENT_QUOTES);
		$result = query_DB($mysqli, "UPDATE users SET changeEmail=NULL, email='{$email}' WHERE username='{$user}' AND changeEmail='{$changeEmail}'");
		if ($result) {
			$msg .= $changeEmailSuccess;
		} else {
			$msg .= $changeEmailFail;
		}
	}
	
