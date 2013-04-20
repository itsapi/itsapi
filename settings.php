<?
	include('include/inc.php');
	include($fileNames['saveSettings']);
?>

<!DOCTYPE html>

<html>
	<head>
		<title>Profile Settings</title>
		<? include($fileNames['head']); ?>
	</head>
	<body>
		<? include($fileNames['header']); ?>
		<div id="main">
			<h2>Profile Settings</h2>
			<div id="main">
<?
				include($fileNames['loginForm']);
				include($fileNames['searchResults']);
				include($fileNames['settingsForm']);
?>
			</div>
<?
				include($fileNames['footer']);
?>
	</body>
</html>
