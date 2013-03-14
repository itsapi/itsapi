<? // Logged in

	$loggedIn = True;
	if (isset($_SESSION['username'])) {
		$username = htmlspecialchars($_SESSION['username'], ENT_QUOTES);
	} else {
		$username = htmlspecialchars($_COOKIE['username'], ENT_QUOTES);
	}
	
	if (isset($_POST['logout'])) { // Logging out
		include('login/logout.php');
	} else {
		$currentUser = userData($username, $mysqli);
	}
