<?
	error_reporting(E_ALL);
	ini_set('display_errors', 1);
	include('include/inc.php');
	if ($loggedIn) {
		include($fileNames['feed']);
		include($fileNames['postProcess']);
	}
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
			<h2>Hello!</h2>
			<p>Welcome to <?=$siteName?></p>
			<?
				include($fileNames['loginForm']);
				include($fileNames['searchResults']);
				if ($loggedIn) {
					include($fileNames['submitPost']);
					include($fileNames['viewPosts']);
				}
			?>
		</div>
		<?
			include($fileNames['footer']);
		?>
	</body>
</html>
