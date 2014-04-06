<?php
	$ok = isset($_POST['ok']) ? $_POST['ok'] : 0;
	/*
	** If no data, display authentication form
	*/
	if ($ok === 0)
	{
		$mod = "Veuillez entrer vos informations pour procéder !<br />\n";
		$mod .= "<form method='post' action='' onsubmit='return validate_registration(this);'>\n";
		$mod .= "	<input type='text' id='last_name' name='last_name' placeholder='Nom de famille' /><br />\n";
		$mod .= "	<input type='text' id='first_name' name='first_name' placeholder='Prénom'/><br />\n";
		$mod .= "	<input type='text' id='username' name='username' placeholder=\"Nom d'utilisateur\"/><br />\n";
		$mod .= "	<input type='password' id='password' name='password' placeholder='Mot de passe'/><br />\n";
		$mod .= "	<input type='date' id='birthday' name='birthday' placeholder='Date de naissance' /><br />\n";
		$mod .= "	<input type='email' id='email' name='email' placeholder='Addesse email (nom@serveur.domaine)' /><br />\n";
		$mod .= "<input type='hidden' name='module' value='register' />\n";
		$mod .= "<input type='hidden' name='ok' value='1' />\n";
		$mod .= "<button class='right' type='submit'>Ok</button>";
		$mod .= "</form>\n";
		$index = $mod;
	}
	/*
	** Otherwise try to login with given credentials
	*/
	else
	{
		$index = "Registering ...<br />";
		$db = mysqli_connect($_GLOBALS['config']['mysql']['host'],
			$_GLOBALS['config']['mysql']['user'],
			$_GLOBALS['config']['mysql']['pass'],
			$_GLOBALS['config']['mysql']['db']) or die("Couldn't connect to db.");
		$last_name = isset($_POST['last_name']) ? $_POST['last_name'] : "";
		$first_name = isset($_POST['first_name']) ? $_POST['first_name'] : "";
		$username = isset($_POST['username']) ? $_POST['username'] : "";
		$password = isset($_POST['password']) ? $_POST['password'] : "";
		$email = isset($_POST['email']) ? $_POST['email'] : "";
		$birthday = isset($_POST['birthday']) ? $_POST['birthday'] : "";

		$q = mysqli_query($db,
			"INSERT INTO `web-1`.`users` (`id`, `first_name`, `last_name`, `username`, `password`, `email`, `birthday`, `level`) ".
			"VALUES (NULL, '".$first_name."', '".$last_name."', '".$username."', '".$password."', '".$email."', '".$birthday."', '0');");
		if ($q)
			$index .= "Successfully registered !<br />\n";
		else
			$index .= "Error: ".mysqli_error($db);
	}
	$_GLOBALS['modules']['register']['index'] = $index;
	$_GLOBALS['modules']['register']['scripts'] = array("validator.js");
	$_GLOBALS['modules']['register']['styles'] = array();
?>
