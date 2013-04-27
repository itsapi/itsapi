<?
	include 'include/inc.php';

	$notificationNum = numNotifications($mysqli, $currentUser);
	$buttonText = $_GET['viewNotifications'];
	if ($notificationNum > 0) {
		echo $buttonText . ' (' . $notificationNum . ')';
	} else {
		echo $buttonText;
	}