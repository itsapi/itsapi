<?
	$commentError = Null;
	
	if (isset($_REQUEST['submitComment'])) {
		$pid = htmlspecialchars($_POST['pid'], ENT_QUOTES);
		$puid = htmlspecialchars($_POST['puid'], ENT_QUOTES);
		if ($_REQUEST['commentContent'] == '') {
			echo($noContentComment);
			$commentError = True;
		}
		
		if (!$commentError) {
			$content = htmlspecialchars($_REQUEST['commentContent'], ENT_QUOTES);
			$query3 = "INSERT INTO `comments` (`pid`, `uid`, `date`, `content`) VALUES ('{$pid}', '{$uid}', '" . time() . "', '{$content}')";
			$result3 = query_DB($mysqli, $query3);
			if ($result3) {
						$msg .= wrap('p', $commentSuccessful);
						$title = "Comment from {$currentUser['firstname']} {$currentUser['lastname']}.";
						$link = "{$domain}/{$fileNames['post']}?pid={$pid}";
						if ($puid != $uid) { notification($mysqli, $puid, $title, $link); }
			} else {
						$msg .= wrap('p', $commentFailed, 'error');
			}
		}
	}
	
	if ($commentError) {
		$errorCommentContent = htmlspecialchars($_REQUEST['commentContent'], ENT_QUOTES);
	} else {
		$errorCommentContent = Null;
	}
