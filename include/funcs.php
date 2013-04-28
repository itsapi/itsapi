<?
	function randNumber($length) {
		$rand = Null;
		for($i=0; $i<$length; $i++){
			$rand = $rand . rand(0, 9);
		}
		return $rand;
	}
	 
	function query_DB($mysqli, $query) {
		$result = mysqli_query($mysqli, $query);
		if (!$result) {
			echo(queryError($mysqli));
			return False;
		} else {
			return $result;
		}
	}

	function userData($searchFor, $mysqli, $search='username') {
		$result = query_DB($mysqli, "SELECT * FROM `users` WHERE {$search}='{$searchFor}'");
		return mysqli_fetch_assoc($result);
	}

	function keepUrl($addQuery = Null) {
		if ($_SERVER['QUERY_STRING']) {
			if (isset($addQuery)) {
				return $_SERVER['PHP_SELF'] . '?' . $_SERVER['QUERY_STRING'] . '&' . $addQuery;
			} else {
				return $_SERVER['PHP_SELF'] . '?' . $_SERVER['QUERY_STRING'];
			}
		} else {
			if (isset($addQuery)) {
				return $_SERVER['PHP_SELF'] . '?' . $addQuery;
			} else {
				return $_SERVER['PHP_SELF'];
			}
		}
	}

	function areFriends($mysqli, $uid1, $uid2) {
		$accQuery = 'AND `acc1`=1 AND `acc2`=1';
		$query = "SELECT * FROM `friends` WHERE (`uid1`='{$uid1}' AND `uid2`='{$uid2}' {$accQuery}) OR (`uid1`='{$uid2}' AND `uid2`='{$uid1}' {$accQuery})";
		$result = query_DB($mysqli, $query);
		if ($result) {
			if (mysqli_num_rows($result) != 0) {
				return True;
			} else {
				return False;
			}
		} else {
			return False;
		}
	}

	function friends($mysqli, $currentUser, $linkStr, $id="friendList") {
		$result = query_DB($mysqli, "SELECT fid, uid1, uid2 FROM friends WHERE (uid1={$currentUser['uid']} OR uid2={$currentUser['uid']}) AND `acc1`=1 AND `acc2`=1");
		if ($result) {
			if (mysqli_num_rows($result) != 0) {
				$friendsTxt = [];
				while ($friendship = mysqli_fetch_assoc($result)) {
					foreach ($friendship as $column=>$friendUid) {
						if ($column != 'fid' && $friendUid != $currentUser['uid']) {
							$friend = userData($friendUid, $mysqli, 'uid');
							$friendsTxt[] = profileImage($friend, 'smallProfilePhoto', 20) . str_replace(['{username}', '{firstname}', '{lastname}', '{fid}'], [$friend['username'], $friend['firstname'], $friend['lastname'], $friendship['fid']], $linkStr);
						}
					}
				}
				echo wrap('ul', "\n\t\t\t" . wrap('li', implode("</li>\n<li>", $friendsTxt)), $id, "\n\t\t", 'id') . "\n";
			} else {
				echo wrap('p', $GLOBALS['noFriends'], $id, '', 'id');
			}
		}
	}
	
	function notification($mysqli, $uid, $title, $link) {
		$query = "INSERT INTO `notifications` (`uid`, `date`, `title`, `link`) VALUES ('{$uid}', '" . time() . "', '{$title}', '{$link}')";
		$result = query_DB($mysqli, $query);
		$userData = userData($uid, $mysqli, 'uid');
		if ($userData['emailNotifications'] == 1) {
			$message = str_replace(['{title}','{link}'], [$title, $link], $GLOBALS['notificationMessage']);
			email($userData, $title, $message);
		}
		return $result;
	}

	function nl2br_limit($string, $num) {
		$clean = preg_replace('/\n{4,}/', str_repeat('<br>', $num), preg_replace('/\r/', '', $string));
		$clean = str_replace("\n", '', $clean);
		return nl2br($clean, False);
	}
	
	function friendUids($mysqli, $currentUser) {
		$result = query_DB($mysqli, "SELECT uid1, uid2 FROM friends WHERE (uid1={$currentUser['uid']} OR uid2={$currentUser['uid']}) AND `acc1`=1 AND `acc2`=1");
		if ($result) {
			if (mysqli_num_rows($result) != 0) {
				$fUids = Array();
				while ($row = mysqli_fetch_assoc($result)) {
					if ($row['uid1'] == $currentUser['uid']) { $fUids[] = ($row['uid2']); } else { $fUids[] = ($row['uid1']); }
				}
				return $fUids;
			} else {
				return False;
			}
		}
	}

	function isLiked($mysqli, $currentUser, $id, $type) {
		$result = query_DB($mysqli, "SELECT lid FROM likes WHERE uid='{$currentUser['uid']}' AND id='{$id}' AND type='{$type}'");
		if ($result) {
			if (mysqli_num_rows($result) != 0) {
				return True;
			} else {
				return False;
			}
		}
	}

	function getLikes($mysqli, $id, $type) {
		$result = query_DB($mysqli, "SELECT lid FROM likes WHERE id='{$id}' AND type='{$type}'");
		if ($result) {
			return mysqli_num_rows($result);
		}
	}
	
	function putLike($mysqli, $currentUser, $id, $type) {
		if (!isLiked($mysqli, $currentUser, $id, $type)) {
			$result = query_DB($mysqli, "INSERT INTO likes (uid, id, type) VALUES ('{$currentUser['uid']}', '{$id}', '{$type}')");
			if ($result) {
				$result = query_DB($mysqli, "SELECT uid FROM likes WHERE id='{$id}' AND type='{$type}'");
				if ($result) {
					if (mysqli_num_rows($result) != 0) {
						$row = mysqli_fetch_assoc($result);
						
						if ($type == 'comment') {
							$table = 'comments';
							$idType = 'cid';
						}
						if ($type == 'post') {
							$table = 'posts';
							$idType = 'pid';
						}
						
						$result = query_DB($mysqli, "SELECT content, uid, pid FROM {$table} WHERE {$idType}='{$id}'");
						if ($result) {
							if (mysqli_num_rows($result) != 0) {
								$notInfo = mysqli_fetch_assoc($result);
								$notName = substr($notInfo['content'], 0, 10);
								$pid = $notInfo['pid'];
								
								$name = $currentUser['firstname'] . ' ' . $currentUser['lastname'];
								$title = $message = str_replace(['{name}','{type}', '{notName}'], [$name, $type, $notName], $GLOBALS['receivedPiMsg']);
								$link = "{$GLOBALS['domain']}/{$GLOBALS['fileNames']['post']}?pid={$pid}";
								
								notification($mysqli, $notInfo['uid'], $title, $link);
							}
						}
					}
				}
				return $GLOBALS['givePiSuccess'];
			} else {
				return $GLOBALS['givePiFail'];
			}
		} else {
			return $GLOBALS['givePiAlready'];
		}
	}
	
	function email($userData, $subject, $message) {
		require_once('../phpmailer/class.phpmailer.php');
		
		$mail = new PHPMailer();
		
		$body = $message;
		
		$mail->IsSMTP();
		$mail->Host       = $GLOBALS['smtpHost'];
		$mail->SMTPDebug  = 1;

		$mail->SMTPAuth   = true;
		$mail->SMTPSecure = $GLOBALS['mailSecurity'];
		$mail->Host       = $GLOBALS['smtpHost'];
		$mail->Port       = $GLOBALS['mailPort'];
		$mail->Username   = $GLOBALS['mailUser'];
		$mail->Password   = $GLOBALS['mailPass'];

		$mail->SetFrom($GLOBALS['mailFrom'], $GLOBALS['siteName']);

		$mail->AddReplyTo($GLOBALS['mailReplyTo'], $GLOBALS['siteName']);

		$mail->Subject    = $subject;

		$mail->AltBody    = $GLOBALS['noHTML'];

		$mail->MsgHTML($body);

		$address = "{$userData['email']}";
		$mail->AddAddress($address, "{$userData['firstname']} {$userData['lastname']}");

		return $mail->Send();
	}
	
	function verify($userData, $verifyCode) {
			query_DB($GLOBALS['mysqli'], "UPDATE users SET lastActivity='" . time() . "' WHERE username='" . $userData['username'] . "'");
			$verifyURL = "{$GLOBALS['domain']}/{$GLOBALS['fileNames']['index']}?verify={$verifyCode}&user={$userData['username']}";
			$subject =  str_replace('{siteName}', $GLOBALS['siteName'], $GLOBALS['verifySubject']);
			$message = str_replace(['{subject}', '{username}', '{siteName}', '{verifyURL}'], [$subject, $userData['username'], $GLOBALS['siteName'], $verifyURL], $GLOBALS['verifyMsg']);
			
			$result = email($userData, $subject, $message);
			if ($result) {
				return $GLOBALS['verifyEmailSuccess'];
			} else {
				return $GLOBALS['verifyEmailFail'] . str_replace('{url}', keepUrl("resend={$userData['username']}"), '<a href="{url}">here</a>') . ' to resend the email.';
			}
	}
	
	function profileImage($userProfile, $imgClass='profilePhoto', $size=500) {
		return "<img src=\"{$GLOBALS['fileNames']['viewPhoto']}?iid={$userProfile['iid']}&size={$size}\" alt=\"{$userProfile['username']}'s picture\" class=\"{$imgClass}\">";
	}
	
	function updateProfileImage($uid, $iid, $mysqli) {
		$result = query_DB($mysqli, "UPDATE users SET iid = '{$iid}' WHERE uid = '{$uid}'");
		if ($result) {
			return True;
		} else {
			return False;
		}
	}
	
	function deleteImage($iid, $mysqli) {
		$result = query_DB($mysqli, "DELETE FROM images WHERE iid = '{$iid}'");
		if ($result) {
			return True;
		} else {
			return False;
		}
	}
	
	function getUserGallery($mysqli, $userProfile, $iid, $photoExists) {
		$msg = '';
		$result = query_DB($mysqli, "SELECT iid, uid, date, title FROM images WHERE uid={$userProfile['uid']}");
		if (mysqli_num_rows($result) != 0) {
			$images = [];
			while ($row = mysqli_fetch_assoc($result)) {
				$images[] = $row;
			}
			if ($iid != '') {
				foreach ($images as $iKey => $image) {
					if ($image['iid'] == $iid) {
						$key = $iKey;
					}
				}
				if (!isset($key)) {
					$msg .= wrap('p', 'Photo does not exist', 'error');
					$photoExists = False;
				}
			} else {
				$key = 0;
			}
			
			if ($photoExists) {
				if (isset($images[$key-1])) {
					$prev = $images[$key-1]['iid'];
				} else {
					$prev = $images[$key]['iid'];
				}
				
				if (isset($images[$key+1])) {
					$next = $images[$key+1]['iid'];
				} else {
					$next = $images[$key]['iid'];
				}
			}
		} else {
			$photoExists = False;
			$msg .= wrap('p', "{$userProfile['firstname']} {$userProfile['lastname']} does not have any photos yet.", 'error');
		}
		if ($photoExists) {
			return [$photoExists, $msg, $images, $key, $next, $prev];
		} else {
			return [$photoExists, $msg];
		}
	}
	
	function forgotPass($mysqli, $username) {
		$resetPassCode = randNumber($GLOBALS['resetPassLength']);
		query_DB($mysqli, "UPDATE users SET passReset='{$resetPassCode}' WHERE username='{$username}'");
		$userData = userData($username, $mysqli);
		$resetURL = "{$GLOBALS['domain']}/{$GLOBALS['fileNames']['index']}?resetPass={$resetPassCode}&user={$username}";
		$subject =  $GLOBALS['passwordReset'];
		$message = str_replace(['{subject}', '{resetURL}'], [$subject, $resetURL], $GLOBALS['passwordResetMsg']);
		
		$result = email($userData, $subject, $message);
		if ($result) {
			return $GLOBALS['passwordResetSuccess'];
		} else {
			$resendURL = keepUrl("resendPass={$userData['username']}");
			return $GLOBALS['passwordResetFail'] . "<a href=\"{$resendURL}\">here</a> to resend the email.";
		}
	}
	
	function resetPass($mysqli, $username, $password, $Vpassword, $resetCode) {
		if ($password == $Vpassword) {
			if (strlen($password) > $GLOBALS['passLength']) {
				$result = query_DB($mysqli, "SELECT uid FROM users WHERE username='{$username}' AND passReset='{$resetCode}'");
				if (mysqli_num_rows($result) == 1) {
					$md5_password = md5($username . md5($password));
					$result = query_DB($mysqli, "UPDATE users SET passReset=NULL, password='{$md5_password}' WHERE username='{$username}'");
					if ($result) {
						return $GLOBALS['resetPassSuccess'];
					} else {
						return $GLOBALS['requestError'];
					}
				} else {
					return $GLOBALS['requestError'];
				}
			} else {
				return $GLOBALS['errorMsgs']['shortPassword'];
			}
		} else {
			return $GLOBALS['errorMsgs']['password'];
		}
	}
	
	function changeEmail($mysqli, $username, $emailAddress) {
		$changeEmailCode = randNumber($GLOBALS['changeEmailLength']);
		query_DB($mysqli, "UPDATE users SET changeEmail='{$changeEmailCode}' WHERE username='{$username}'");
		$userData = userData($username, $mysqli);
		$resetURL = "{$GLOBALS['domain']}/{$GLOBALS['fileNames']['index']}?changeEmail={$changeEmailCode}&user={$username}&email={$emailAddress}";
		$subject =  $GLOBALS['changeEmailRequest'];
		$message = str_replace(['{subject}', '{emailAddress}', '{resetURL}'], [$subject, $emailAddress, $resetURL], $GLOBALS['changeEmailMsg']);
		$result = email($userData, $subject, $message);
		if ($result) {
			return $GLOBALS['changeEmailSent'];
		} else {
			$resendURL = keepUrl("resendEmail={$userData['username']}");
			return $GLOBALS['changeEmailNotSent'] . "<a href=\"{$resendURL}\">here</a> to resend the email.";
		}
	}
	
	function deleteProfile($mysqli, $uid) {
		$failed = False;
		if (!query_DB($mysqli, "DELETE FROM users WHERE uid='{$uid}'")) {
			$failed = True;
		}
		if (!query_DB($mysqli, "DELETE FROM posts WHERE uid='{$uid}'")) {
			$failed = True;
		}
		if (!query_DB($mysqli, "DELETE FROM comments WHERE uid='{$uid}'")) {
			$failed = True;
		}
		if (!query_DB($mysqli, "DELETE FROM notifications WHERE uid='{$uid}'")) {
			$failed = True;
		}
		if (!query_DB($mysqli, "DELETE FROM messages WHERE uidFrom='{$uid}' OR uidTo='{$uid}'")) {
			$failed = True;
		}
		if (!query_DB($mysqli, "DELETE FROM likes WHERE uid='{$uid}'")) {
			$failed = True;
		}
		if (!query_DB($mysqli, "DELETE FROM images WHERE uid='{$uid}'")) {
			$failed = True;
		}
		if (!query_DB($mysqli, "DELETE FROM friends WHERE uid1='{$uid}' OR uid2='{$uid}'")) {
			$failed = True;
		}
		if ($failed) {
			return $GLOBALS['deleteProfileFail'];
		} else {
			$loggedIn = logout();
			header('location: ' . $GLOBALS['fileNames']['index']);
		}
	}
	
	function logout() {
		session_destroy();
		setcookie('username', '', time()-3600);
		return False;
	}

	function detectURL($text, $media=True) {
		$rexProtocol = '(https?://)?';
		$rexDomain   = '((?:[-a-zA-Z0-9]{1,63}\.)+[-a-zA-Z0-9]{2,63}|(?:[0-9]{1,3}\.){3}[0-9]{1,3})';
		$rexPort     = '(:[0-9]{1,5})?';
		$rexPath     = '(/[!$-/0-9:;=@_\':;!a-zA-Z\x7f-\xff]*?)?';
		$rexQuery    = '(\?[!$-/0-9:;=@_\':;!a-zA-Z\x7f-\xff]+?)?';
		$rexFragment = '(#[!$-/0-9:;=@_\':;!a-zA-Z\x7f-\xff]+?)?';

		$validTlds = array_fill_keys(explode(" ", ".aero .asia .biz .cat .com .coop .edu .gov .info .int .jobs .mil .mobi .museum .name .net .org .pro .tel .travel .ac .ad .ae .af .ag .ai .al .am .an .ao .aq .ar .as .at .au .aw .ax .az .ba .bb .bd .be .bf .bg .bh .bi .bj .bm .bn .bo .br .bs .bt .bv .bw .by .bz .ca .cc .cd .cf .cg .ch .ci .ck .cl .cm .cn .co .cr .cu .cv .cx .cy .cz .de .dj .dk .dm .do .dz .ec .ee .eg .er .es .et .eu .fi .fj .fk .fm .fo .fr .ga .gb .gd .ge .gf .gg .gh .gi .gl .gm .gn .gp .gq .gr .gs .gt .gu .gw .gy .hk .hm .hn .hr .ht .hu .id .ie .il .im .in .io .iq .ir .is .it .je .jm .jo .jp .ke .kg .kh .ki .km .kn .kp .kr .kw .ky .kz .la .lb .lc .li .lk .lr .ls .lt .lu .lv .ly .ma .mc .md .me .mg .mh .mk .ml .mm .mn .mo .mp .mq .mr .ms .mt .mu .mv .mw .mx .my .mz .na .nc .ne .nf .ng .ni .nl .no .np .nr .nu .nz .om .pa .pe .pf .pg .ph .pk .pl .pm .pn .pr .ps .pt .pw .py .qa .re .ro .rs .ru .rw .sa .sb .sc .sd .se .sg .sh .si .sj .sk .sl .sm .sn .so .sr .st .su .sv .sy .sz .tc .td .tf .tg .th .tj .tk .tl .tm .tn .to .tp .tr .tt .tv .tw .tz .ua .ug .uk .us .uy .uz .va .vc .ve .vg .vi .vn .vu .wf .ws .ye .yt .yu .za .zm .zw .xn--0zwm56d .xn--11b5bs3a9aj6g .xn--80akhbyknj4f .xn--9t4b11yi5a .xn--deba0ad .xn--g6w251d .xn--hgbk6aj7f53bba .xn--hlcj6aya9esc7a .xn--jxalpdlp .xn--kgbechtv .xn--zckzah .arpa"), true);
		
		$validImg = array_fill_keys(explode(" ", ".jpeg .jpg .png .gif .bmp"), true);

		$output = '';
		$position = 0;
		while (preg_match("{\\b$rexProtocol$rexDomain$rexPort$rexPath$rexQuery$rexFragment(?=[?.!,;:\"]?(\s|$))}", $text, $match, PREG_OFFSET_CAPTURE, $position)) {
			list($url, $urlPosition) = $match[0];

			// Print the text leading up to the URL.
			$output .= (substr($text, $position, $urlPosition - $position));

			$domain = $match[2][0];
			$port   = $match[3][0];
			$path   = $match[4][0];

			// Check if the TLD is valid - or that $domain is an IP address.
			$tld = strtolower(strrchr($domain, '.'));
			if (preg_match('{\.[0-9]{1,3}}', $tld) || isset($validTlds[$tld])) {
				// Prepend http:// if no protocol specified
				$completeUrl = $match[1][0] ? $url : "http://$url";
				
				// Print the hyperlink.
				$imgFile = strtolower(strrchr($path, '.'));
				if (stripos($completeUrl, $GLOBALS['domain'])) {
					$target = '>';
				} else {
					$target = ' target=\"blank\">';
				}
				
				if ($media) {
					if (stripos($completeUrl, 'youtube.com/watch?v=')) {
						$youtubeWatchCode = explode('&', explode('?v=', $completeUrl)[1])[0];
						$output .= '<iframe width="560" height="350" src="http://www.youtube.com/embed/' . $youtubeWatchCode . '?wmode=direct" frameborder="0" allowfullscreen></iframe>';
					} elseif (preg_match('{\.[0-9]{1,3}}', $imgFile) || isset($validImg[$imgFile]) || stripos($completeUrl, "{$GLOBALS['fileNames']['viewPhoto']}?iid=")) {
						$output .= '<a href=' . $completeUrl . $target . '<img src=' . $completeUrl . '></a>';
					} elseif (stripos($completeUrl, "{$GLOBALS['fileNames']['photo']}?iid=")) {
						$newUrl = explode($GLOBALS['fileNames']['photo'], $completeUrl);
						$queryString = explode('?iid=', $newUrl[1]);
						$newUrl = $newUrl[0] . $GLOBALS['fileNames']['viewPhoto'] . '?size=500&iid=' . $queryString[1];
						$output .= '<a href=' . $completeUrl . $target . '<img src=' . $newUrl . '></a>';
					} elseif (stripos($completeUrl, "{$GLOBALS['fileNames']['user']}?username=")) {
						$username = userData(explode("{$GLOBALS['fileNames']['user']}?username=", $completeUrl)[1], $GLOBALS['mysqli']);
						$output .= '<a href=' . $completeUrl . $target . $username['firstname'] . ' ' . $username['lastname'] . '</a>';
					} else {
						$output .= '<a href=' . $completeUrl . $target . "$domain$port$path" . '</a>';
					}
				} elseif (stripos($completeUrl, "{$GLOBALS['fileNames']['user']}?username=")) {
					$username = userData(explode("{$GLOBALS['fileNames']['user']}?username=", $completeUrl)[1], $GLOBALS['mysqli']);
					$output .= '<a href=' . $completeUrl . $target . $username['firstname'] . ' ' . $username['lastname'] . '</a>';
				} else {
					$output .= '<a href=' . $completeUrl . $target . "$domain$port$path" . '</a>';
				}
				
			} else {
				// Not a valid URL.
				$output .= ($url);
			}
			// Continue text parsing from after the URL.
			$position = $urlPosition + strlen($url);
		}
		// Print the remainder of the text.
		$output .= substr($text, $position);
		
		return $output;
	}
	
	function removeLines($text) {
		$text = preg_replace("/[\r\n]+/", "\n", $text);
		while (substr($text, -1) == "\n") {
			$text = substr($text, 0, -1);
		}

		$text = nl2br($text);
		return textWrap($text);
	}

	function numNotifications($mysqli, $userProfile) {
		$result = query_DB($mysqli, 'SELECT nid FROM notifications WHERE uid=' . $userProfile['uid']);
		if ($result) {
			return mysqli_num_rows($result);
		} else {
			return False;
		}
	}

	function textWrap($text) {
        $new_text = '';
        $text_1 = explode('>',$text);
        $sizeof = sizeof($text_1);
        for ($i=0; $i<$sizeof; ++$i) {
            $text_2 = explode('<',$text_1[$i]);
            if (!empty($text_2[0])) {
                $new_text .= preg_replace('#([^\n\r .]{25})#i', '\\1  ', $text_2[0]);
            }
            if (!empty($text_2[1])) {
                $new_text .= '<' . $text_2[1] . '>';
            }
        }
        return $new_text;
    }
