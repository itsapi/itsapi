<?
	include 'inc.php';
	$timeDiff = time() - $verifyTimeOut;
	if ($timeDiff < 0) { $timeDiff = 0; }
	$result = query_DB($mysqli, "DELTE FROM users WHERE lastActivity<'{$timeDiff}' AND verify");
