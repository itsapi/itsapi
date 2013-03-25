<?
	$commentsOffset = 0;
	if (mysqli_num_rows(query_DB($mysqli, "SELECT cid FROM comments WHERE pid={$pid}")) > $commentsLimit) {
		if (isset($_POST['commentsOlder']) && isset($_POST['commentsOffset' . $pid])) {
			$commentsOffset = $_POST['commentsOffset' . $pid] + $commentsLimit;
			$result3 = query_DB($mysqli, "SELECT cid FROM comments WHERE pid={$pid}");
			if ($commentsOffset > mysqli_num_rows($result3) - $commentsLimit) {
				$commentsOffset = mysqli_num_rows($result3) - $commentsLimit;
			}
		}
		if (isset($_POST['commentsNewer']) && isset($_POST['commentsOffset' . $pid])) {
			$commentsOffset = $_POST['commentsOffset' . $pid] - $commentsLimit;
			if ($commentsOffset < 0) {
				$commentsOffset = 0;
			}
		}
	}
	
	$query2 = "SELECT * FROM `comments` WHERE `pid`='{$pid}' ORDER BY `date` DESC LIMIT {$commentsOffset}, " . ($commentsLimit + $commentsOffset) . ";";
	$result2 = query_DB($mysqli, $query2);
	if (mysqli_num_rows($result2) != 0) {
		$comments = [];
		while ($row2 = mysqli_fetch_assoc($result2)) {
			array_unshift($comments, $row2);
		}
		echo("\n\n\t\t\t\t<form method=\"post\" action=\"" . keepUrl() . "\">\n\t\t\t\t\t<input type=\"text\" name=\"commentsOffset{$pid}\" value=\"{$commentsOffset}\" hidden>\n\t\t\t\t\t<input type=\"submit\" name=\"commentsOlder\" value=\"Show Older\">\n\t\t\t\t</form>\n\n\t\t\t\t<ul>");
		foreach ($comments as $comment) {
			$cid = $comment['cid'];
			$profileData = userData($comment['uid'], $mysqli, 'uid');
			$name = $profileData['firstname'] . ' ' . $profileData['lastname'];
			echo "\n\t\t\t\t\t<li>\n\t\t\t\t\t\t<a href=\"user.php?username={$profileData['username']}\">" . profileImage($profileData, 'profilePhoto', $thumbnailSize) . $name . "</a> - " . removeLines(detectURL($comment['content'], False)) . ' ' . "\n\t\t\t\t\t\t<span class=\"date\">" . date('d/m/y G:i', $comment['date']) . '</span>';
			if ($loggedIn) {
				if ($comment['uid'] == $currentUser['uid']) {
					echo "\n\n\t\t\t\t\t\t<form method=\"post\" action=\"" . keepUrl() . "\" style=\"display: inline\">\n\t\t\t\t\t\t\t<input type=\"text\" name=\"deleteComment\" value=\"{$comment['cid']}\" hidden>\n\t\t\t\t\t\t\t<input type=\"submit\" value=\"Delete\">\n\t\t\t\t\t\t</form>";
					echo '<span class="pi">';
				} else {
					echo '<span class="pi">';
					if (isLiked($mysqli, $currentUser, $cid, 'comment')) {
						echo ' - Already Given Pi';
					} else {
						if (isset($_POST['likeComment']) && $_POST['likeComment'] == $cid) {
							$addedLike = True;
						} else {
							$addedLike = False;
						}
						if ($addedLike != True) {
							echo "\n\n\t\t\t\t\t\t<form method=\"post\" action=\"" . keepUrl() . "\" style=\"display: inline\">\n\t\t\t\t\t\t\t<input type=\"text\" name=\"likeComment\" value=\"{$cid}\" hidden>\n\t\t\t\t\t\t\t<input type=\"submit\" value=\"{$likeText}\">\n\t\t\t\t\t\t</form>";
						} else {
							echo ' - ' . putLike($mysqli, $currentUser, $cid, 'comment');
						}
					}
				}
			}
			echo ' - Total Pi: ' . getLikes($mysqli, $cid, 'comment');
			echo "\n\t\t\t\t\t</li>";
		}
		echo("\n\t\t\t\t</ul>\n\n\t\t\t\t<form method=\"post\" action=\"" . keepUrl() . "\">\n\t\t\t\t\t<input type=\"text\" name=\"commentsOffset{$pid}\" value=\"{$commentsOffset}\" hidden>\n\t\t\t\t\t<input type=\"submit\" name=\"commentsNewer\" value=\"Show Newer\">\n\t\t\t\t</form>\n\n\t\t\t");
	}
	
	if ($loggedIn) {
?>

				<form name="submitCommentForm" method="post" action="<?=keepUrl()?>">
					<input type="text" name="pid" value="<?=$pid?>" hidden>
					<input type="text" name="puid" value="<?=$postProfileData['uid']?>" hidden>
					<textarea name="commentContent"><?=$errorCommentContent?></textarea><br>
					<input type="submit" name="submitComment" value="Submit Comment">
				</form>
<?
	}
?>
