<?
	echo("<section>\n");
	foreach ($userInfoColumns as $column) {
		echo "\t\t\t" . wrap('p', $humanColumnTitles[$column] . $infoSeperator . $userProfile[$column]) . "\n";
	}
	if (isset($userProfile)) {
		$userFriends = $userProfile;
	} else {
		$userFriends = $currentUser;
	}
	echo '<h4>Friends:</h4>';
	friends($mysqli, $userFriends, "<a href=\"user.php?username={username}\">{firstname} {lastname}</a>");
	echo("\t\t</section>\n");
?>
