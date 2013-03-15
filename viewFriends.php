<?
	if (isset($_POST['deleteFriend'])) {
		$result = query_DB($mysqli, "DELETE FROM friends WHERE fid=" . htmlspecialchars($_POST['deleteFriend'], ENT_QUOTES) . ';');
	}
	friends($mysqli, $currentUser, "<a href=\"user.php?username={username}\">{firstname} {lastname}</a><form action=\"javascript: formAction('deleteFriend.php', ['deleteFriend']);\" style=\"display: inline\"><input type=\"text\" id=\"deleteFriend\" value=\"{fid}\" hidden=\"yes\"><input type=\"text\" name=\"viewFriends\" value=\"{$viewFriendsButtonTxt}\" hidden=\"yes\"><input type=\"submit\" value=\"delete\"></form>", 'friendsBar');
