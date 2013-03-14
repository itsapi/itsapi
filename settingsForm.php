<?
	if ($loggedIn) {
		if ($error) {
			$settingsError_fields = $settingsFields;
			$settingsError_fields['email'] = htmlspecialchars($_POST['email'], ENT_QUOTES);
		} else {
			$settingsError_fields = Null;
		}
?>
		<script>
			function delete_profile() {
				var answer = confirm("Do you want to delete your profile?")
				if (answer){
					document.getElementById('delete').value = '<?=$currentUser['uid']?>'
					document.forms['profileSettings'].submit()
				}
			}
		</script>	
		<section>
			<h2><label for="profileSettings">Settings</label></h2>
			<form method="post" action="<?= keepUrl() ?>" id="profileSettings">
				<label>Privacy: 
					<select name="privacy">
						<option value=""></option>
						<option value="3">Uberhigh: Only you can see your profile.</option>
						<option value="2">High: Only your friends can see your profile.</option>
						<option value="1">Medium: Anyone with an account can see your profile.</option>
						<option value="0">Low: Anyone on the internet can see your profile.</option>
					</select>
				</label><?
					if ($currentUser['privacy'] == 0) {echo('Low');}
					if ($currentUser['privacy'] == 1) {echo('Medium');}
					if ($currentUser['privacy'] == 2) {echo('High');}
					if ($currentUser['privacy'] == 3) {echo('Uberhigh');}
					
					echo("<br>\n");
?>
				<label>Email Notifications: <input type="checkbox" name="emailNotifications" value="true" <? if ($currentUser['emailNotifications'] == 1) { echo 'checked'; } ?>></label><? if ($currentUser['emailNotifications'] == 1) { echo 'Enabled'; } else { echo 'Disabled'; } ?>
<?
					echo("<br>\n");
					foreach ($settingsFormTypes as $column=>$type) {
						if ($column != 'uid' || $column != 'username') {
							echo "\t\t\t\t<label>{$humanColumnTitles[$column]}{$infoSeperator}<input type=\"{$type}\" name=\"{$column}\" value=\"{$settingsError_fields[$column]}\"></label>{$currentUser[$column]}<br>\n";
						}
					}
				?>
				<h4>Change Password</h4>
				<label>Old Password: <input type="password" name="oldPassword"></label><br>
				<label>Password: <input type="password" name="password"></label><br>
				<label>Verify Password: <input type="password" name="Vpassword"></label><br>
				<input type="submit" name="change" value="Change Settings">
				<input type="button" onclick="delete_profile()" value="Delete Profile">
				<input type="text" name="delete" id="delete" hidden>
			</form>
		</section>
	
<?
	}
?>
