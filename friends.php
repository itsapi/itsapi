<?
	$friendsToggle = $viewFriendsButtonTxt;
?>
<section id="friendsList"></section>
<form action="javascript: showFriends();">
			<input type="submit" id="viewFriends" value="<?=$friendsToggle?>">
			<input type="text" id="viewProfile" value="<?=$topProfileToggle?>" hidden="yes">
		</form>
