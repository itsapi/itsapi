<script>
	function hideMe(o) {
			document.getElementById(o).style.display = 'none'
		}
		function showFriends() {
			var s = document.getElementById('viewFriends')
			if (s.value == '<?=$viewFriendsButtonTxt?>') {
				s.value = '<?=$hideFriendsButtonTxt?>'
				formAction('<?=$fileNames['viewFriends']?>', ['viewFriends'], 'friendsList')
				if (document.getElementById('viewNotifications').value.indexOf('<?=$hideNotificationsButtonTxt?>') != -1) {
					showNotifications()
				}
			} else {
				s.value = '<?=$viewFriendsButtonTxt?>'
				var elem = document.getElementById('friendsBar')
				elem.parentNode.removeChild(elem)
			}
		}
		function showNotifications() {
			var s = document.getElementById('viewNotifications')
			if (s.value.indexOf('<?=$viewNotificationsButtonTxt?>') != -1) {
				s.value = '<?=$hideNotificationsButtonTxt?>'
				formAction('<?=$fileNames['viewNotifications']?>', ['viewProfile'], 'notificationsList')
				if (document.getElementById('viewFriends').value.indexOf('<?=$hideFriendsButtonTxt?>') != -1) {
					showFriends()
				}
			} else {
				s.value = '<?=$viewNotificationsButtonTxt?>'
				var elem = document.getElementById('notificationsBar')
				elem.parentNode.removeChild(elem)
			}
		}
		function notificationLabel() {
			formAction('<?=$fileNames['notificationCount']?>', ['viewNotifications'], 'buttonValue')
			var s = document.getElementById('viewNotifications')
			s.value = document.getElementById('buttonValue').innerText
		}
		function copyToClipboard (text) {
			window.prompt ("Copy to clipboard: Ctrl+C, Enter", text);
		}
	</script>