<?
	if (isset($_POST['deleteComment'])) {
		$deleteCid = htmlspecialchars($_POST['deleteComment'], ENT_QUOTES);
		if (query_DB($mysqli, "DELETE FROM comments WHERE cid={$deleteCid}")) {
			$msg .= wrap('p', $commentDeleted);
		}
	}
