<?
	include($fileNames['inc']);
?>

<!DOCTYPE html>

<html>
	<head>
		<title><?=$siteName?></title>
		<? include($fileNames['head']); ?>
	</head>
	<body>
		<? include($fileNames['header']); ?>
		<div id="main">
			<h2>Messages</h2>
<?
				if (!$loggedIn) { header('location: ' . $fileNames['index']); }
				
				if (isset($_GET['username'])) {
					if ($_GET['username'] == $currentUser['username']) {
						header('location: ' . $fileNames['messages']);
					}
					$messagesOffset = 0;
					$uidTo = userData(htmlspecialchars($_GET['username'], ENT_QUOTES), $mysqli)['uid'];
		
					if (isset($_POST['older'])) {
						$messagesOffset = $_POST['messagesOffset'] + $messagesLimit - 5;
						$result = query_DB($mysqli, "SELECT mid FROM messages WHERE (uidTo='{$currentUser['uid']}' AND uidFrom='{$uidTo}') OR (uidTo='{$uidTo}' AND uidFrom='{$currentUser['uid']}')");
						if ($messagesOffset > mysqli_num_rows($result) - $messagesLimit) {
							$messagesOffset = mysqli_num_rows($result) - $messagesLimit;
						}
					}
		
					if (isset($_POST['newer'])) {
						$messagesOffset = $_POST['messagesOffset'] - $messagesLimit;
						if ($messagesOffset < 0) {
							$messagesOffset = 0;
						}
					}
					
					$userProfile = userData(htmlspecialchars($_GET['username'], ENT_QUOTES), $mysqli);
					if (count($userProfile) == 0) {
						$msg .= wrap('p', $userNotExist, 'error');
						$userExists = False;
					} else {
						$userExists = True;
					}
					
					if ($userExists) {
						$profileData = userData(htmlspecialchars($_GET['username'],ENT_QUOTES), $mysqli);
						$name = $profileData['firstname'] . " " . $profileData['lastname'];
						$userViewingUsername = htmlspecialchars($_GET['username'], ENT_QUOTES);
						echo("\nReturn to <a href=\"{$fileNames['user']}?username={$userViewingUsername}\">{$name}.</a>");
					}
				}
				include($fileNames['loginForm']);
				include($fileNames['searchResults']);
				
				if (isset($_GET['username']) && $userExists) {
					
					echo "<form action=\"{$fileNames['messages']}?username={$_GET['username']}\" method=\"post\"><input type=\"submit\" name=\"older\" value=\"Show Older\"><ul>";
?>
					<section id="messagesList">
					
					</section>
<?
					echo "</ul><input type=\"text\" id=\"messagesOffset\" name=\"messagesOffset\" value=\"{$messagesOffset}\" hidden><input type=\"submit\" name=\"newer\" value=\"Show Newer\"></form>";
?>
	<form action="javascript: formAction('<?=$fileNames['sendMessage']?>', ['messageText', 'username'], ''); document.getElementById('messageText').value = '';">
		<input type="text" id="messageText" autofocus>
		<input type="text" id="username" value="<?=$_GET['username']?>" hidden>
		<input type="submit" value="Send">
	</form>
				<script>
					var timeout = 1000;
					var action = function() {
						formAction($fileNames['messageView'], ['messagesOffset', 'username'], 'messagesList');
					};
					setInterval(action, timeout);				
					
				</script>
<?
				} else {

					$namesForMessages = [];

					$result = query_DB($mysqli, "SELECT uid1, uid2 FROM friends WHERE (uid1={$currentUser['uid']} OR uid2={$currentUser['uid']}) AND `acc1`=1 AND `acc2`=1");
					if ($result) {
						if (mysqli_num_rows($result) != 0) {
							while ($friendship = mysqli_fetch_assoc($result)) {
								foreach ($friendship as $friendUid) {
									if ($friendUid != $currentUser['uid']) {
										$uidsForMessages[] = $friendUid;
									}
								}
							}
						}
					}
					
					$result = query_DB($mysqli, "SELECT uidFrom, uidTo FROM messages WHERE uidFrom={$currentUser['uid']} OR uidTo={$currentUser['uid']}");
					if ($result) {
						if (mysqli_num_rows($result) != 0) {
							while ($message = mysqli_fetch_assoc($result)) {
								foreach ($message as $msgUserUid) {
									if ($msgUserUid != $currentUser['uid']) {
										$uidsForMessages[] = $msgUserUid;
									}
								}
							}
						}
					}
					if (isset($uidsForMessages)) {
						$clean = [];
						foreach ($uidsForMessages as $uidForMessages) {
							if (!in_array($uidForMessages, $clean)) {
								$clean[] = $uidForMessages;
							}
						}

						sort($clean);

						echo '<ul>';
						foreach ($clean as $uid) {
							$user = userData($uid, $mysqli, 'uid');
							echo str_replace(['{username}', '{firstname}', '{lastname}'], [$user['username'], $user['firstname'], $user['lastname']], "<li>{firstname} {lastname} <a href=\"messages.php?username={username}\">View messages</a></li>\n");
						}
						echo '</ul>';
					} else {
						echo wrap('p', $noFriends, 'error');
					}
				}
?>
		</div>
<?
			include($fileNames['footer']);
?>
	</body>
</html>
