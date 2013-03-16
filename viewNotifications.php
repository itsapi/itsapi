<?
	include 'inc.php';

	$uid = $currentUser['uid'];
	$query = "SELECT * FROM `notifications` WHERE `uid`='{$uid}' ORDER BY date DESC LIMIT 0, 20";
	$result = query_DB($mysqli, $query);
	if ($result) {
		if (mysqli_num_rows($result) == 0) {
			echo("\t\t<p id=\"notificationsBar\">{$noNotifications}</p>\n");
		} else {
			echo("\t\t<ul id=\"notificationsBar\">\n");
			while ($notification = mysqli_fetch_assoc($result)) {
				echo("\t\t\t<li><a href=\"http://{$notification['link']}\">{$notification['title']}</a> <span class=\"date\">" . date('d/m/y G:i', $notification['date']) . "</span><form action=\"javascript: formActionValues('deleteNotification.php', ['deleteNotif'], ['{$notification['nid']}'], ''); formAction('viewNotifications.php', ['viewNotifications'], 'notificationsList'); notificationLabel();\" style=\"display: inline\"><input type=\"text\" id=\"deleteNotif\" value=\"{$notification['nid']}\" hidden=\"yes\"><input type=\"text\" name=\"viewNotifications\" value=\"{$viewNotificationsButtonTxt}\" hidden=\"yes\"><input type=\"submit\" value=\"Delete\"></form></li>\n");
			}
			echo("\t\t</ul>");
		}
	}
