<?
	include('inc.php');
	
	if (isset($_GET['pid'])) {
		$pid = htmlspecialchars($_GET['pid'], ENT_QUOTES);
		
		$saveError = Null;
		$javascript = Null;
		
		if (isset($_POST['editedPostContent'])) {
			$editedPostContent = htmlspecialchars($_REQUEST['editedPostContent'], ENT_QUOTES);
			$result = query_DB($mysqli, "UPDATE posts SET content='{$editedPostContent}' WHERE pid={$pid}");
			if ($result) {
				$javascript = "<script>\nwindow.opener.location.reload();\nwindow.close();\n</script>";
			} else {
				$saveError = wrap('p', $notSaved, 'error');
			}
		}
	} else {
		header('location: index.php');
	}
?>

<!DOCTYPE html>

<html>
	<head>
		<title><?=$siteName?></title>
		<? include('head.php'); ?>
		<?=$javascript?>
	</head>
	<body>
		<?			
			$result = query_DB($mysqli, "SELECT uid, content FROM posts WHERE pid='{$pid}';");
			$post = mysqli_fetch_assoc($result);
			if ($loggedIn && $post['uid'] == $currentUser['uid']) {
		?>
		<form method="post" action="<?=keepUrl()?>">
			<textarea name="editedPostContent" autofocus><?=str_replace('<br>', "\n", $post['content'])?></textarea>
			<input type="submit" value="Save">
			<?=$saveError?>
		</form>
		
		<?
			} else {
				echo wrap('p', $noPermissionEdit, 'error');
			}
		?>
	</body>
</html>
