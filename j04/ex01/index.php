<?php
	session_start();
	function session_get($name, $defval = "")
	{
		return (isset($_SESSION) ? (isset($_SESSION[$name]) ? $_SESSION[$name] : $defval) : $defval);
	}
	function get_get($name, $defval = "")
	{
		return (isset($_GET) ? (isset($_GET[$name]) ? $_GET[$name] : $defval) : $defval);
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Section Membre</title>
	<link rel="stylesheet" href="">
</head>
<body>

<?php
	if (get_get('submit') == 'OK')
	{
		$_SESSION = array(
			'login' => get_get('login'),
			'passwd' => get_get('passwd')
		);
	}
?>

<form action='index.php' method='GET'>
	Identifiant: <input type='text' name='login' value='<?php echo session_get("login"); ?>' />
	<br />
	Mot de passe: <input type='password' name='passwd' value='<?php echo session_get("passwd"); ?>' />
	<br />
	<input type="submit" value='OK' name='submit' />
</form>

</body>
</html>
