<?
	include('inc.php');
	if ($loggedIn) {
		include('feed.php');
		include('postProcess.php');
	}
?>

<!DOCTYPE html>

<html>
	<head>
		<title><?=$siteName?></title>
		<? include('head.php'); ?>
	</head>
	<body>
		<? include('header.php'); ?>
		<div id="main">
			<?
				include('login/loginForm.php');
				include('searchResults.php');
				if ($loggedIn) {
					include 'submitPost.php';
					include 'viewPosts.php';
				}
			?>
		</div>
		<?
			include('footer.php');
		?>
	</body>
</html>
