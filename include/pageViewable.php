<?
	if ($loggedIn) {
		if ($userProfile['username'] == $currentUser['username']) {
			$pageViewable = 1;
		} else {
			if ($userProfile['privacy'] == 0 || $userProfile['privacy'] == 1) {
				$pageViewable = 1;
			} elseif ($userProfile['privacy'] == 2) {
				if (areFriends($mysqli, $currentUser['uid'] , $userProfile['uid'])) {
					$pageViewable = 1;
				} else {
					$pageViewable = 0;
				}
			} else {
				$pageViewable = 0;
			}
		}
	} else {
		if ($userProfile['privacy'] == 0) {
			$pageViewable = 1;
		} else {
			$pageViewable = 0;
		}
	}
