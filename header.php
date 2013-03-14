		<header>
			<h1><a href="index.php"><?=$siteName?></a></h1>
			<div id="notifications">
<?
					if ($loggedIn) {
						include('friends.php');
						include('notifications.php');
					}
?>
			</div>
		</header>
