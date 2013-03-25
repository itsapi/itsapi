<?
	if (isset($_GET['term']) && $_GET['term'] != '' && preg_replace('!\s+!', ' ', $_GET['term']) != ' ') {
		$searchTerm = htmlspecialchars($_GET['term'], ENT_QUOTES);
		$origSearchTerm = $searchTerm;
		$searchTerm = explode(' ', $searchTerm);
		
		$queryOr = "username LIKE '%{word}%' OR firstname LIKE '%{word}%' OR lastname LIKE '%{word}%'";
		$query = str_replace('{word}', $searchTerm[0], $queryOr);
		array_shift($searchTerm);
		
		foreach ($searchTerm as $word) {
			if ($word != '') {
				$query .= ' OR' . ' ' . str_replace('{word}', $word, $queryOr);
			}
		}
		
		$result = query_DB($mysqli, "SELECT * FROM users WHERE verify IS NULL AND ({$query}) LIMIT 0, 30");
		if ($result) {
			$searchResults = $result;
		}
	}
