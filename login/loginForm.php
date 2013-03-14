
<?
	if ($msg != '') {
?>
		<section id="msg">
			<?=$msg . "\n"?>
			<a id="deleteMsg" onclick="hideMe('msg')">X</a>
		</section>
<?
	}
	if ($loggedIn == True) {
?>

		<section>
			<p>Hello <a href="user.php?username=<?= $username ?>"><?= $username ?></a>!</p>
			<form method="post" action="<?= keepUrl() ?>" style="display: inline">
				<input type="submit" name="logout" value="Logout">
			</form>
			<form method="post" action="settings.php" style="display: inline">
				<input type="submit" value="Settings">
			</form>
			<form method="post" action="photo.php" style="display: inline">
				<input type="submit" value="Photos">
			</form>
			<form method="post" action="messages.php" style="display: inline">
				<input type="submit" value="Messages">
			</form>
		</section>
<?
	} else {
		$loginError_firstname = Null;
		$loginError_lastname = Null;
		$loginError_username = Null;
		
		$signUpError_firstname = Null;
		$signUpError_lastname = Null;
		$signUpError_username = Null;
		$signUpError_email = Null;
		if ($error) {
			if (isset($signUp_username)) {
				$signUpError_firstname = $signUp_firstname;
				$signUpError_lastname = $signUp_lastname;
				$signUpError_username = $signUp_username;
				$signUpError_email = $signUp_email;
			} else {
				$loginError = True;
				$loginError_username = $loggingIn_username;
			}
		}
?>
<section>
			<?
				if (isset($_GET['resetPass']) && isset($_GET['user'])) {
					$user = htmlspecialchars($_GET['user'] ,ENT_QUOTES);
					$resetPass = htmlspecialchars($_GET['resetPass'] ,ENT_QUOTES);
					$result = query_DB($mysqli, "SELECT uid FROM users WHERE username='{$user}' AND passReset='{$resetPass}'");
					if (mysqli_num_rows($result) == 1) {
			?>
			<h4><label form="resetPassForm">Reset Password</label></h4>
			<form method="post" action="<?= keepUrl() ?>" id="resetPassForm">
				<label>New Password: <input type="password" name="password"></label><br>
				<label>Verify Password: <input type="password" name="Vpassword"></label><br>
				<input type="text" value="<?=$_GET['user']?>" name="resetPassUser" hidden>
				<input type="text" value="<?=$_GET['resetPass']?>" name="resetPassCode" hidden>
				<input type="submit" value="Reset Password" name="resetPass">
			</form>
			<?
					}
				}
			?>
			<h4><label form="loginForm">Login</label></h4>
			<form method="post" action="<?= keepUrl() ?>" id="loginForm">
				<label>Username: <input type="text" name="username" value="<?=$loginError_username?>"></label><br>
				<label>Password: <input type="password" name="password"></label><br>
				<label><input type="checkbox" name="rememberMe" value="remember">Remember me</label><br>
				<input type="submit" name="login" value="Login">
			<?
				if (isset($loginError)) {
			?>
				<input type="submit" value="Forgotten Password?" name="forgotPass">
				<input type="text" value="<?=$loginError_username?>" name="forgotPassUser" hidden>
			<?
				}
			?>
			</form>
		</section>

		<section>
			<h4><label form="registerForm">Register</label></h4>
			<form method="post" action="<?= keepUrl() ?>" id="registerForm">
				<label>Firstname: <input type="text" name="firstname" value="<?=$signUpError_firstname?>"></label><br>
				<label>Lastname: <input type="text" name="lastname" value="<?=$signUpError_lastname?>"></label><br>
				<label>Username: <input type="text" name="username" value="<?=$signUpError_username?>"></label><br>
				<label>Email: <input type="email" name="email" value="<?=$signUpError_email?>"></label><br>
				<label>Password: <input type="password" name="password"></label><br>
				<label>Verify Password: <input type="password" name="Vpassword"></label><br>
				<input type="submit" name="signup" value="Sign Up">
			</form>
		</section>
<?
	} // End of logged in if
?>
