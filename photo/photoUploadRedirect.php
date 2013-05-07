<?
		include '../include/inc.php';
?>
<html>
	<head>
		<title>Photo Successfully Uploaded!</title>
		<script>
			alert('Your photo was successfully uploaded :D')
			window.location.replace('<?=$fileNames['photo']?>?iid=<?=htmlspecialchars($_GET['iid'], ENT_QUOTES)?>');
		</script>
	</head>
</html>
