<?
	include 'inc.php';

	$result = query_DB($mysqli, "DELETE FROM notifications WHERE uid='{$currentUser['uid']}'");