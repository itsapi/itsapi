<?
	$pid = $row['pid'];
	echo "\n\t\t\t<li>";
	if (isset($feed)) {
		$profileData = userData($row['uid'], $mysqli, 'uid');
		$postProfileData = $profileData;
		$name = $profileData['firstname'] . ' ' . $profileData['lastname'];
		echo "\n\t\t\t\t<a href=\"{$fileNames['user']}?username={$profileData['username']}\">" . profileImage($profileData, 'profilePhoto', $size=$thumbnailSize) . $name . "</a><br>";
	} elseif ($loggedIn && !isset($singlePost)) { $postProfileData = $currentUser; }
	echo removeLines(detectURL($row['content'])) . "<br>\n\t\t\t\t<span class=\"date\">" . date('d/m/y G:i', $row['date']) . '</span>';
	if ($loggedIn) {
		if ($row['uid'] == $currentUser['uid']) {
			echo "\n\n\t\t\t\t<form method=\"post\" action=\"" . keepUrl() . "\" style=\"display: inline\">\n\t\t\t\t\t<input type=\"text\" name=\"deletePost\" value=\"{$pid}\" hidden>\n\t\t\t\t\t<input type=\"submit\" value=\"Delete\">\n\t\t\t\t</form>";
			echo "\n\n\t\t\t\t<form method=\"get\" action=\"{$fileNames['editPost']}\" target=\"_blank\" style=\"display: inline\">\n\t\t\t\t\t<input type=\"text\" name=\"pid\" value=\"{$pid}\" hidden>\n\t\t\t\t\t<input type=\"submit\" value=\"Edit\">\n\t\t\t\t</form>";
			echo '<span class="pi">';
		} else {
			echo '<span class="pi">';
			if (isLiked($mysqli, $currentUser, $pid, 'post')) {
				echo ' - Already Given Pi';
			} else {
				if (isset($_POST['likePost']) && $_POST['likePost'] == $pid) {
					$addedLike = True;
				} else {
					$addedLike = False;
				}
				if ($addedLike != True) {
					echo "\n\n\t\t\t\t<form method=\"post\" action=\"" . keepUrl() . "\" style=\"display: inline\">\n\t\t\t\t\t<input type=\"text\" name=\"likePost\" value=\"{$pid}\" hidden>\n\t\t\t\t\t<input type=\"submit\" value=\"{$likeText}\">\n\t\t\t\t</form>";
				} else {
					echo ' - ' . putLike($mysqli, $currentUser, $pid, 'post');
				}
			}
		}
	}
	echo ' - Total Pi: ' . getLikes($mysqli, $pid, 'post') . " <a href=\"{$fileNames['post']}?pid={$pid}\">permalink</a>";
	include($fileNames['viewComments']);
	echo("\n\t\t\t</li>");
?>
