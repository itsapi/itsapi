<?
	if (isset($searchTerm)) {
		if (isset($searchResults)) {
			if (mysqli_num_rows($searchResults) == 0) {
				echo $searchError;
			} else {
				$searchTableTableFormat = explode('{row}', $searchTable);
				$searchTableRowFormat = explode('{cell}', $searchRow);
				$searchTableCellFormat = explode('{cellTxt}', $searchCell);
				$searchTableHeaderFormat = explode('{cellTxt}', $searchHeader);

				$rows = [];
				while ($row = mysqli_fetch_assoc($searchResults)) {
					$rows[] = $row;
				}
				
				include $fileNames['searchRelevance'];
				
				echo $searchTableTableFormat[0];
				foreach ($rows as $row) {
					echo str_replace('{link}', "{$fileNames['user']}?username={$row['username']}", $searchTableRowFormat[0]);
					foreach ($row as $key=>$value) {
						if (in_array($key, $searchTableHeadings)) {
							echo $searchTableCellFormat[0] . $value . $searchTableCellFormat[1];
						}
					}
					echo $searchTableRowFormat[1];
				}
				echo $searchTableTableFormat[1];
			}
		} else {
			echo $searchError;
		}
	} elseif (isset($_GET['term'])) {
		echo $searchNoTerm;
	}
