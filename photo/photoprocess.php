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
			header ('location: index.php');
			$userExists = False;
		}
	}
	$profileName = $userProfile['firstname'] . ' ' . $userProfile['lastname'];
	include('pageViewable.php');

	if (isset($_POST['photoTitle']) && $currentUser == $userProfile) {
		include('photoUpload.php');
	}
	
	$photoExists = True;
	if ($pageViewable) {
		
		if (isset($_GET['iid'])) { $iid = $_GET['iid']; } else { $iid = ''; }
		$getUserGalleryOutput = getUserGallery($mysqli, $userProfile, $iid, $photoExists);
		$photoExists = $getUserGalleryOutput[0];
		$msg .= $getUserGalleryOutput[1];
		if ($photoExists) {
			$images = $getUserGalleryOutput[2];
			$key = $getUserGalleryOutput[3];
			$next = $getUserGalleryOutput[4];
			$prev = $getUserGalleryOutput[5];
		}
		
		if (isset($_POST['setProfile']) && $userProfile['uid'] == $currentUser['uid']) {
			if (updateProfileImage($userProfile['uid'], htmlspecialchars($_POST['profileImage'], ENT_QUOTES), $mysqli)) {
				$msg .= wrap('p', 'Sucsessfuly set image as profile picture!');
			} else {
				$msg .= wrap('p', 'Unsucsessfuly set image as profile picture.', 'error');
			}
		}
		if (isset($_POST['deleteImage']) && $userProfile['uid'] == $currentUser['uid']) {
			if (deleteImage(htmlspecialchars($_POST['profileImage'], ENT_QUOTES), $mysqli)) {
				$msg .= wrap('p', 'Sucsessfuly deleted picture!');
			} else {
				$msg .= wrap('p', 'Unsucsessfuly deleted picture.', 'error');
			}
			if (isset($_GET['iid'])) { $iid = $_GET['iid']; } else { $iid = ''; }
			$getUserGalleryOutput = getUserGallery($mysqli, $userProfile, $iid, $photoExists);
			$photoExists = $getUserGalleryOutput[0];
			$msg .= $getUserGalleryOutput[1];
			if ($photoExists) {
				$images = $getUserGalleryOutput[2];
				$key = $getUserGalleryOutput[3];
				$next = $getUserGalleryOutput[4];
				$prev = $getUserGalleryOutput[5];
			}
		}
		
	} else {
		$photoExists = False;
		$msg .= wrap('p', 'You do not have permission to view this page.', 'error');
	}
