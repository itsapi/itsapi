<?	
	include('inc.php');
?>

<!DOCTYPE html>

<html>
	<head>
		<title><?=$siteName?></title>
		<? include('head.php'); ?>
		<script src="js/ajax.js"></script>
	</head>
	<body>
		<? include('header.php'); ?>
		<div id="main">
			<h2>Messages</h2>
<?
				if (!$loggedIn) { header('location: index.php'); }
				
				if (isset($_GET['username'])) {
					if ($_GET['username'] == $currentUser['username']) {
						header('location: messages.php');
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
						echo("\nReturn to <a href=\"user.php?username={$userViewingUsername}\">{$name}.</a>");
					}
				}
				include('login/loginForm.php');
				include('searchResults.php');
				
				if (isset($_GET['username']) && $userExists) {
					
					echo "<form action=\"messages.php?username={$_GET['username']}\" method=\"post\"><input type=\"submit\" name=\"older\" value=\"Show Older\"><ul>";
?>
					<section id="messagesList">
					
					</section>
<?
					echo "</ul><input type=\"text\" id=\"messagesOffset\" name=\"messagesOffset\" value=\"{$messagesOffset}\" hidden><input type=\"submit\" name=\"newer\" value=\"Show Newer\"></form>";
?>
	<form action="javascript: formAction('sendMessage.php', ['messageText', 'username'], ''); document.getElementById('messageText').value = ''; formAction('messageView.php', ['messagesOffset', 'username'], 'messagesList');">
		<input type="text" id="messageText" autofocus>
		<input type="text" id="username" value="<?=$_GET['username']?>" hidden>
		<input type="submit" value="Send">
	</form>
				<script>
					var timeout = 1000;
					var action = function() {
						formAction('messageView.php', ['messagesOffset', 'username'], 'messagesList');
					};
					setInterval(action, timeout);				
					
				</script>
<?
				} else {
					friends($mysqli, $currentUser, '{firstname} {lastname} <a href="messages.php?username={username}">View messages</a>', '');
				}
?>
		</div>
<?
			include('footer.php');
?>
	</body>
</html>

