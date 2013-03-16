<?
	$notificationsToggle = $viewNotificationsButtonTxt;
	$notificationNum = numNotifications($mysqli, $currentUser);
?>
		<form action="javascript: showNotifications()">
			<input type="submit" id="viewNotifications" value='<? echo $notificationsToggle; if ($notificationNum > 0) { echo " ({$notificationNum})"; } ?>'>
			<input type="text" id="viewProfile" value="<?=$topProfileToggle?>" hidden>
		</form>
		<div id="buttonValue" style="display:none;"></div>