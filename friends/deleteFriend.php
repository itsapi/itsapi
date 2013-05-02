<?
	include '../include/inc.php';

	$result = query_DB($mysqli, "DELETE FROM friends WHERE fid=" . htmlspecialchars($_GET['deleteFriend'], ENT_QUOTES) . ';');