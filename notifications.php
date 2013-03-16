<?
	$notificationsToggle = $viewNotificationsButtonTxt;
	$notificationNum = numNotifications($mysqli, $currentUser);
?>
		<section id="notificationsList"></section>
		<form action="javascript: showNotifications()">
			<input type="submit" id="viewNotifications" value='<? echo $notificationsToggle; if ($notificationNum > 0) { echo " ({$notificationNum})"; } ?>'>
			<input type="text" id="viewProfile" value="<?=$topProfileToggle?>" hidden="yes">
		</form>
