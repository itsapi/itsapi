<?	
	if (isset($feed) || ($currentUser['uid'] == $userProfile['uid'])) {
		if ($error) {
			$errorPostContent = htmlspecialchars($_REQUEST['postContent'], ENT_QUOTES);
		} else {
			$errorPostContent = Null;
		}
?>
<form name="createPost" method="post" action="<?=keepUrl()?>">
			<label>Create Post<br><textarea name="postContent"><?=$errorPostContent?></textarea></label><br>
			<input type="submit" name="submitPost" value="Submit">
		</form>
<?
	}
?>
