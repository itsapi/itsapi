<?
	include($fileNames['inc']);
	$postPage = True;
	include($fileNames['postProcess']);
	
	if (!isset($_GET['pid'])) {
		header ('location: ' . $fileNames['index']);
	}
	
	$singlePost = True;
	
	$pid = htmlspecialchars($_GET['pid'], ENT_QUOTES);
	
	$query = "SELECT * FROM `posts` WHERE `pid`='{$pid}'";
	$postResult = query_DB($mysqli, $query);
	
	if (mysqli_num_rows($postResult) != 0) {
		$row = mysqli_fetch_assoc($postResult);
		
		$profileData = userData($row['uid'], $mysqli, 'uid');
		$postProfileData = $profileData;
		$name = $profileData['firstname'] . ' ' . $profileData['lastname'];
	}
?>

<!DOCTYPE html>

<html>
	<head>
		<title>Post <? if (mysqli_num_rows($postResult) != 0) { echo $row['pid']; } ?></title>
		<? include($fileNames['head']); ?>
	</head>
	<body>
		<? include($fileNames['header']); ?>
		<div id="main">
<?
		if (mysqli_num_rows($postResult) != 0) {
?>
			<h2><a href="<?=$fileNames['user']?>?username=<?=$profileData['username']?>"><?=$name?></a></h2>
<?
		}
		
		include($fileNames['loginForm']);
		include($fileNames['searchResults']);
		
		if (mysqli_num_rows($postResult) != 0) {
			
			if ($loggedIn) {
				$uid = $currentUser['uid'];
				include($fileNames['submitComment']);
			}
			
			include($fileNames['displayPosts']);
		} else {
			echo $postNotExist;
		}
?>
		</div>
<?
				include($fileNames['footer']);
?>
	</body>
</html>