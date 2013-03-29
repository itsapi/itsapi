<?
	include('inc.php');
	include('saveSettings.php');
?>

<!DOCTYPE html>

<html>
	<head>
		<title>Profile Settings</title>
		<? include('head.php'); ?>
	</head>
	<body>
		<? include('header.php'); ?>
		<div id="main">
			<h2>Profile Settings</h2>
			<div id="main">
<?
				include('login/loginForm.php');
				include('searchResults.php');
				include('settingsForm.php');
?>
			</div>
<?
				include('footer.php');
?>
	</body>
</html>
