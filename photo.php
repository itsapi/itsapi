<?
	include('include/inc.php');
	include($fileNames['photoProcess']);
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
			<h2><?='<a href="' . $fileNames['user'] . '?username=' . $userProfile['username'] . '">' . $userProfile['firstname'] . ' ' . $userProfile['lastname']?></a>'s Gallery</h2>
<?
				include($fileNames['loginForm']);
				include($fileNames['searchResults']);
				
				if ($loggedIn) {
					if ($currentUser['username'] == $userProfile['username']) {	
?>
			<form action="<? keepUrl(); ?>" method="post" enctype="multipart/form-data">
				<h3>Upload Picture:</h3>
				<label>Title: <input type="text" name="photoTitle"></label>: <input type="file" accept="image/jpeg image/jpg image/JPG" name="photoUpload"><input type="submit" value="Upload Photo">
			</form>
<?
					}
				}
				
				if ($photoExists) {
?>
			<h3 id="photoTitle"><?=$images[$photoKey]['title']?></h3>
			<h4><?=($photoKey + 1) . '/' . (count($images))?></h4>
			<p>Uploaded on <?=date('d/m/y G:i', $images[$photoKey]['date'])?></p>
			<a href="<?=$fileNames['viewPhoto']?>?iid=<?=$images[$photoKey]['iid']?>" target="_blank"><img src="<?=$fileNames['viewPhoto']?>?iid=<?=$images[$photoKey]['iid']?>&size=<?=$profilePagePictureSize?>" alt="<?=$images[$photoKey]['title']?>"></a>

			<section id="galleryButtons">
				<form action="javascript: copyToClipboard('<?=$domain?>/<?=$fileNames['photo']?>?iid=<?=$images[$photoKey]['iid']?>&username=<?=$userProfile['username']?>#photoTitle')">
					<input type="submit" value="Get image link">
				</form>
<?
					if ($loggedIn) {
						if ($currentUser['uid'] == $userProfile['uid']) {
?>
				<form action="<?=$fileNames['photo']?>?iid=<?=$images[$photoKey]['iid']?>" method="post">
					<input type="text" value="<?=$images[$photoKey]['iid']?>" name="profileImage" hidden>
					<input type="submit" value="Set as profile picture" name="setProfile">
				</form>
				<form action="<?=$fileNames['photo']?>?iid=<? if ($prev != $images[$photoKey]['iid']) { echo $prev; } else { echo $next; }?>" method="post">
					<input type="text" value="<?=$images[$photoKey]['iid']?>" name="profileImage" hidden>
					<input type="submit" value="Delete" name="deleteImage">
				</form>
<?
						}
					}
					if ($prev != $images[$photoKey]['iid']) {
?>
				<form action="<?=keepUrl()?>#photoTitle" method="get">
					<input type="text" value="<?=$prev?>" name="iid" hidden>
<?
						if (!$loggedIn || ($userProfile != $currentUser)) {
							echo "<input type=\"text\" value=\"{$userProfile['username']}\" name=\"username\" hidden>";
						}
?>
					<input type="submit" value="Previous">
				</form>
<?
					}
					if ($next != $images[$photoKey]['iid']) {
?>
				<form action="<?=keepUrl()?>#photoTitle" method="get">
					<input type="text" value="<?=$next?>" name="iid" hidden>
<?
						if (!$loggedIn || ($userProfile != $currentUser)) {
							echo "<input type=\"text\" value=\"{$userProfile['username']}\" name=\"username\" hidden>";
						}
?>
					<input type="submit" value="Next">
				</form>
			</section>
<?
					}
				}
?>
		</div>
		<?
			include($fileNames['footer']);
		?>
	</body>
</html>