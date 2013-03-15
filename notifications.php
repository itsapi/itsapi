<?
	$notificationsToggle = $viewNotificationsButtonTxt;
	if (isset($_POST['viewNotifications'])) {
		if (strstr($_POST['viewNotifications'], $viewNotificationsButtonTxt)) {
			$notificationsToggle = $hideNotificationsButtonTxt;
			include("viewNotifications.php");
		}
	}
	$notificationNum = numNotifications($mysqli, $currentUser);
?>
		<form method="post" action="<?=keepUrl()?>">
			<input type="submit" name="viewNotifications" value='<? echo $notificationsToggle; if ($notificationNum > 0) { echo " ({$notificationNum})"; } ?>'>
			<input type="text" name="viewProfile" value="<?=$topProfileToggle?>" hidden="yes">
		</form>
