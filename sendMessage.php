<?
		include('include/inc.php');
		
		$uidTo = userData(htmlspecialchars($_GET['username'], ENT_QUOTES), $mysqli)['uid'];
		
		if (isset($_GET['messageText'])) {
			$result = query_DB($mysqli, "INSERT INTO messages (message, date, uidFrom, uidTo) VALUES ('" . htmlspecialchars($_GET['messageText'], ENT_QUOTES) . "', '" . time() . "', '{$currentUser['uid']}', '{$uidTo}');");
			
			if ($_COOKIE['lastMessage' . $uid] < time() - $timeOut) {
				notification($mysqli, $uidTo, $messageFrom . $currentUser['username'], "{$domain}/{$fileNames['messages']}?username={$currentUser['username']}");
			}
			setcookie('lastMessage' . $uid, time());
		}
		
