<?
	if ($_POST['photoTitle'] == '') {
		$msg .= wrap('p', $photoNoTitle, 'error');
	} elseif ($_FILES['photoUpload']['tmp_name'] == '' && $_FILES['photoUpload']['size'] > 0) {
		$msg .= wrap('p', 'You upload a picture.', 'error');
	} elseif ($_FILES['photoUpload']['size'] > 2097152) {
		$msg .= wrap('p', 'Sorry, you\'re picture was too big.', 'error');
	} else {
		$imageTitle = htmlspecialchars($_POST['photoTitle'], ENT_QUOTES);

		$tmpName = $_FILES['photoUpload']['tmp_name'];
		
		$fp = fopen($tmpName, 'r');
		$data = fread($fp, filesize($tmpName));
		$data = addslashes($data);
		fclose($fp);
		
		$photoUploadTime = time();
		
		$result = query_DB($mysqli, "INSERT INTO images (uid, title, date, image) VALUES ('{$currentUser['uid']}', '{$imageTitle}', '{$photoUploadTime}', '{$data}');");
		if ($result) {
			$result = query_DB($mysqli, "SELECT iid FROM images WHERE uid='{$currentUser['uid']}' AND date='{$photoUploadTime}' ;");
			if ($result) {
				$uploadedIid = mysqli_fetch_assoc($result)['iid'];
				print_r($imageSize);
				header("location: {$fileNames['photoUploadRedirect']}?iid={$uploadedIid}");
			}
		}
	}
