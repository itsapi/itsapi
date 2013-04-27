<?
	$notificationsToggle = $viewNotificationsButtonTxt;
?>
		<form action="javascript: showNotifications();">
			<input type="submit" id="viewNotifications" value='<?=$notificationsToggle?>'>
			<input type="text" id="viewProfile" value="<?=$topProfileToggle?>" hidden>
		</form>
		<span id="notNum"></span>
		<script>notificationLabel()</script>