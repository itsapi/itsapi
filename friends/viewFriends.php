<?
	include '../include/inc.php';

	friends($mysqli, $currentUser, "<a href=\"{$fileNames['user']}?username={username}\">{firstname} {lastname}</a><form action=\"javascript: formActionValues('{$fileNames['deleteFriend']}', ['deleteFriend'], ['{fid}'], ''); formAction('{$fileNames['viewFriends']}', ['viewFriends'], 'friendsList');\" style=\"display: inline\"><input type=\"text\" id=\"deleteFriend\" value=\"{fid}\" hidden=\"yes\"><input type=\"text\" name=\"viewFriends\" value=\"{$viewFriendsButtonTxt}\" hidden=\"yes\"><input type=\"submit\" value=\"delete\"></form>", 'friendsBar');
