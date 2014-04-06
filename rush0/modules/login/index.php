<?php
	$ok = isset($_POST['ok']) ? $_POST['ok'] : 0;
	/*
	** If no data, display authentication form
	*/
	if ($ok === 0)
	{
		$form = "<form method='post' action='' onsubmit='return validate_login(this);'>\n";
		$form .= "	<input type='hidden' name='ok' value='1' />";
		$form .= "	<input type='hidden' name='module' value='login' />";
		$form .= "	<input type='text' id='username' name='username' placeholder=\"Nom d'utilisateur\" /><br />\n";
		$form .= "	<input type='password' id='password' name='password' placeholder=\"Mot de passe\" /><br />\n";
		$form .= "<button type='submit'>Ok</button>";
		$form .= "</form>\n";
		$index = "Rentrez vos identifiants de connexion.<br />".$form;
	}
	/*
	** Otherwise try to login with given credentials
	*/
	else
	{
		$index = "Logging in ...<br />";
		$db = mysqli_connect($_GLOBALS['config']['mysql']['host'],
			$_GLOBALS['config']['mysql']['user'],
			$_GLOBALS['config']['mysql']['pass'],
			$_GLOBALS['config']['mysql']['db']) or die("Couldn't connect to db.");
		$res = mysqli_query($db, "SELECT * FROM users WHERE `username`='".$_POST['username']."' AND `password`='".$_POST['password']."'");
		if ($res)
		{
			// Fetch one and one row
			$row=mysqli_fetch_array($res);
			if ($row)
			{
				$_SESSION['username'] = $row['username'];
				$_SESSION['password'] = $row['password'];
				$_SESSION['last_name'] = $row['last_name'];
				$_SESSION['first_name'] = $row['username'];
				$_SESSION['birthday'] = $row['birthday'];
				$_SESSION['email'] = $row['email'];
				$_SESSION['level'] = $row['level'];
				$_SESSION['basket'] = array();
				$index .= "Bienvenu(e), ".$_SESSION['username'].", redirection dans 2 secondes.<br />\n";
				mysqli_free_result($res);
				header("refresh: 2; url=index.php");
			}
			else
			{
				$index .= "Error: ".mysqli_error($db)."<br/>Invalid credentials !";
				header("refresh: 2; url=index.php?module=login");
			}
		}
		else
		{
			$index .= "Error: ".mysqli_error($db)."<br/>Invalid credentials !";
			header("refresh: 2; url=index.php?module=login");
		}
	}
	$_GLOBALS['modules']['login']['index'] = $index;
	$_GLOBALS['modules']['login']['scripts'] = array("validator.js");
	$_GLOBALS['modules']['login']['styles'] = array();
?>
