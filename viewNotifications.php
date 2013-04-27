<?
	include 'include/inc.php';

	$uid = $currentUser['uid'];
	$query = "SELECT * FROM `notifications` WHERE `uid`='{$uid}' ORDER BY date DESC LIMIT 0, 20";
	$result = query_DB($mysqli, $query);
	if ($result) {
		if (mysqli_num_rows($result) == 0) {
			echo("\t\t<p id=\"notificationsBar\">{$noNotifications}</p>\n");
		} else {
			echo("\t\t<ul id=\"notificationsBar\">\n");
			while ($notification = mysqli_fetch_assoc($result)) {
				echo("\t\t\t<li><a href=\"http://{$notification['link']}\">{$notification['title']}</a> <span class=\"date\">" . date('d/m/y G:i', $notification['date']) . "</span><form action=\"javascript: formActionValues('{$fileNames['deleteNotification']}', ['deleteNotif'], ['{$notification['nid']}'], ''); formAction('{$fileNames['viewNotifications']}', ['viewNotifications'], 'notificationsList')\" style=\"display: inline\"><input type=\"text\" id=\"deleteNotif\" value=\"{$notification['nid']}\" hidden><input type=\"text\" name=\"viewNotifications\" value=\"{$viewNotificationsButtonTxt}\" hidden=\"yes\"><input type=\"submit\" value=\"Delete\"></form></li>\n");
			}
			echo ("<form action=\"javascript: formAction('{$fileNames['deleteAllNotifications']}', ['deleteAll'], ''); formAction('{$fileNames['viewNotifications']}', ['viewNotifications'], 'notificationsList')\" style=\"display: inline\"><input type=\"submit\" id=\"deleteAll\" value=\"Delete all\"></form>");
			echo("\t\t</ul>");
		}
	}
