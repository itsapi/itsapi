		<header>
			<h1><a href="<?=$fileNames['index']?>"><?=$siteName?></a></h1>
			<div id="notifications">
<?
					if ($loggedIn) {
						include($fileNames['friends']);
						include($fileNames['notifications']);
						echo '<section id="notificationsList"></section>';
						echo '<section id="friendsList"></section>';
					}
?>
			</div>
		</header>
