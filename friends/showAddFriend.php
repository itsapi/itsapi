<?
	$uid1 = $currentUser['uid'];
	$uid2 = $userProfile['uid'];
	
	$query = "SELECT * FROM `friends` WHERE `uid1`='{$uid1}' AND `uid2`='{$uid2}' AND `acc1`=1";
	$result = query_DB($mysqli, $query);
	
	if (mysqli_num_rows($result) == 0) {
?>
<form action="<?= keepUrl() ?>" method="post">
	<input type="text" hidden="yes" name="uid" value="<?=$userProfile['uid']?>">
	<input type="submit" value="Add friend">
</form>
<?
	} else {
		$msg .= $friendRequestSent;
	}
?>
