<?
	include('inc.php');
	include('userProcess.php');
	include('userPostsProcess.php');
	include('postProcess.php');
?>

<!DOCTYPE html>

<html>
	<head>
		<title><?=$profileName?></title>
		<? include('head.php'); ?>
	</head>
	<body>
		<? include('header.php'); ?>
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
								include('showAddFriend.php');
							}
						}
					}
				}
				
				include('login/loginForm.php');
				include('searchResults.php');
				
				if ($userExists) {
					if ($pageViewable) {
						echo("\t\t<p>{$welcomeMessage}</p>\n");
						if ($loggedIn) {
							if ($userProfile != $currentUser) {
								echo("\t\t<p><a href=\"messages.php?username={$userProfile['username']}\">Message</a></p>\n");
							}
						}
						echo("\t\t<p><a href=\"photo.php?username={$userProfile['username']}\">{$userProfile['firstname']} {$userProfile['lastname']}'s Gallery</a></p>\n");
					} else {
						echo("\t\t<p>{$noPermission}</p>\n");
					}
					if ($pageViewable) {
					
?>
			<form method="post" action="<?=keepUrl()?>">
				<input type='submit' name='viewProfile' value='<?=$profileToggle?>'>
			</form>
<?
						include("{$fileName}.php"); // defined in userProcess.php for toggle.
					}
				}
?>
		</div>
<?
			include('footer.php');
?>
	</body>
</html>
