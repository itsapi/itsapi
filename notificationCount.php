<?
	include 'inc.php';

	$notificationNum = numNotifications($mysqli, $currentUser);
	$buttonText = explode("(",$_GET['viewNotifications'])[0];
	if ($notificationNum > 0) {
		echo $buttonText . ' (' . $notificationNum . ')';
	} else {
		echo $buttonText;
	}