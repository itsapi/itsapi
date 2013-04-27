<?
	if (is_array($uid2)) {
		$query = "SELECT * FROM `posts` WHERE `uid`='{$uid2[0]}'";
		array_shift($uid2);
		
		foreach ($uid2 as $fUid) {
			$query .= " OR `uid`='{$fUid}'";
		}
	} else {
		$query = "SELECT * FROM `posts` WHERE `uid`='{$uid2}'";
	}
	
	if (mysqli_num_rows(query_DB($mysqli, $query)) > $lim){
		$postsOffset = 0;	
		if (isset($_POST['older'])) {
			$postsOffset = $_POST['postsOffset'] + $lim;
			$result = query_DB($mysqli, $query);
			if ($postsOffset > mysqli_num_rows($result) - $lim) {
				$postsOffset = mysqli_num_rows($result) - $lim;
			}
			
		}
		if (isset($_POST['newer'])) {
			$postsOffset = $_POST['postsOffset'] - $lim;
			if ($postsOffset < 0) {
				$postsOffset = 0;
			}
		}
	} else {
		$postsOffset = 0;
	}
	
	$query .= " ORDER BY `date` DESC LIMIT {$postsOffset}, " . ($postsOffset + $lim) . ';';
	$result = query_DB($mysqli, $query);
	if (mysqli_num_rows($result) == 0) {
		echo $noPosts;
	} else {
		echo("\n\t\t<section id=\"posts\">\n\t\t\t<form method=\"post\" action=\"" . keepUrl() . "\">\n\t\t\t\t<input type=\"text\" name=\"postsOffset\" value=\"{$postsOffset}\" hidden>\n\t\t\t\t<input type=\"submit\" name=\"newer\" value=\"Show Newer\">\n\t\t\t</form>\n\n\t\t\t<ul>");
		while ($row = mysqli_fetch_assoc($result)) {
			include $fileNames['displayPosts'];
		}
		echo("\n\t\t\t</ul>\n\n\t\t\t<form method=\"post\" action=\"" . keepUrl() . "\">\n\t\t\t\t<input type=\"text\" name=\"postsOffset\" value=\"{$postsOffset}\" hidden>\n\t\t\t\t<input type=\"submit\" name=\"older\" value=\"Show Older\">\n\t\t\t</form>\n\t\t</section>\n");
	}
