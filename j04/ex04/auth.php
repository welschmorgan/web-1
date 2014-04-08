<?php
	function phash_user($passwd)
	{
		return hash("sha512", $passwd);
	}
	function load_users($filename)
	{
		return (file_exists($filename) ? unserialize(file_get_contents($filename)) : array());
	}

	function save_users($users, $filename)
	{
		file_put_contents($filename, serialize($users));
	}

	function user_exists(&$users, $login, $passwd)
	{
		foreach($users as $user)
		{
			if (strtolower($login) == strtolower($user['login'])
				&& $user['passwd'] == phash_user($passwd))
				return (true);
		}
		return (false);
	}
	function auth($login, $passwd)
	{
		$path = '../private/passwd';
		@mkdir('../private');
		return (user_exists(load_users($path), $login, $passwd));
	}
?>
