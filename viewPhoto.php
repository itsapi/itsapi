<?
	error_reporting(E_ALL);
	ini_set('display_errors', 1);
	
	header('Content-Type: image/jpg');
	
	if (isset($_GET['iid'])) {
		
		$defaultProfileImageFile = fopen('default.png', 'r');
		$defaultImage = fread($defaultProfileImageFile, filesize('default.png'));
		fclose($defaultProfileImageFile);
		
		if ($_GET['iid'] != '') {
			include($fileNames['inc']);
			
			$iid = mysqli_real_escape_string($mysqli, $_GET['iid']);
			$result = query_DB($mysqli, "SELECT * FROM images WHERE iid={$iid}");
			$image = mysqli_fetch_assoc($result);
			$userProfile = userData($image['uid'], $mysqli, 'uid');
			
			include($fileNames['pageViewable']);
			
			if ($pageViewable) {
				$image = $image['image'];
			} else {
				$image = $defaultImage;
			}
		} else {
			$image = $defaultImage;
		}
		
		if (isset($_GET['size'])) {
			if ($_GET['size'] != '') {
				$profileImage = imagecreatefromstring($image);
				$current_width = imagesx($profileImage);
				$current_height = imagesy($profileImage);
				
				$widths = [$current_width, $_GET['size']];
				$new_width = min($widths);
				$new_height = $current_height / $current_width * $new_width;
				
				$resizedProfileImage = imagecreatetruecolor($new_width, $new_height);
				imagecopyresampled($resizedProfileImage, $profileImage, 0, 0, 0, 0, $new_width, $new_height, $current_width, $current_height);
				imagejpeg($resizedProfileImage);
			} else {
				echo $image;
			}
		} else {
			echo $image;
		}
	} else {
		header('location: ' . $fileNames['index']);
	}
