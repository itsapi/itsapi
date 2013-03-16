<?
	include 'inc.php';

	$result = query_DB($mysqli, "DELETE FROM notifications WHERE nid=" . htmlspecialchars($_GET['deleteNotif'], ENT_QUOTES) . ';');