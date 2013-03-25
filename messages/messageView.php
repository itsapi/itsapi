<?
	include('inc.php');
	
	$messagesOffset = $_GET['messagesOffset'];
	$uidTo = userData(htmlspecialchars($_GET['username'], ENT_QUOTES), $mysqli)['uid'];
	
	$result = query_DB($mysqli, "SELECT message, date, uidFrom FROM messages WHERE ((uidTo='{$currentUser['uid']}' AND uidFrom='{$uidTo}') OR (uidTo='{$uidTo}' AND uidFrom='{$currentUser['uid']}')) ORDER BY date DESC LIMIT {$messagesOffset}, {$messagesLimit};");
	if ($result) {
		$messages = [];
		while ($row = mysqli_fetch_assoc($result)) {
			array_unshift($messages, $row);
		}
		foreach ($messages as $message) {
			echo '<li class="';
			if ($message['uidFrom'] == $currentUser['uid']){
				echo 'userMsg';
			} else {
				echo 'friendMsg';
			}
			$messageUserInfo = userData($message['uidFrom'], $mysqli, 'uid');
			echo "\"><a 
			href=\"user.php?username={$messageUserInfo['username']}\">{$messageUserInfo['firstname']}</a>{$infoSeperator}" . textWrap(detectURL($message['message'], False)) . " <span class=\"date\">" . date('d/m/y G:i', $message['date']) . '</span></li>';
		}
	}
