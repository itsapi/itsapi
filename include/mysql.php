<?
	function queryError($mysqli){
		return 'MySQLi query failed: (' . mysqli_errno($mysqli) . ') ' . mysqli_error($mysqli);
	}
	$mysqli = mysqli_connect('localhost', $mysqlUser, $mysqlPass, $mysqldb);
	if (mysqli_connect_errno($mysqli)) {
		printf("Connect failed: %s\n", mysqli_connect_error());
	}
