<?php
	$action = isset($_GET['action']) ? $_GET['action'] : "show";
	$index = "";
	if (!isset($_SESSION['username']))
		$index = "Vous devez etre loggé pour voir ce module.";
	else
	{
		switch($action)
		{
			case 'delete':
				$ok = isset($_GET['ok']) ? $_GET['ok'] : 0;
				if ($ok)
					$index = "Deleting account for ".$_SESSION['username'].", ".
						"<button onclick=\"window.location='?module=account&action=delete&ok=1\">Proceed</button><br />";
				else
					$index = "Account deleted.";
				$db = mysqli_connect($_GLOBALS['config']['mysql']['host'],
					$_GLOBALS['config']['mysql']['user'],
					$_GLOBALS['config']['mysql']['pass'],
					$_GLOBALS['config']['mysql']['db']) or die("Couldn't connect to db.");
				$q = mysql_query("DELETE FROM `users` WHERE `username` = '".$_SESSION['username']."' AND `password` = '".$_SESSION['password']."'");
				if ($q)
					$index .= "Successfully deleted account '".$_SESSION['username']."'.<br />";
				else
					$index .= "Error: ".mysqli_error($db);
			break;
			case 'show':
				$index = "Showing account for ".$_SESSION['username']."<br />";
				$index .= "	<input class='input' type='text' id='last_name' name='last_name' placeholder='Nom de famille' value='".$_SESSION['last_name']."' disabled readonly/><br />\n";
				$index .= "	<input class='input' type='text' id='first_name' name='first_name' placeholder='Prénom' value='".$_SESSION['first_name']."' disabled readonly/><br />\n";
				$index .= "	<input class='input' type='text' id='username' name='username' placeholder=\"Nom d'utilisateur\" value='".$_SESSION['username']."' disabled readonly/><br />\n";
				$index .= "	<input class='input' type='text' id='birthday' name='birthday' placeholder='Date de naissance' value='".$_SESSION['birthday']."' disabled readonly/><br />\n";
				$index .= "	<input class='input' type='email' id='email' name='email' placeholder='Adresse email (nom@serveur.domaine)' value='".$_SESSION['email']."' disabled readonly/><br />\n";
			break;
			case 'edit':
				$ok = get_post_get("ok", "");
				if (!empty($ok))
				{
					$index .= "updated profile !";
				}
				else
				{
					$index = "Editting account ".$_SESSION['username'].".<br />";
					$index .= "<form method='post'>";
					$index .= "<input type=hidden name=module value=account />";
					$index .= "<input type=hidden name=action value=edit />";
					$index .= "<input type=hidden name=ok value=1 />";
					$index .= "	<input class='input' type='text' id='last_name' name='last_name' placeholder='Nom de famille' value='".$_SESSION['last_name']."' disabled readonly/><br />\n";
					$index .= "	<input class='input' type='text' id='first_name' name='first_name' placeholder='Prénom' value='".$_SESSION['first_name']."' disabled readonly/><br />\n";
					$index .= "	<input class='input' type='text' id='username' name='username' placeholder=\"Nom d'utilisateur\" value='".$_SESSION['username']."' disabled readonly/><br />\n";
					$index .= "	<input class='input' type='text' id='birthday' name='birthday' placeholder='Date de naissance' value='".$_SESSION['birthday']."' disabled readonly/><br />\n";
					$index .= "	<input class='input' type='email' id='email' name='email' placeholder='Adresse email (nom@serveur.domaine)' value='".$_SESSION['email']."' disabled readonly/><br />\n";
					$index .= "<button type=submit>Save</button>";
					$index .= "</form>";
				}
			break;
			default:
				$index = "Unknown action '$action'.<br />";
		}
	}
	$_GLOBALS['modules']['account']['index'] = $index;
	$_GLOBALS['modules']['account']['scripts'] = array("validator.js");
	$_GLOBALS['modules']['account']['styles'] = array();
?>
