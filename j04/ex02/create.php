<?php
	function get_post($name, $defval = "")
	{
		return (isset($_POST) ? (isset($_POST[$name]) ? $_POST[$name] : $defval) : $defval);
	}

	function load_users($filename)
	{
		return (file_exists($filename) ? unserialize(file_get_contents($filename)) : array());
	}

	function save_users($users, $filename)
	{
		file_put_contents($filename, serialize($users));
	}

	function user_exists(&$users, $login)
	{
		foreach($users as $user)
		{
			if (strtolower($login) == strtolower($user['login']))
				return (true);
		}
		return (false);
	}
	function add_user(&$users, $login, $passwd)
	{
		if (!$users)
			$users = array();
		if (user_exists($users, $login)
			|| empty($login)
			|| empty($passwd))
			return (false);
		$users[$login] = array('login' => $login, 'passwd' => hash("sha512", $passwd));
		return (true);
	}

	@mkdir("../private", 0777, true);
	if (get_post('submit') == 'OK')
	{
		$path = '../private/passwd';
		$users = load_users($path);
		echo (add_user($users, get_post('login'), get_post('passwd'))
			? "SUCCESS\n"
			: "ERROR\n");
		save_users($users, $path);
	}
	else
	{
		echo "ERROR\n";
	}
?>
