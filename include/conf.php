<?
	function wrap($tag, $content, $name = '', $prefix = '', $type = 'class') {
		return "{$prefix}<{$tag} $type=\"{$name}\">{$content}{$prefix}</{$tag}>";
	}

	$siteName = "It's a Pi!";
	$domain = 'itsapi.co.uk';

	$specialMsg = "Thank you for beta-testing It's a Pi! Please PM admins <a href=\"messages.php?username=olls\">Olls</a> or <a href=\"messages.php?username=grit96\">Grit96</a> if you come accross any bugs, issues or just have questions to ask.";

	$passLength = 8;
	$userLength = 3;
	$errorMsgs = ['password' => wrap('p', "Passwords don't match.", 'error'),
				  'noPassword' => wrap('p', 'You must enter a password.', 'error'),
				  'incorrectPassword' => wrap('p', 'The password you entered was incorrect.', 'error'),
				  'shortPassword' => wrap('p', "Your password must be longer than {$passLength} characters.", 'error'),
				  'username' => wrap('p', 'You must enter a username.', 'error'),
				  'shortUsername' => wrap('p', "Your username needs to be longer than {$userLength} characters.", 'error'),
				  'firstname' => wrap('p', 'You must enter your firstname.', 'error'),
				  'lastname' => wrap('p', 'You must enter your lastname.', 'error'),
				  'takenUsername' => wrap('p', 'Sorry, your username is taken, please try another.', 'error'),
				  'email' => wrap('p', 'You must enter a valid email.', 'error')];
	$registerWelcome = 'Welcome {username}, you need to verify your account before you can login.';

	$loginFail = 'The username or password is incorrect.';
	$loginWelcome = 'Welcome {username}, you are now logged in.';

	$humanColumnTitles = ['uid' => 'User ID',
						  'username' => 'Username',
						  'firstname' => 'First Name',
						  'lastname' => 'Last Name',
						  'email' => 'Email',
						  'address' => 'Address',
						  'town' => 'Town',
						  'county' => 'County',
						  'country' => 'Country',
						  'postCode' => 'Postcode'];

	$settingsSaved = 'Your settings have been succesfully saved.';
	$settingsFormTypes = ['firstname' => 'text',
						  'lastname' => 'text',
						  'email' => 'email',
						  'address' => 'text',
						  'town' => 'text',
						  'county' => 'text',
						  'country' => 'text',
						  'postCode' => 'text'];

	$userInfoColumns = ['firstname',
					    'lastname',
					    'email',
					    'address',
					    'town',
					    'county',
					    'country',
					    'postCode'];
	$infoSeperator = ': ';

	$searchError = "Your search returned no results.";
	$searchNoTerm = 'Please enter some text to search.';
	$searchTableHeadings = ['firstname',
						    'lastname'];
	$searchTable = <<<END
\t\t<ul class="searchResult">
{row}
\t\t</ul>\n
END;
	$searchHeader = <<<END
<th>
	{cellTxt}
</th>
END;
	$searchRow = <<<END
\t\t\t<li>
\t\t\t\t<a href="{link}">{cell}</a>
\t\t\t</li>
END;
	$searchCell = '{cellTxt} ';

	$verifyLogin = 'Please verify your account. <a href="{url}">Click here</a> to resend the email.';
	$verifySuccess = 'Congratulations {username}, your account is now active, you can now login.';
	$verifyCodeLength = 30;
	$verifySubject = "Welcome to {siteName}, please validate your account";
	$verifyMsg = <<<END
<html>
	<head>
		<title>{subject}</title>
	</head>
	<body>
		<h1>Thank you {username}</h1>
		<h2>for registering with {siteName}</h2>
		<p>You now need to verify your email by clicking <a href="http://{verifyURL}">here</a>.</p>
		<p>Or use this URL: http://{verifyURL}</p>
	</body>
</html>
END;
	$verifyEmailSuccess = 'Your verification email has been sent. Your account will be deleted if you do not verify your account within 7 days.';
	$verifyEmailFail = 'Your verification email has not been sent. Click ';

	$verifyAccount = 'The account you tried to verify does not exist or you typed the URL incorrectly.';

	$viewFriendsButtonTxt = 'Show Friends';
	$hideFriendsButtonTxt = 'Hide Friends';

	$viewNotificationsButtonTxt = 'Show Notifications';
	$hideNotificationsButtonTxt = 'Hide Notifications';

	$viewPostsButtonTxt = 'Show posts';
	$viewProfileButtonTxt = 'Show profile';

	$friendRequestSent = '<br>You have sent a friend request.';
	$friendRequestAccepted = 'You and {profileName} are friends.';

	$messagesLimit = 20;
	$postsLimit = 10;
	$commentsLimit = 5;
	$feedLimit = 10;
	$likeText ='Give Pi';
	$thumbnailSize = 70;
	$noPosts = 'Nothing to see here.';
	$timeOut = 5;
	$resetPassLength = 30;
	$changeEmailLength = 30;
	$requestError = 'Cannot process request.';
	$resetPassSuccess = 'Password successfully reset.';
	$changeEmailSuccess = 'Email address successfully changed.';
	$changeEmailFail = 'Email address was not changed.';
	$nowFriends = 'You are now friends with {name}.';

	$noPermissionEdit = 'You do not have permission to edit this.';
	$notSaved = 'Not Saved :(';
	$userNotExist = 'That user does not exist';

	$profilePictureSuccess = 'Sucsessfuly set image as profile picture!';
	$profilePictureFail = 'Unsucsessfuly set image as profile picture.';
	$photoNotExists = 'Photo does not exist';
	$noPhotos = 'does not have any photos yet.';
	$photoNoTitle = 'You must enter a title.';

	$postSuccess = wrap('p', 'Post success.');
	$postFail = wrap('p', 'Post failed.');
	$successDeletePost = 'Your post was deleted.';
	$unsuccessDeletePost = 'Your post failed to deleted.';

	$commentSuccessful = 'Comment successful.';
	$commentFailed = 'Comment failed.';
	$commentDeleted = 'Comment deleted';

	$noPermission = 'You do not have permission to view this page.';
	$messageFrom = 'You have a message from ';
	$messageSuccess = 'Message sent!';
	$messageFail = 'Message not sent!';

	$settingsNotChanged = 'Settings not changed.';
	$postNotExist = '<p>This post does not exist.</p>';
	$profilePagePictureSize = 500;
	$noContentComment = 'You must enter some content for your comment';
	$noContentPost = 'You must enter some content for your post';

	$noNotifications = 'You have no notifications.';

	$noPermissionImg1 = "You do not have permission";
	$noPermissionImg2 = "to view this image.";

	$noFriends = 'You have no friends!';

	$notificationMessage = <<<END
<html>
	<head>
		<title>{title}</title>
	</head>
	<body>
		<h1>You have a notification:</h1>
		<h2>{title}</h2>
		<p>View more of the notification by clicking <a href="http://{link}">here</a>.</p>
		<p>Or use this URL: http://{link}</p>
	</body>
</html>
END;

	$receivedPiMsg = "Received Pi from {name} on {type} {notName}";
	$givePiSuccess = 'Successfully Given Pi';
	$givePiFail = 'Failed to Give Pi';
	$givePiAlready = 'Already Given Pi';

	$photoDeleteSuccess = 'Your photo was deleted.';

	$passwordReset = "You requested a password reset";
	$passwordResetMsg = <<<END
<html>
	<head>
		<title>{subject}</title>
	</head>
	<body>
		<h1>Reset your password</h1>
		<h2>If you did not request a password reset, ignore this email.</h2>
		<p>You can create a new password by clicking <a href="http://{resetURL}">here</a>.</p>
		<p>Or use this URL: http://{resetURL}</p>
	</body>
</html>
END;
	$passwordResetSuccess = 'Your password reset email has been sent.';
	$passwordResetSuccess = 'Your password reset email has not been sent. Click ';

	$changeEmailRequest = "You requested an email address change";
	$changeEmailMsg = <<<END
<html>
	<head>
		<title>{subject}</title>
	</head>
	<body>
		<h1>Update your email address to {emailAddress}</h1>
		<h2>If you did not request an email address update, ignore this email.</h2>
		<p>To confirm this update click <a href="http://{resetURL}">here</a>.</p>
		<p>Or use this URL: http://{resetURL}</p>
	</body>
</html>
END;

	$changeEmailSent = 'You will need to verify the email address update. An email has been sent to your old email address.';
	$changeEmailNotSent = 'Your email address update verification email has not been sent. Click ';

	$deleteProfileFail = 'Failed to delete your profile.';
	$verifyTimeOut = 604800;

	$smtpHost = "smtp.gmail.com";
	$mailSecurity = "ssl";
	$mailPort = 465;

	$noHTML = "To view the message, please use an HTML compatible email viewer!";


	$fileNames = [

				//Core Files

				'index' => 'index.php',
				'messages' => 'messages.php',
				'photo' => 'photo.php',
				'post' => 'post.php',
				'settings' => 'settings.php',
				'user' => 'user.php',
				'viewPhoto' => 'viewPhoto.php',

				//Comments Files

				'commentProcess' => 'comments/commentProcess.php',
				'submitComment' => 'comments/submitComment.php',
				'viewComments' => 'comments/viewComments.php',

				//CSS Files

				'style' => 'css/style.php',
				'normalize' => 'css/normalize.css',

				//Friends Files

				'addFriend' => 'friends/addFriend.php',
				'deleteFriend' => 'friends/deleteFriend.php',
				'friends' => 'friends/friends.php',
				'showAddFriend' => 'friends/showAddFriend.php',
				'viewFriends' => 'friends/viewFriends.php',

				//Include Files

				'clearUsers' => 'include/clearUsers.php',
				'conf' => 'include/footer.php',
				'footer' => 'include/footer.php',
				'funcs' => 'include/funcs.php',
				'head' => 'include/head.php',
				'header' => 'include/header.php',
				'inc' => 'include/inc.php',
				'mailConf' => 'include/mailConf.php',
				'mysql' => 'include/mysql.php',
				'pageViewable' => 'include/pageViewable.php',

				//JavaScript Files

				'google' => 'js/google.js',
				'ajax' => 'js/ajax.js',
				'javascript' => 'js/javascript.php',

				//Login Files

				'loggedIn' => 'login/loggedIn.php',
				'loggingIn' => 'login/loggingIn.php',
				'login' => 'login/login.php',
				'loginForm' => 'login/loginForm.php',
				'logout' => 'login/logout.php',
				'register' => 'login/register.php',
				'verify' => 'login/verify.php',
				'verifying' => 'login/verifying.php',

				//Messages Files

				'messageView' => 'messages/messageView.php',
				'sendMessage' => 'messages/sendMessage.php',

				//Notifications Files

				'deleteAllNotifications' => 'notifications/deleteAllNotifications.php',
				'deleteNotification' => 'notifications/deleteNotification.php',
				'notificationCount' => 'notifications/notificationCount.php',
				'notifications' => 'notifications/notifications.php',
				'viewNotifications' => 'notifications/viewNotifications.php',

				//Photo Files

				'photoProcess' => 'photo/photoProcess.php',
				'photoUpload' => 'photo/photoUpload.php',
				'photoUploadRedirect' => 'photo/photoUploadRedirect.php',

				//Posts Files

				'displayPosts' => 'posts/displayPosts.php',
				'editPost' => 'posts/editPost.php',
				'feed' => 'posts/feed.php',
				'postProcess' => 'posts/postProcess.php',
				'submitPost' => 'posts/submitPost.php',
				'viewPosts' => 'posts/viewPosts.php',

				//Search Files

				'search' => 'search/search.php',
				'searchRelevance' => 'search/searchRelevance.php',
				'searchResults' => 'search/searchResults.php',

				//Settings Files

				'saveSettings' => 'settings/saveSettings.php',
				'settingsForm' => 'settings/settingsForm.php',

				//User Files

				'userInfo' => 'user/userInfo.php',
				'userPosts' => 'user/userPosts.php',
				'userPostsProcess' => 'user/userPostsProcess.php',
				'userProcess' => 'user/userProcess.php',

				//Image files

				'default' => 'images/default.png',
				'overlay' => 'images/overlay.png'
	];
