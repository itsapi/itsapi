		<header>
			<h1><a href="index.php"><?=$siteName?></a></h1>
			<div id="notifications">
<?
					if ($loggedIn) {
						include('friends.php');
						include('notifications.php');
						echo '<section id="notificationsList"></section>';
						echo '<section id="friendsList"></section>';
					}
?>
			</div>
		</header>
