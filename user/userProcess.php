<?
	if (isset($_GET['username'])) {
		if ($loggedIn && $_GET['username'] == $currentUser['username']) {
			header ("location: {$_SERVER['PHP_SELF']}");
			$userExists = False;
		} else {
			$userProfile = userData(htmlspecialchars($_GET['username'], ENT_QUOTES), $mysqli);
			if (count($userProfile) == 0) {
				$msg .= wrap('p', 'That user does not exist', 'error');
				$userExists = False;
			} else {
				$userExists = True;
			}
		}
	} else {
		if ($loggedIn) {
			$userProfile = $currentUser;
			$userExists = True;
		} else {
			header ('location: ' . $fileNames['index']);
			$userExists = False;
		}
	}
	$profileName = $userProfile['firstname'] . ' ' . $userProfile['lastname'];
	include($fileNames['pageViewable']);
	
	if ($loggedIn) {
		if (isset($_REQUEST['uid'])) {
			include($fileNames['addFriend']);
		}
	}
	if ($pageViewable) {
		$profileToggle = $viewProfileButtonTxt;
		if (isset($_POST['viewProfile'])) {
			if ($_POST['viewProfile'] == $viewProfileButtonTxt) {
				$profileToggle = $viewPostsButtonTxt;
				$fileName = 'userInfo';
			} else {
				$fileName = 'userPosts';
			}
		} else {
			$fileName = 'userPosts';
		}
	}
