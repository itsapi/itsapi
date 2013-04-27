<?
	function getExtension($str) {
	         $i = strrpos($str,".");
	         if (!$i) { return ""; } 
	         $l = strlen($str) - $i;
	         $ext = substr($str,$i+1,$l);
	         return $ext;
	}

	$tmpName = $_FILES['photoUpload']['tmp_name'];
	$name = $_FILES['photoUpload']['name'];
	$extension = strtolower(getExtension($name));

	if ($_POST['photoTitle'] == '') {
		$msg .= wrap('p', $photoNoTitle, 'error');
	} elseif ($_FILES['photoUpload']['tmp_name'] == '' && $_FILES['photoUpload']['size'] > 0) {
		$msg .= wrap('p', 'You upload a picture.', 'error');
	} elseif ($_FILES['photoUpload']['size'] > 2097152) {
		$msg .= wrap('p', 'Sorry, you\'re picture was too big.', 'error');
	} elseif (($extension != "jpg") && ($extension != "jpeg") && ($extension != "png") && ($extension != "gif")) {
		$msg .= ' Unknown Image extension ';
	} else {
		$imageTitle = htmlspecialchars($_POST['photoTitle'], ENT_QUOTES);
		
		$fp = fopen($tmpName, 'r');
		$data = fread($fp, filesize($tmpName));
		$data = addslashes($data);
		fclose($fp);
		
		$photoUploadTime = time();

		if($extension=="jpg" || $extension=="jpeg" ) {
			$src = imagecreatefromjpeg($tmpName);
		}
		else if($extension=="png") {
			$src = imagecreatefrompng($tmpName);
		}
		else {
			$src = imagecreatefromgif($tmpName);
		}
		
		list($width,$height)=getimagesize($tmpName);

		$newwidth=60;
		$newheight=($height/$width)*$newwidth;
		$thumbnail=imagecreatetruecolor($newwidth,$newheight);

		imagecopyresampled($thumbnail,$src,0,0,0,0,$newwidth,$newheight,$width,$height);

		$result = query_DB($mysqli, "INSERT INTO images (uid, title, date, image, thumbnail) VALUES ('{$currentUser['uid']}', '{$imageTitle}', '{$photoUploadTime}', '{$data}', '{$thumbnail}');");
		if ($result) {
			$result = query_DB($mysqli, "SELECT iid FROM images WHERE uid='{$currentUser['uid']}' AND date='{$photoUploadTime}' ;");
			if ($result) {
				$uploadedIid = mysqli_fetch_assoc($result)['iid'];
				print_r($imageSize);
				header("location: {$fileNames['photoUploadRedirect']}?iid={$uploadedIid}");
			}
		}
	}
