<?
	$notificationsToggle = $viewNotificationsButtonTxt;
	$notificationNum = numNotifications($mysqli, $currentUser);
?>
		<section id="notificationsList"></section>
		<form action="javascript: showNotifications()">
			<input type="submit" name="viewNotifications" value='<? echo $notificationsToggle; if ($notificationNum > 0) { echo " ({$notificationNum})"; } ?>'>
			<input type="text" name="viewProfile" value="<?=$topProfileToggle?>" hidden="yes">
		</form>
