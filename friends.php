<?
	$friendsToggle = $viewFriendsButtonTxt;
	if (isset($_POST['viewFriends'])) {
		if ($_POST['viewFriends'] == $viewFriendsButtonTxt) {
			$friendsToggle = $hideFriendsButtonTxt;
			include("viewFriends.php");
		}
	}
?>
<form method="post" action="<?=keepUrl()?>">
			<input type='submit' name='viewFriends' value='<?=$friendsToggle?>'>
			<input type="text" name="viewProfile" value="<?=$topProfileToggle?>" hidden="yes">
		</form>
