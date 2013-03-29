<?
	include($fileNames['inc']);
	include($fileNames['userProcess']);
	include($fileNames['userPostsProcess']);
	include($fileNames['postProcess']);
?>

<!DOCTYPE html>

<html>
	<head>
		<title><?=$profileName?></title>
		<? include($fileNames['head']); ?>
	</head>
	<body>
		<? include($fileNames['header']); ?>
		<div id="main">
<?
				if ($userExists) {
					if ($loggedIn) {
						if (isset($profileToggle)) {
							if ($profileToggle == $viewPostsButtonTxt) {
								$topProfileToggle = $viewProfileButtonTxt;
							} else {
								$topProfileToggle = $viewPostsButtonTxt;
							}
						} else {
							$profileToggle = Null;
						}
					}
				}
				if ($userExists) {
?>
			<h2>Profile - <?=$profileName?></h2>
			<?=profileImage($userProfile, 'profilePicBig', $profilePagePictureSize)?>
<?
					if ($loggedIn) {
						if ($currentUser['username'] != $userProfile['username']) {
							if (areFriends($mysqli, $currentUser['uid'], $userProfile['uid'])) {
?>
	<h4><?=str_replace('{profileName}', $profileName, $friendRequestAccepted)?></h4>
<?
							} else {
								include($fileNames['showAddFriend']);
							}
						}
					}
				}
				
				include($fileNames['loginForm']);
				include($fileNames['searchResults']);
				
				if ($userExists) {
					if ($pageViewable) {
						echo("\t\t<p>{$welcomeMessage}</p>\n");
						if ($loggedIn) {
							if ($userProfile != $currentUser) {
								echo("\t\t<p><a href=\"{$fileNames['messages']}?username={$userProfile['username']}\">Message</a></p>\n");
							}
						}
						echo("\t\t<p><a href=\"{$fileNames['photo']}?username={$userProfile['username']}\">{$userProfile['firstname']} {$userProfile['lastname']}'s Gallery</a></p>\n");
					} else {
						echo("\t\t<p>{$noPermission}</p>\n");
					}
					if ($pageViewable) {
					
?>
			<form method="post" action="<?=keepUrl()?>">
				<input type='submit' name='viewProfile' value='<?=$profileToggle?>'>
			</form>
<?
						include("{$fileNames[$fileName]}"); // defined in userProcess.php for toggle.
					}
				}
?>
		</div>
<?
			include($fileNames['footer']);
?>
	</body>
</html>