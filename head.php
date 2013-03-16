		<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
		<link rel="Stylesheet" href="normalize.css">
		<link rel="Stylesheet" href="style.css">
		<link href='http://fonts.googleapis.com/css?family=Open+Sans|Oxygen:400,700' rel='stylesheet' type='text/css'>
		<script src="js/google.js"></script>
		<script src="js/ajax.js"></script>
		<script>
			function hideMe(o) {
				document.getElementById(o).style.display = 'none'
			}
		</script>
		<script>
			function showFriends() {
				if (document.getElementById('viewFriends').value == '<?=$viewFriendsButtonTxt?>') {
					document.getElementById('viewFriends').value = '<?=$hideFriendsButtonTxt?>'
					formAction('viewFriends.php', ['viewFriends'], 'friendsList')
				} else {
					document.getElementById('viewFriends').value = '<?=$viewFriendsButtonTxt?>'
					var elem = document.getElementById('friendsBar')
					elem.parentNode.removeChild(elem)
				}
			}
			function showNotifications() {
				if (document.getElementById('viewNotifications').value == '<?=$viewNotificationsButtonTxt?>') {
					document.getElementById('viewNotifications').value = '<?=$hideNotificationsButtonTxt?>'
					formActionValues('viewNotifications.php', ['uid'], ['<?=$currentUser['uid']?>'], 'notificationsList')
				} else {
					document.getElementById('viewNotifications').value = '<?=$viewNotificationsButtonTxt?>'
					var elem = document.getElementById('notificationsBar')
					elem.parentNode.removeChild(elem)
				}
			}
		</script>