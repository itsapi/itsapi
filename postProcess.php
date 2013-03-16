<?
	if ($loggedIn) { include('submitComment.php'); }
	include('commentProcess.php');
	
	if (isset($_POST['deletePost'])) {
		$deletePid = htmlspecialchars($_POST['deletePost'], ENT_QUOTES);
		$result = query_DB($mysqli, "DELETE FROM posts WHERE pid={$deletePid};");
		query_DB($mysqli, "DELETE FROM comments WHERE pid={$deletePid};");
		if ($result) {
			$msg .= wrap('p', $successDeletePost);
		} else {
			$msg .= wrap('p', $unsuccessDeletePost, 'error');
		}
	}
	
	if (isset($_REQUEST['postContent'])) {			
		if ($_REQUEST['postContent'] == '') {
			$msg .= $noContentPost;
			$error = True;
		}
		if (!$error) {
			$content = htmlspecialchars($_REQUEST['postContent'], ENT_QUOTES);
			$result = query_DB($mysqli, "INSERT INTO `posts` (`uid`, `date`, `content`) VALUES ('{$uid}', '" . time() . "', '{$content}')");
			if ($result) {
				$msg .= $postSuccess;
			} else {
				$msg .= $postFail;
			}
		}
	}