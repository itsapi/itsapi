<?
	error_reporting(E_ALL);
	ini_set('display_errors', 1);

	include('include/inc.php');

	header('Content-Type: image/jpg');
	
	if (isset($_GET['iid'])) {
		
		$defaultProfileImageFile = fopen($fileNames['default'], 'r');
		$defaultImage = fread($defaultProfileImageFile, filesize($fileNames['default']));
		fclose($defaultProfileImageFile);
		
		if ($_GET['iid'] != '') {			
			$iid = mysqli_real_escape_string($mysqli, $_GET['iid']);
			$result = query_DB($mysqli, "SELECT * FROM images WHERE iid={$iid}");
			$image = mysqli_fetch_assoc($result);
			$userProfile = userData($image['uid'], $mysqli, 'uid');
			
			include($fileNames['pageViewable']);
			
			if ($pageViewable) {
				if (isset($_GET['size']) && ($_GET['size'] <= 50)) {
					if (isset($image['thumbnail'])) {
						$image = $image['thumbnail'];
					} else {
						$image = $image['image'];
					}
				} else {
					$image = $image['image'];
				}
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
