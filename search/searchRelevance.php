<?
	$weightRows = Array();
	$termsRows = Array();
	foreach ($rows as $row) {
		$joinedTerms = $row['username'] . $row['firstname'] . $row['lastname'];
		similar_text($origSearchTerm, $joinedTerms, $p);		
		$weightRows[] = $p;
	}
	array_multisort($weightRows, SORT_DESC, SORT_NUMERIC, $rows);
