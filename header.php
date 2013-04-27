<?
	if (isset($searchTerm)) {
		$searched_searchTerm = $origSearchTerm;
	} else {
		$searched_searchTerm = Null;
	}
?>
		<header>
			<h1><a href="index.php"><?=$siteName?></a></h1>
			<section id="search">
				<form method="get" action="<?= keepUrl() ?>">
					<label>Search Users: <input type="search" name="term" value="<?=$searched_searchTerm?>"></label>
					<input type="submit" value="Search">
				</form>
			</section>
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
