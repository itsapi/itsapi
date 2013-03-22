<?
	include('inc.php');
	$postPage = True;
	include('postProcess.php');
	
	if (!isset($_GET['pid'])) {
		header ('location: index.php');
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
		<? include('head.php'); ?>
	</head>
	<body>
		<? include('header.php'); ?>
		<div id="main">
<?
		if (mysqli_num_rows($postResult) != 0) {
?>
			<h2><a href="user.php?username=<?=$profileData['username']?>"><?=$name?></a></h2>
<?
		}
		
		include('login/loginForm.php');
		include('searchResults.php');
		
		if (mysqli_num_rows($postResult) != 0) {
			
			if ($loggedIn) {
				$uid = $currentUser['uid'];
				include('submitComment.php');
			}
			
			include 'displayPosts.php';
		} else {
			echo $postNotExist;
		}
?>
		</div>
<?
				include('footer.php');
?>
	</body>
</html>