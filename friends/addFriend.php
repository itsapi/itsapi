<?
	$uid1 = $currentUser['uid'];
	$uid2 = htmlspecialchars($_REQUEST['uid'], ENT_QUOTES);
	
	$relationLoc = "WHERE (`uid1`='{$uid1}' AND `uid2`='{$uid2}') OR (`uid2`='{$uid1}' AND `uid1`='{$uid2}')";
	$query = "SELECT * FROM `friends` {$relationLoc}";
	$result = query_DB($mysqli, $query);
	
	if (mysqli_num_rows($result) != 0) {
		$row = mysqli_fetch_assoc($result);
		if ($row['uid1'] == $uid1) {
			$acc = 'acc1';
		}
		if ($row['uid2'] == $uid1) {
			$acc = 'acc2';
		}
		$query = "UPDATE `friends` SET `{$acc}`=1 {$relationLoc}";
		$result = query_DB($mysqli, $query);
		
		$name = $currentUser['firstname'] . ' ' . $currentUser['lastname'];
		$title = str_replace('{name}', $name, $nowFriends);
		$link = "{$domain}/{$fileNames['user']}?username={$currentUser['username']}";
		notification($mysqli, $uid2, $title, $link);
		
		header("location: {$fileNames['user']}?username={$userProfile['username']}");
	} else {
		$query = "INSERT INTO `friends` (`uid1`, `uid2`, `acc1`, `acc2`) VALUES ('{$uid1}', '{$uid2}', 1, 0)";
		$result = query_DB($mysqli, $query);
		
		$name = $currentUser['firstname'] . ' ' . $currentUser['lastname'];
		$title = "Friend request from {$name}.";
		$link = "{$domain}/{$fileNames['user']}?uid={$uid1}&username={$currentUser['username']}";
		notification($mysqli, $uid2, $title, $link);
		
		header("location: {$fileNames['user']}?username={$userProfile['username']}");
	}
