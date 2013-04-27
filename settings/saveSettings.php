<?
	if (isset($_POST['delete']) && $_POST['delete'] != '') {
		$msg .= deleteProfile($mysqli, htmlspecialchars($_POST['delete'], ENT_QUOTES));
	}
	if (isset($_POST['change'])) {
		
		$settingsFields = Array('firstname'=>htmlspecialchars($_POST['firstname'], ENT_QUOTES),
								'lastname'=>htmlspecialchars($_POST['lastname'], ENT_QUOTES),
								'address'=>htmlspecialchars($_POST['address'], ENT_QUOTES),
								'town'=>htmlspecialchars($_POST['town'], ENT_QUOTES),
								'county'=>htmlspecialchars($_POST['county'], ENT_QUOTES),
								'country'=>htmlspecialchars($_POST['country'], ENT_QUOTES),
								'postCode'=>htmlspecialchars($_POST['postCode'], ENT_QUOTES),
								'privacy'=>htmlspecialchars($_POST['privacy'], ENT_QUOTES));
		
		if ($_POST['password'] != '') {
			$md5_password = md5($username . md5(htmlspecialchars($_POST['oldPassword'], ENT_QUOTES)));
			
			if (mysqli_num_rows(query_DB($mysqli, "SELECT uid FROM users WHERE username='{$username}' AND password='{$md5_password}'")) == 0) {
				$msg .= $errorMsgs['incorrectPassword'];
				$error = True;
			} elseif (htmlspecialchars($_POST['password'], ENT_QUOTES) != htmlspecialchars($_POST['Vpassword'], ENT_QUOTES)) {
				$msg .= $errorMsgs['password'];
				$error = True;
			} elseif (strlen(htmlspecialchars($_POST['password'], ENT_QUOTES)) < $passLength) {
				$msg .= $errorMsgs['shortPassword'];
				$error = True;
			}
		}
		
		if (!$error) {
			$userSettings = Array();
			
			$query = 'UPDATE `main`.`users` SET';
			foreach($settingsFields as $key=>$field) {
				if ($field != '') {
					$query .= " `{$key}`='{$field}',";
				}
			}
			if ($_POST['password'] != '') {
				$password = md5($username . md5(htmlspecialchars($_POST['password'], ENT_QUOTES)));
				$query .= " password='{$password}',";
			}
			if (isset($_POST['emailNotifications'])) {
				$query .= " emailNotifications=True";
			} else {
				$query .= " emailNotifications=False";
			}
			
			if ($_POST['email'] != '') {
				$msg .= changeEmail($mysqli, $username, htmlspecialchars($_POST['email'], ENT_QUOTES));
			}
			
			if ($query == 'UPDATE `main`.`users` SET') {
				$msg .= $settingsNotChanged;
			} else {
				$query = rtrim($query, ',') . " WHERE `users`.`username`='{$username}';";
				$result = query_DB($mysqli, $query);
				if ($result) {
					$msg .= $settingsSaved;
					$currentUser = userData($username, $mysqli);
				}
			}
		}
	}
