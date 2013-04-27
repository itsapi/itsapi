<?
	if (isset($searchTerm)) {
		$searched_searchTerm = $origSearchTerm;
	} else {
		$searched_searchTerm = Null;
	}
?>
		<header>
			<h1><a href="<?=$fileNames['index']?>"><?=$siteName?></a></h1>
			<section id="search">
				<form method="get" action="<?= keepUrl() ?>">
					<label>Search Users: <input type="search" name="term" value="<?=$searched_searchTerm?>"></label>
					<input type="submit" value="Search">
				</form>
			</section>
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
