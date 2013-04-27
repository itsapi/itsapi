<?
	$uid = $currentUser['uid'];
	$uid2 = friendUids($mysqli, $currentUser);
	$uid2[] = $currentUser['uid'];
	$lim = $feedLimit;
	$feed = True;
