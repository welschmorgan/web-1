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
	function phash_user($passwd)
	{
		return hash("sha512", $passwd);
	}
	function mod_user(&$users, $login, $oldpasswd, $passwd)
	{
		if (!$users)
			$users = array();
		if (!user_exists($users, $login)
			|| empty($login)
			|| empty($passwd)
			|| empty($oldpasswd))
			return (false);
		$hashp = phash_user($oldpasswd);
		$hashop = $users[$login]['passwd'];
		if ($hashop == $hashp)
		{
			$users[$login] = array('login' => $login, 'passwd' => phash_user($passwd));
			return (true);
		}
		return (false);
	}

	@mkdir("../private", 0777, true);
	if (get_post('submit') == 'OK')
	{
		$path = '../private/passwd';
		$users = load_users($path);
		echo (mod_user($users, get_post('login'), get_post('oldpasswd'), get_post('passwd'))
			? "SUCCESS\n"
			: "ERROR\n");
		save_users($users, $path);
	}
	else
	{
		echo "ERROR\n";
	}
?>
