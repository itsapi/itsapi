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
				s = document.getElementById('viewFriends')
				if (s.value == '<?=$viewFriendsButtonTxt?>') {
					s.value = '<?=$hideFriendsButtonTxt?>'
					formAction('viewFriends.php', ['viewFriends'], 'friendsList')
				} else {
					s.value = '<?=$viewFriendsButtonTxt?>'
					var elem = document.getElementById('friendsBar')
					elem.parentNode.removeChild(elem)
				}
			}
			function showNotifications() {
				s = document.getElementById('viewNotifications')
				if (s.value.indexOf('<?=$viewNotificationsButtonTxt?>') != -1) {
					s.value = '<?=$hideNotificationsButtonTxt?>'
					formActionValues('viewNotifications.php', ['uid'], ['<?=$currentUser['uid']?>'], 'notificationsList')
				} else {
					s.value = '<?=$viewNotificationsButtonTxt?>'
					var elem = document.getElementById('notificationsBar')
					elem.parentNode.removeChild(elem)
				}
			}
		</script>